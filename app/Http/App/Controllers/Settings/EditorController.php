<?php

namespace App\Http\App\Controllers\Settings;

use App\Http\App\Requests\UpdateEditorRequest;
use App\Support\ConfigCache;
use App\Support\EditorConfiguration;

class EditorController
{
    public function edit(EditorConfiguration $editorConfiguration)
    {
        return view('app.settings.editor', compact('editorConfiguration'));
    }

    public function update(UpdateEditorRequest $request, EditorConfiguration $editorConfiguration)
    {
        $editorConfiguration->switchDefaultEditor($request->editor);

        flash()->success('The default editor has been updated.');

        ConfigCache::clear();

        return back();
    }
}
