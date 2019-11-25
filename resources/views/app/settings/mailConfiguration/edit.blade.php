@extends('app.settings.mailConfiguration.layouts.mailConfiguration', ['title' => 'Mail configuration'])

@section('mailConfiguration')

    TODO: add settings chooser

    @include('app.settings.mailConfiguration.partials.mailgun')
    {{-- @include('app.settings.mailConfiguration.partials.smtp') --}}

@endsection
