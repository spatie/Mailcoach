@extends('app.settings.account.layouts.account')

@section('breadcrumbs')
    <li>{{ __('Account') }}</li>
@endsection

@section('account')
    <form
        class="form-grid"
        action="{{ route('account') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-text-field :label="__('Email')" name="email" type="email" :value="$user->email" required />
        <x-text-field :label="__('Name')" name="name" :value="$user->name" required />

        <div class="form-buttons">
            <button type="submit" class="button">
                <x-icon-label icon="fa-user" :text="__('Save user')" />
            </button>
        </div>
    </form>
@endsection
