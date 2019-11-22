@extends('app.settings.mailConfiguration.layouts.mailConfiguration', ['title' => 'Mail configuration'])

@section('mailConfiguration')
    <form
        class="card-grid"
        action="{{ route('mailConfiguration') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-text-field label="Mail host" name="mail_host" type="text" :value="$mailConfiguration->mail_host"/>
        <x-text-field label="Mail port" name="mail_port" type="text" :value="$mailConfiguration->mail_port"/>
        <x-text-field label="Mail username" name="mail_username" type="text"
                      :value="$mailConfiguration->mail_username"/>
        <x-text-field label="Mail password" name="mail_password" type="text"
                      :value="$mailConfiguration->mail_password"/>

        <button type="submit" class="button">
            Save
        </button>
    </form>
@endsection
