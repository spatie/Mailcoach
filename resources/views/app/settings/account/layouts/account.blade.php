@extends('mailcoach::app.layouts.app', ['title' => 'Account'])

@section('header')
    <nav class="breadcrumbs">
        <ul>
            <li>
                Account
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <nav>
        <ul class="tabs">
            <x-navigation-item :href="route('account')">
                <x-icon-label icon="fa-user-circle" text="User details" />
            </x-navigation-item>
            <x-navigation-item :href="route('password')">
                <x-icon-label icon="fa-lock" text="Password" />
            </x-navigation-item>
        </ul>
    </nav>

    <section class="card">
        @yield('account')
    </section>
@endsection
