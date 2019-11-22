@extends('mailcoach::app.layouts.app', ['title' => 'Mail configuration'])

@section('header')
    <nav class="breadcrumbs">
        <ul>
            <li>
                Mail configuration
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <nav>
        <ul class="tabs">
            <x-navigation-item :href="route('mailConfiguration')">
                Mail configuration
            </x-navigation-item>
            <x-navigation-item :href="route('sendTestMail')">
                Send test mail
            </x-navigation-item>
        </ul>
    </nav>

    <section class="card card-grid">
        @yield('mailConfiguration')
    </section>
@endsection
