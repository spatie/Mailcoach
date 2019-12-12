@extends('mailcoach::app.layouts.app', [
    'title' => isset($titlePrefix) ?  $titlePrefix . ' | Account' : 'Account'
])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            @yield('breadcrumbs')
        </ul>
    </nav>
@endsection

@section('content')
    <nav class="tabs">
        <ul>
            <x-navigation-item :href="route('account')">
                <x-icon-label icon="fa-user" text="User details" />
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
