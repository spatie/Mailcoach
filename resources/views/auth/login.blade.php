@extends('auth.layout', ['title' => __mc('Log in')])

@section('content')
    <h1 class="markup-h2">{{ __mc('Log in') }}</h1>

    <form class="form-grid" method="POST" action="{{ route('login') }}">
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

        <div class="form-field">
            @error('password')
            <p class="form-error" role="alert">
                {{ $message }}
            </p>
            @enderror

            <label for="password" class="label">{{ __mc('Password') }}</label>

            <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">
        </div>

        <div class="form-field">
            <label class="checkbox-label" for="remember">
                <input class="checkbox" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                {{ __mc('Remember me next time') }}
            </label>
        </div>

        <x-mailcoach::form-buttons>
            <x-mailcoach::button :label="__mc('Log in')" />

            @if (Route::has('mailcoach.forgot-password'))
                <a class="link ml-2" href="{{ route('forgot-password') }}">
                    {{ __mc('Forgot Your Password?') }}
                </a>
            @endif
        </x-mailcoach::form-buttons>
    </form>
@endsection
