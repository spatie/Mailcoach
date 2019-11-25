<?php

namespace App\Http\App\Requests;

use App\Support\MailConfiguration\MailConfigurationDriverRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMailConfigurationRequest extends FormRequest
{
    public function rules(): array
    {
        $mailConfigurationDriverRepository = new MailConfigurationDriverRepository();

        $rules =  array_merge([
          'driver' => ['required','bail',  Rule::in($mailConfigurationDriverRepository->getSupportedDrivers())]
        ], $this->getDriverSpecificValidationRules($mailConfigurationDriverRepository));

        return $rules;
    }

    public function getDriverSpecificValidationRules(MailConfigurationDriverRepository $mailConfigurationDriverRepository): array
    {
        if (! $driver = $mailConfigurationDriverRepository->getForDriver($this->driver ?? '')) {
            return [];
        }

        return $driver->validationRules();
    }
}
