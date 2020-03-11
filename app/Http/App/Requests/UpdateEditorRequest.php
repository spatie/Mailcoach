<?php

namespace App\Http\App\Requests;

use App\Support\EditorConfiguration\EditorConfiguration;
use App\Support\MailConfiguration\EditorConfigurationDriverRepository;
use App\Support\MailConfiguration\MailConfigurationDriverRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEditorRequest extends FormRequest
{
    public function rules()
    {
        $editorConfigurationDriverRepository = new EditorConfigurationDriverRepository();

        return array_merge([
            'editor' => ['required','bail',  Rule::in($editorConfigurationDriverRepository->getSupportedEditors())]
        ], $this->getEditorSpecificValidationRules($editorConfigurationDriverRepository));
    }

    public function getEditorSpecificValidationRules(EditorConfigurationDriverRepository $editorConfigurationDriverRepository): array
    {
        if (! $editor = $editorConfigurationDriverRepository->getForEditor($this->editor ?? '')) {
            return [];
        }

        return $editor->validationRules();
    }
}
