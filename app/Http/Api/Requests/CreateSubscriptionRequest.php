<?php

namespace App\Http\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'list_uuid' => 'required|exists:email_lists,uuid|bail',
            'email' => ['required', 'email:rfc'],
            'extra_attributes' => 'nullable|array',
        ];
    }
}
