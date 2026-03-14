<x-guest-layout image="images/image2.png" imageAlt="Entrar no Sistema" imageClass="!h-[370px]">

    <div x-data="loginAutoFill()">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-3xl font-extrabold text-gray-900 mb-4">
            Login
        </h2>
        <p>Digite seu email e senha para acessar ou faça seu cadastro se ainda não possui conta.</p>

        <div class="flex items-center justify-center my-2 space-x-2">
            <span class="text-sm font-medium text-gray-700">Preencher com:</span>
            <x-secondary-button @click="fill('admin')" :border="false">
                {{ __('Admin') }}
            </x-secondary-button>
            <x-secondary-button @click="fill('editor')" :border="false">
                {{ __('Editor') }}
            </x-secondary-button>
            <x-secondary-button @click="fill('viewer')" :border="false">
                {{ __('Viewer') }}
            </x-secondary-button>
        </div>

        <form method="POST" action="{{ route('login') }}" class="mt-2">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" x-model="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Senha')" />

                <x-text-input id="password" x-model="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-5 space-x-2">
                <x-secondary-button href="{{ route('home') }}" border=''>
                    {{ __('← Voltar') }}
                </x-secondary-button>
                <x-secondary-button href="{{ route('register') }}">
                    {{ __('Criar Conta') }}
                </x-secondary-button>
                <x-primary-button class="ms-3">
                    {{ __('Acessar') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        function loginAutoFill() {
            return {
                email: '',
                password: '',
                fill(role) {
                    // Mapeamento dos dados que vêm do seu config/env do Laravel
                    const users = {
                        admin: {
                            email: @json(config('app.seeders.admin_email')),
                            password: @json(config('app.seeders.admin_password'))
                        },
                        editor: {
                            email: @json(config('app.seeders.editor_email')),
                            password: @json(config('app.seeders.editor_password'))
                        },
                        viewer: {
                            email: @json(config('app.seeders.viewer_email')),
                            password: @json(config('app.seeders.viewer_password'))
                        }
                    };

                    if (users[role]) {
                        this.email = users[role].email;
                        this.password = users[role].password;
                    }
                }
            }
        }
    </script>
</x-guest-layout>
