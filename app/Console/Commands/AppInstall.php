<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\{ Redis, Process };

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa o setup completo da aplicação (Clear Cache, Generate Key, Link Storage, Migrate Fresh, Seed)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->newLine()->alert('Iniciando o setup da PokéAPI App');

        $this->clearAllCaches();
        $this->generateKeyAndLinkStorage();
        $this->npmInstallAndBuild();
        $this->migrateFreshWithSeed();
        $this->flushAllRedis();

        $this->newLine(2)->info('✅ Aplicação pronta para uso em: ' . config('app.url'));

        $this->showUsersTable();
    }

    private function clearAllCaches() {
        $this->info('  ➔ Limpando caches...');
        $this->call('config:clear');
        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('route:clear');
    }

    private function generateKeyAndLinkStorage() {
        $this->newLine()->info('  ➔ Gerando chave e link...');
        $this->call('key:generate');
        $this->call('storage:link');
    }

    private function npmInstallAndBuild() {
        $this->newLine()->info('  ➔ Instalando dependências do NPM...');
        Process::forever()->run('npm install')->throw();

        $this->newLine()->info('  ➔ Compilando assets do Vite...');
        Process::forever()->run('npm run build')->throw();
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

}
