<?php

namespace App\Support;

use Illuminate\Contracts\Config\Repository;
use Spatie\Mailcoach\Support\Editor\TextEditor;
use Spatie\MailcoachMonaco\MonacoEditor;
use Spatie\MailcoachUnlayer\UnlayerEditor;
use Spatie\Valuestore\Valuestore;

class EditorConfiguration
{
    private Valuestore $valuestore;

    private Repository $config;

    public function __construct(
        Valuestore $valuestore,
        Repository $config
    ) {
        $this->valuestore = $valuestore;

        $this->config = $config;
    }

    public function switchDefaultEditor(string $editorClassName)
    {
        $this->valuestore->put('editor', $editorClassName);
    }

    public function registerConfigValues()
    {
        $editorClassName = $this->valuestore->get('editor');

        if (!class_exists($editorClassName)) {
            return;
        }

        $this->config->set('mailcoach.editor', $editorClassName);
    }

    public function getCurrentEditor()
    {
        return config('mailcoach.editor');
    }

    public function getAvailableEditors()
    {
        return [
            'Text' => TextEditor::class,
            'Unlayer' => UnlayerEditor::class,
            'Monaco' => MonacoEditor::class,
        ];
    }
}
