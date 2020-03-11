<?php

namespace App\Http\App\Requests;

use App\Support\EditorConfiguration;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEditorRequest extends FormRequest
{
    public function rules()
    {
        /** @var \App\Support\EditorConfiguration $editorConfiguration */
        $editorConfiguration = app(EditorConfiguration::class);

        return [
            'editor' => ['required',  Rule::in($editorConfiguration->getAvailableEditors())]
        ];
    }
}
