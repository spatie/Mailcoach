@extends('auth.layout', ['title' => __mc('Reset password')])
@section('content')
    <h1 class="markup-h2">{{ __mc('Reset Password') }}</h1>

    <form class="form-grid" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-field">
            <label for="email" class="label">{{ __mc('Email') }}</label>

            <div>
                {{ $email ?? old('email') }}
            </div>
        </div>

        <input id="email" type="hidden" class="input @error('email') is-invalid @enderror" name="email"
               value="{{ $email ?? old('email') }}" required autocomplete="email">

        <div class="form-field">
            @error('password')
            <p class="form-error" role="alert">
                {{ $message }}
            </p>
            @enderror

            <label for="password" class="label">{{ __mc('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                       name="password" autofocus required autocomplete="new-password">

            </div>
        </div>

        <div class="form-field">
            <label for="password-confirm"
                   class="label">{{ __mc('Confirm password') }}</label>

            <input id="password-confirm" type="password" class="input" name="password_confirmation"
                   required
                   autocomplete="new-password">
        </div>

        <x-mailcoach::form-buttons>
            <x-mailcoach::button :label="__mc('Reset Password')" />
        </x-mailcoach::form-buttons>
    </form>
@endsection
