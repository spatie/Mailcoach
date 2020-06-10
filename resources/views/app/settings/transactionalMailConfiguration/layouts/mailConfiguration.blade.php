@extends('mailcoach::app.layouts.app', [
    'title' => isset($titlePrefix) ?  $titlePrefix . ' | ' . __('Transactional mail configuration') : __('Transactional mail configuration')
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
            <x-navigation-item :href="route('transactionalMailConfiguration')">
                <x-icon-label icon="fa-server" :text="__('Transactional mail configuration')" />
            </x-navigation-item>
            <x-navigation-item :href="route('sendTransactionalTestEmail')">
                <x-icon-label icon="fa-paper-plane" :text="__('Send transactional test mail')" />
            </x-navigation-item>
        </ul>
    </nav>

    <section class="card card-grid">
        @yield('mailConfiguration')
    </section>
@endsection
