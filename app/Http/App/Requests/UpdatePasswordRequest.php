<?php

namespace App\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => 'required|password',
            'password' => 'min:6|confirmed',
        ];
    }
}
