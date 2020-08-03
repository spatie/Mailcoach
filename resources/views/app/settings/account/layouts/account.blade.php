@extends('mailcoach::app.layouts.app', [
    'title' => isset($titlePrefix) ?  $titlePrefix . ' | ' . __('Account') : __('Account')
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
                <x-icon-label icon="fa-user" :text="__('User details')" />
            </x-navigation-item>
            <x-navigation-item :href="route('password')">
                <x-icon-label icon="fa-lock" :text="__('Password')" />
            </x-navigation-item>
            <x-navigation-item :href="route('tokens')">
                <x-icon-label icon="fa-key" :text="__('API Tokens')" />
            </x-navigation-item>
        </ul>
    </nav>

    <section class="card">
        @yield('account')
    </section>
@endsection
