<?php

namespace App\Enums;

enum UserRole: string
{
    /**
     * The possible roles for a user.
     */
    case ADMIN  = 'admin';
    case EDITOR = 'editor';
    case VIEWER = 'viewer';

    /**
     * Get all possible values of the enum.
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}