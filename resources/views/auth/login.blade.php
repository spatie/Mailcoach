@extends('auth.layouts.master', ['title' => 'Login'])

@section('content')
    <h1 class="markup-h1">
        Login to Mailcoach
    </h1>

    <form class="mt-6 form-grid" method="POST" action="{{ route('login') }}">
        @csrf

        <a class="link" href="{{ route('forgot-password') }}">Forgot password?</a>

        <div class="form-row">
            @error('email')
                <p class="form-error" role="alert">
                {{ $message }}
                </p>
            @enderror

            <label for="email" class="label">{{ __('Email') }}</label>

            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <div class="form-row">
            @error('password')
                <p class="form-error" role="alert">
                {{ $message }}
                </p>
            @enderror

            <label for="password" class="label">{{ __('Password') }}</label>

            <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
        </div>

        <div class="form-row">
            <label class="checkbox-label" for="remember">
                <input class="checkbox" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                    {{ __('Remember me next time') }}
            </label>
        </div>

        <div class="form-buttons">
            <button type="submit" class="button">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
            <a class="link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </div>
    </form>
@endsection
