<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\{ Redis, Process };

class AppInstall extends Command
{
    protected $signature    = 'app:install';
    protected $description  = 'Executa o setup completo da aplicação';

    public function handle()
    {
        $this->newLine()->alert('Iniciando o setup da PokéApp');

        $this->generateKeyAndLinkStorage();
        $this->clearAllCaches();
        $this->migrateFreshWithSeed();
        $this->npmInstallAndBuild();
        $this->flushAllRedis();

        $this->newLine(2)->info('✅ Aplicação pronta para uso em: ' . config('app.url'));

        $this->showUsersTable();

        // TODO: Não consegui fazer funcionar dentro deste comando
        // if ($this->confirm('Deseja utilizar Hot Reload (npm run dev) em vez de build estático?', false)) {
        //     $this->npmRunDev();
        // }
    }

    private function clearAllCaches() {
        $this->info('  ➔ Limpando caches...');
        $this->call('config:clear');
        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('route:clear');
    }

    private function generateKeyAndLinkStorage() {
        $this->newLine()->info('  ➔ Validando chave e link...');

        if ($this->appKeyIsMissingOrInvalid()) {
            $this->call('key:generate', [ '--force' => true ]);
        } else {
            $this->info('  ➔ Chave da aplicação já está configurada.');
        }

        $this->call('storage:link', [ '--force' => true ]);
    }

    private function npmInstallAndBuild() {
        $this->newLine()->info('  ➔ Instalando dependências do NPM e compilando assets do Vite...');
        Process::forever()->run('npm install && npm run build')->throw();
    }

    private function npmRunDev() {
        $this->newLine()->info('  ➔ Iniciando servidor de desenvolvimento (Vite)...');
        Process::forever()->run('npm run dev')->throw();
    }

    private function migrateFreshWithSeed() {
        $this->newLine(2)->info('  ➔ Resetando a base de dados e executando as migrações...');
        $this->call('migrate:fresh', [ '--seed' => true, '--force' => true ]);
    }

    private function flushAllRedis() {
        try {
            $this->newLine()->info('  ➔ Limpando Redis...');
            Redis::flushall();
        } catch (\Exception $e) {
            $this->warn('  ➔ Aviso: Não foi possível conectar ao Redis para limpeza (pode estar offline).');
        }
    }

    private function showUsersTable() {
        $this->newLine(2)->info('Credenciais de testes:');
        $this->table(
            ['Perfil', 'E-mail', 'Senha'],
            [
                ['Admin',  config('app.seeders.admin_email'),  config('app.seeders.admin_password')],
                ['Editor', config('app.seeders.editor_email'), config('app.seeders.editor_password')],
                ['Viewer', config('app.seeders.viewer_email'), config('app.seeders.viewer_password')],
            ]
        );
        $this->newLine();
    }

    private function appKeyIsMissingOrInvalid(): bool {
        $key = config('app.key');

        if (!is_string($key) || $key === '') {
            return true;
        }

        if (str_starts_with($key, 'base64:')) {
            $decodedKey = base64_decode(substr($key, 7), true);

            if ($decodedKey === false) {
                return true;
            }

            $key = $decodedKey;
        }

        return !Encrypter::supported($key, config('app.cipher'));
    }

}
