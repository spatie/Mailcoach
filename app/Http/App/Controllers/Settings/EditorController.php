<?php

namespace App\Http\App\Controllers\Settings;

use App\Http\App\Requests\UpdateEditorRequest;
use App\Support\ConfigCache;
use App\Support\EditorConfiguration\EditorConfiguration;
use Illuminate\Support\Facades\Artisan;

class EditorController
{
    public function edit(EditorConfiguration $editorConfiguration)
    {
        return view('app.settings.editor.edit', compact('editorConfiguration'));
    }

    public function update(UpdateEditorRequest $request, EditorConfiguration $editorConfiguration)
    {
        $editorConfiguration->put($request->validated());

        flash()->success(__('The editor has been updated.'));

        ConfigCache::clear();

        Artisan::call('view:clear');

        return back();
    }
}
