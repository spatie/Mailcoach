<?php

namespace App\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTokenRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
