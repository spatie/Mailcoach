<x-mailcoach::layout :title="__mc('Welcome')" hide-footer hide-nav>
    <div class="flex flex-col gap-6 justify-center mt-12">
        <div class="w-20 mx-auto">
            @include('mailcoach::app.layouts.partials.logoSvg')
        </div>
        <x-mailcoach::fieldset class="w-full max-w-md mx-auto" card :legend="__mc('Welcome')">
            <p>{{ __mc('Welcome to Mailcoach! Choose a password:') }}</p>
            <form class="form-grid" method="POST">
                @csrf

                <input type="hidden" name="email" value="{{ $user->email }}"/>

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
                    <x-mailcoach::button :label="__mc('Save password and login')" />
                </x-mailcoach::form-buttons>
            </form>
        </x-mailcoach::fieldset>
    </div>
</x-mailcoach::layout>
