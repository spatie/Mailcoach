<x-mailcoach::layout :title="__mc('Forgot password?')" hide-footer hide-nav>
    <div class="flex flex-col gap-6 justify-center mt-12">
        <div class="w-20 mx-auto">
            @include('mailcoach::app.layouts.partials.logoSvg')
        </div>
        <x-mailcoach::fieldset class="w-full max-w-md mx-auto" card :legend="__mc('Forgot password?')">
            <form class="form-grid" method="POST" action="{{ route('password.email') }}">
                @csrf

                <x-mailcoach::text-field
                    :label="__mc('Email')"
                    name="email"
                    type="email"
                    autofocus
                    autocomplete="email"
                    required
                />

                <x-mailcoach::form-buttons>
                    <x-mailcoach::button :label="__mc('Send password reset link')" />
                </x-mailcoach::form-buttons>
            </form>
        </x-mailcoach::fieldset>
    </div>
</x-mailcoach::layout>
