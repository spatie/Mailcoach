<?php

namespace App\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc', $this->getUniqueRule()],
            'name' => 'required|string',
        ];
    }

    public function subscriberAttributes(): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'There already is a subscriber with this email.',
        ];
    }

    protected function getUniqueRule(): Unique
    {
        $rule = Rule::unique('users', 'email');

        if ($user = $this->route('user')) {
            $rule->ignore($user->id, 'id');
        }

        return $rule;
    }
}
