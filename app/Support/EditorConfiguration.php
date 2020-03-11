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

    private $editorClasses = [
        'Textarea' => TextEditor::class,
        'Unlayer' => UnlayerEditor::class,
        'Monaco' => MonacoEditor::class,
    ];

    public function __construct(
        Valuestore $valuestore,
        Repository $config
    ) {
        $this->valuestore = $valuestore;

        $this->config = $config;
    }

    public function switchDefaultEditor(string $editorName): void
    {
        $editorClassName = $this->getAvailableEditors()[$editorName];

        $this->valuestore->put('editor', $editorClassName);
    }

    public function registerConfigValues(): void
    {
        $editorName = $this->valuestore->get('editor');

        if (! $editorName) {
            return;
        }

        $editorClassName = $this->editorClasses[$editorName];

        if (!class_exists($editorClassName)) {
            return;
        }

        $this->config->set('mailcoach.editor', $editorClassName);
    }

    public function getCurrentEditorClass(): string
    {
        return $this->editorClasses[$this->getCurrentEditorName()];
    }

    public function getCurrentEditorName(): string
    {
        return $this->valuestore->get('editor') ?? 'Text';
    }

    public function getAvailableEditors(): array
    {
        $editorNames = array_keys($this->editorClasses);

        return array_combine($editorNames, $editorNames);
    }
}
