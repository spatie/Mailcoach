@extends('app.settings.account.layouts.account')

@section('account')
    <form
        class="card-grid"
        action="{{ route('password') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-text-field label="Current password" name="current_password" type="password"  required />

        <x-text-field label="New password" name="password" type="password"  required />
        <x-text-field label="Confirm new password" name="password_confirmation" type="password" required />

        <button type="submit" class="button">
            Update password
        </button>
    </form>
@endsection
