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
                Details
            </x-navigation-item>
            <x-navigation-item :href="route('password')">
                Password
            </x-navigation-item>
        </ul>
    </nav>

    <section class="card card-grid">
        @yield('account')
    </section>
@endsection
