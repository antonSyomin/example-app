<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Применяет правила валидации к запросу
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $userRoles = array_keys(config('models.users.roles', ['admin' => 'Админ']));

        return [
            'name' => 'sometimes|string|nullable|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'sometimes|email|nullable|unique:users,email',
            'password' => 'sometimes|string|max:255',
            'is_blocked' => 'sometimes|boolean',
            'role' => [
                'required',
                Rule::in($userRoles),
            ],
            'birthday' => 'sometimes|string|nullable',
        ];
    }
}