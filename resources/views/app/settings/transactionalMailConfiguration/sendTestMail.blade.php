@extends('app.settings.transactionalMailConfiguration.layouts.mailConfiguration', ['titlePrefix' => 'Send test mail'])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailConfiguration') }}">
            Mail configuration
        </a>
    </li>
    <li>Send test mail</li>
@endsection

@section('mailConfiguration')
    <form class="flex items-end justify-start" method="POST">
        <div class="flex-grow max-w-lg">
            <x-text-field placeholder="From Email" label="From Email" name="from_email" type="email" :value="auth()->user()->email"/>
        </div>

        <div class="flex-grow max-w-lg ml-2">
            <x-text-field placeholder="To Email" label="To Email" name="to_email" type="email"/>
        </div>

        <button type="submit" class="ml-2 button">
            <x-icon-label icon="fa-paper-plane" text="Send test mail" />
        </button>
    </form>
@endsection
