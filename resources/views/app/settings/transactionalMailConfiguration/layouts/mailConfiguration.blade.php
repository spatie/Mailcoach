@extends('mailcoach::app.layouts.app', [
    'title' => isset($titlePrefix) ?  $titlePrefix . ' | Transactional Mail configuration' : 'Transactional Mail configuration'
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
                <x-icon-label icon="fa-server" text="Transactional Mail configuration" />
            </x-navigation-item>
            <x-navigation-item :href="route('sendTransactionalTestEmail')">
                <x-icon-label icon="fa-paper-plane" text="Send transactional test mail" />
            </x-navigation-item>
        </ul>
    </nav>

    <section class="card card-grid">
        @yield('mailConfiguration')
    </section>
@endsection
