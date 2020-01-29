@extends('app.settings.mailConfiguration.layouts.mailConfiguration', ['titlePrefix' => 'Send test mail'])

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
            <x-text-field placeholder="Email(s) comma separated" label="Email" name="email" type="email"/>
        </div>

        <button type="submit" class="ml-2 button">
            <x-icon-label icon="fa-paper-plane" text="Send test mail" />
        </button>
    </form>
@endsection
