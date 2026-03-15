<?php

namespace App\Providers;


use Illuminate\Support\{ ServiceProvider, Facades\Gate, Facades\App };
use App\Models\Pokemon;
use App\Policies\PokemonPolicy;
use App\Contracts\PokeApiInterface;
use App\Services\PokeApiClient;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PokeApiInterface::class, PokeApiClient::class);
    }

    public function boot(): void
    {
        App::setLocale('pt_BR');
        Gate::policy(Pokemon::class, PokemonPolicy::class);
    }
}
