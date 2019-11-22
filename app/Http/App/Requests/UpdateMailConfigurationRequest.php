<?php

namespace App\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMailConfigurationRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge([
          'driver' => ['required',  Rule::in(['smtp', 'mailgun'])]
        ], $this->getDriverSpecificRules());
    }

    protected function getDriverSpecificRules(): array
    {
        $driver = ucFirst($this->driver);

        if (! $driver) {
            return [];
        }

        $methodName = "get{$driver}Rules";

        return $this->$methodName;
    }

    protected function getSmtpRules()
    {
        return [
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
        ];
    }

    protected function getMailgunRules(): array
    {
        return [
            'mailgun_domain' => 'required',
            'mailgun_secret' => 'required',
            'mailgun_endpoint' => 'required',
            'mailgun_signing_secret' => 'required',
        ];
    }
}
