<?php

namespace App\Support\EditorConfiguration;

use App\Support\EditorConfiguration\Editors\EditorConfigurationDriver;
use App\Support\EditorConfiguration\Editors\MonacoEditorConfigurationDriver;
use App\Support\EditorConfiguration\Editors\TextareaEditorConfigurationDriver;
use App\Support\EditorConfiguration\Editors\UnlayerEditorConfigurationDriver;

class EditorConfigurationDriverRepository
{
    protected array $editors = [
        'Textarea' => TextareaEditorConfigurationDriver::class,
        'Unlayer' => UnlayerEditorConfigurationDriver::class,
        'Monaco' => MonacoEditorConfigurationDriver::class,
    ];

    public function getSupportedEditors(): array
    {
        return array_keys($this->editors);
    }

    public function getForEditor(string $editorLabel): EditorConfigurationDriver
    {
        $configuredEditor =  collect($this->editors)
            ->map(fn (string $editorClass) => app($editorClass))
            ->first(fn (EditorConfigurationDriver $editor) => $editor->label() === $editorLabel);

        return $configuredEditor ?? app(TextareaEditorConfigurationDriver::class);
    }
}
