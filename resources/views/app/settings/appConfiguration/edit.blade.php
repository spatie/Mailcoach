@extends('mailcoach::app.layouts.app', [
    'title' => __('App configuration')
])
@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>{{ __('App') }}</li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card card-grid">
        <form
            class="form-grid"
            action="{{ route('appConfiguration') }}"
            method="POST"
            data-cloak
        >
            @method('PUT')
            @csrf

            <x-text-field name="name" id="name" :label="__('App name')" :value="$appConfiguration->name ?? config('app.name')" />
            <x-text-field name="url" id="url" :label="__('App url')" :value="$appConfiguration->url ?? config('app.url')" />

            <div class="form-buttons">
                <button class="button">
                    <x-icon-label icon="fa-code" :text="__('Save')"/>
                </button>
            </div>
        </form>
    </section>
@endsection
