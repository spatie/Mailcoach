<?php

namespace App\Http\App\Requests;

use App\Support\MailConfiguration\MailConfigurationDriverRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
