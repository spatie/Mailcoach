@extends('auth.layouts.master', ['title' => 'Request new password'])

@section('content')

    <h1 class="markup-h1">
        Request Mailcoach password
    </h1>

    <form class="mt-6 form-grid" method="POST" action="{{ route('password.email') }}">
        @csrf

        <a class="link" href="{{ route('login') }}">{{ __('To login page') }}</a>

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

        <div class="form-buttons">
            <button type="submit" class="button">
                <span class="icon-label">
                    <i
                    <span class="icon-label-text">{{ __('Send password reset link') }}</span>
                </span>
            </button>
        </div>
    </form>
@endsection
