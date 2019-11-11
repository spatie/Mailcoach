<?php

namespace App\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                Rule::unique('users')->ignore(auth()->user()->id),
            ],
            'name' => 'required',
        ];
    }
}
