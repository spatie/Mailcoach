<x-mailcoach::layout :title="__mc('Login')" hide-footer hide-nav>
    <div class="flex flex-col gap-6 justify-center mt-12">
        <div class="w-20 mx-auto">
            @include('mailcoach::app.layouts.partials.logoSvg')
        </div>
        <x-mailcoach::fieldset class="w-full max-w-md mx-auto" card :legend="__mc('Log in')">
            <form class="form-grid" method="POST" action="{{ route('login') }}">
                @csrf

                <x-mailcoach::text-field
                    :label="__mc('Email')"
                    name="email"
                    type="email"
                    autofocus
                    autocomplete="email"
                    required
                />

                <x-mailcoach::text-field
                    :label="__mc('Password')"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                />

                <x-mailcoach::form-buttons>
                    <x-mailcoach::button :label="__mc('Log in')" />

                    @if (Route::has('forgot-password'))
                        <a class="ml-3" href="{{ route('forgot-password') }}">
                            <x-mailcoach::button-link
                                :label="__mc('Forgot Your Password?')"
                            />
                        </a>
                    @endif
                </x-mailcoach::form-buttons>
            </form>
        </x-mailcoach::fieldset>
    </div>
</x-mailcoach::layout>
