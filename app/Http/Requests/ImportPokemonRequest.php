<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ImportPokemonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do Pokémon é obrigatório para a importação.',
            'name.min'      => 'O nome deve ter pelo menos 3 caracteres.',
            'name.max'      => 'O nome não pode exceder 50 caracteres.',
        ];
    }
}
