@extends('app.settings.account.layouts.account')

@section('breadcrumbs')
    <li>
        <a href="{{ route('account') }}">
            Account
        </a>
    </li>
    <li>Password</li>
@endsection

@section('account')
    <form
        class="form-grid"
        action="{{ route('password') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-text-field label="Current password" name="current_password" type="password"  required />

        <x-text-field label="New password" name="password" type="password"  required />
        <x-text-field label="Confirm new password" name="password_confirmation" type="password" required />

        <div class="form-buttons">
            <button type="submit" class="button">
                <x-icon-label icon="fa-lock" text="Update password" />
            </button>
        </div>
    </form>
@endsection
