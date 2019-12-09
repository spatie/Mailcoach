@extends('app.settings.account.layouts.account')

@section('account')
    <form
        class="form-grid"
        action="{{ route('account') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-text-field label="Email" name="email" type="email" :value="$user->email" required />
        <x-text-field label="Name" name="name" :value="$user->name" required />

        <div class="form-buttons">
            <button type="submit" class="button">
                <x-icon-label icon="fa-user" text="Save user" />
            </button>
        </div>
    </form>
@endsection
