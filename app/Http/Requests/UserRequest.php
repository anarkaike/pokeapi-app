<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\{ Rule, Rules\Password };
use App\{ Enums\UserRole, Models\User };

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === UserRole::ADMIN;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'role' => ['required', Rule::enum(UserRole::class)],
            fn ($attribute, $value, $fail) =>
            $value !== $this->user()->role->value && !$this->user()->isAdmin()
                ? $fail('Você não tem permissão para alterar cargos.')
                : null,
            'password' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'confirmed',
                Password::defaults(),
            ],
        ];
    }
}
