@extends('mailcoach::app.layouts.app', ['title' => 'Account'])

@section('content')
    <main class="layout-main">
        <section class="card card-grid">
            <nav class="breadcrumbs">
                <ul>
                    <li>
                        <a href="{{ route('account') }}">
                            Account
                        </a>
                    </li>
                </ul>
            </nav>

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

            @yield('account')
        </section>
    </main>
@endsection
