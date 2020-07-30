<?php

namespace App\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppConfigurationRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge([
            'name' => 'required',
            'url' => 'required|url',
        ]);
    }
}
