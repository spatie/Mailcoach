@extends('auth.layout', ['title' => __mc('Forgot password?')])
@section('content')
    <h1 class="markup-h2">{{ __mc('Forgot password?') }}</h1>

    <form class="form-grid" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-field">
            @error('email')
            <p class="form-error" role="alert">
                {{ $message }}
            </p>
            @enderror

            <label for="email" class="label">{{ __mc('Email') }}</label>

            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <x-mailcoach::form-buttons>
            <x-mailcoach::button :label="__mc('Send password reset link')" />
        </x-mailcoach::form-buttons>
    </form>
@endsection
