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

        return array_merge([
          'driver' => ['required','bail',  Rule::in($mailConfigurationDriverRepository->getSupportedDrivers())]
        ], $this->getDriverSpecificValidationRules($mailConfigurationDriverRepository));
    }

    public function getDriverSpecificValidationRules(MailConfigurationDriverRepository $mailConfigurationDriverRepository): array
    {
        if (! $driver = $mailConfigurationDriverRepository->getForDriver($this->driver ?? '')) {
            return [];
        }

        return $driver->validationRules();
    }
}
