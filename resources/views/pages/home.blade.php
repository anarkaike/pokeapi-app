<x-guest-layout image="images/image.png" image-alt="Desafio Ipê.digital">

    <h2 class="text-3xl font-extrabold text-gray-900">
        Bem-vindo ao <span class="text-red-500">PokéApp</span>
    </h2>
    <p>Teste desenvolvido para o desafio técnico da Ipê.digital.</p>

    <p>
        Uma aplicação Laravel + Blade focada no consumo da PokéAPI,
        com três perfil de usuários: Admin, Editor e Viewer.
    </p>
    <p>
        ➜ <b>Viewer:</b> Apenas visualiza os dados.
        <br />
        ➜ <b>Editor:</b> Importa, sincroniza, visualiza e favorita/desfavorita Pokémons.
        <br />
        ➜ <b>Admin:</b> Tem acesso total, podendo gerenciar usuários, importar, sincronizar,
        favoritar/desfavoritar e excluir dados importados.
    </p>

    <div class="text-right space-x-2">
        <x-secondary-button href="{{ route('register') }}">
            {{ __('Criar Conta') }}
        </x-secondary-button>
        <x-primary-button href="{{ route('login') }}">
            {{ __('Acessar') }}
        </x-primary-button>
    </div>

</x-guest-layout>
