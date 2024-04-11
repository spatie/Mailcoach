<x-mailcoach::layout :title="__mc('Reset password')" hide-footer hide-nav>
    <div class="flex flex-col gap-6 justify-center mt-12">
        <div class="w-20 mx-auto">
            @include('mailcoach::app.layouts.partials.logoSvg')
        </div>
        <x-mailcoach::fieldset class="w-full max-w-md mx-auto" card :legend="__mc('Reset password')">
            <form class="form-grid" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <x-mailcoach::text-field
                    :label="__mc('Email')"
                    name="email"
                    type="email"
                    autocomplete="email"
                    :value="request('email') ?? old('email')"
                    required
                />

                <x-mailcoach::text-field
                    :label="__mc('Password')"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    required
                />

                <x-mailcoach::text-field
                    :label="__mc('Confirm password')"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                />

                <x-mailcoach::form-buttons>
                    <x-mailcoach::button :label="__mc('Reset Password')" />
                </x-mailcoach::form-buttons>
            </form>
        </x-mailcoach::fieldset>
    </div>
</x-mailcoach::layout>
