<?php

namespace App\Http\App\Controllers\Settings;

use App\Http\App\Requests\UpdateEditorRequest;
use App\Support\Cache;
use App\Support\EditorConfiguration;
use Illuminate\Support\Facades\Artisan;

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

        Cache::clear();

        return back();
    }
}
