<?php

namespace App\Services;

use App\Models\{User, Pokemon, Type, Ability, Move};
use App\Enums\UserRole;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    public function getStats(): array
    {
        //return Cache::remember('dashboard_stats', now()->addMinutes(0), function () {
            return [
                'users' => [
                    'admin'  => User::where('role', UserRole::ADMIN)->count(),
                    'editor' => User::where('role', UserRole::EDITOR)->count(),
                    'viewer' => User::where('role', UserRole::VIEWER)->count(),
                ],
                'pokemon' => [
                    'total'     => Pokemon::count(),
                    'types'     => Type::count(),
                    'abilities' => Ability::count(),
                    'moves'     => Move::count(),
                ],
            ];
        //});
    }

    public function clearCache(): void
    {
        Cache::forget('dashboard_stats');
    }
}
