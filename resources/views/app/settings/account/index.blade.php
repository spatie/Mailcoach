@extends('app.settings.account.layouts.account')

@section('account')
    <form
        class="card-grid"
        action="{{ route('account') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-text-field label="Email" name="email" type="email" :value="$user->email" required />
        <x-text-field label="Name" name="name" :value="$user->name" required />

        <button type="submit" class="button">
            Save
        </button>
    </form>
@endsection
