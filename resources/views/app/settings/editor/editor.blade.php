@extends('mailcoach::app.layouts.app', [
    'title' => 'Editor configuration'
])
@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>Editor</li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card card-grid">
        <form
            class="form-grid"
            action="{{ route('editor') }}"
            method="POST"
            data-cloak
        >
            @csrf

            <x-select-field
                label="Editor"
                name="editor"
                :value="$editorConfiguration->getCurrentEditorName()"
                :options="$editorConfiguration->getAvailableEditors()"
                data-conditional="editor"
            />

            <div class="form-grid" data-conditional-editor="text">
                @include('app.settings.mailConfiguration.partials.text')
            </div>

            <div class="form-grid" data-conditional-editor="unlayer">
                @include('app.settings.mailConfiguration.partials.unlayer')
            </div>

            <div class="form-grid" data-conditional-editor="monaco">
                @include('app.settings.mailConfiguration.partials.monaco')
            </div>

            <div class="form-buttons">
                <button class="button">
                    <x-icon-label icon="fa-server" text="Save configuration"/>
                </button>
            </div>
        </form>
    </section>
@endsection
