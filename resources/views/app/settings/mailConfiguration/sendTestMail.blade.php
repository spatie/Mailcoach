@extends('app.settings.mailConfiguration.layouts.mailConfiguration', ['title' => 'Mail configuration'])

@section('mailConfiguration')
    <form method="POST">
        <x-text-field label="Email" name="email" type="email"/>

        <button type="submit" class="button">
            Send test mail
        </button>
    </form>
@endsection
