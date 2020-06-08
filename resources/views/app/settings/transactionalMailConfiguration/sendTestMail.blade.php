@extends('app.settings.transactionalMailConfiguration.layouts.mailConfiguration', ['titlePrefix' => __('Send test mail')])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailConfiguration') }}">
            {{ __('Transactional mail configuration') }}
        </a>
    </li>
    <li>{{ __('Send test mail') }}</li>
@endsection

@section('mailConfiguration')
    @if ($mailConfiguration->isValid())

    <form class="flex items-end justify-start" method="POST">
        <div class="flex-grow max-w-lg">
            <x-text-field :placeholder="__('From Email')" :label="__('From Email')" name="from_email" type="email" :value="auth()->user()->email"/>
        </div>

        <div class="flex-grow max-w-lg ml-2">
            <x-text-field :placeholder="__('To Email')" :label="__('To Email')" name="to_email" type="email"/>
        </div>

        <button type="submit" class="ml-2 button">
            <x-icon-label icon="fa-paper-plane" :text="__('Send test mail')" />
        </button>
    </form>
    @else
        <div class="alert alert-warning max-w-xl">
            {{ __("You haven't configured a transactional mailer yet.") }}
        </div>
    @endif
@endsection
