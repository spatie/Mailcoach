@extends('mailcoach::app.layouts.app', ['title' => 'Create new user'])

@section('content')
    <main class="layout-main">
        <section class="card card-grid">
            <nav class="breadcrumbs">
                <ul>
                    <li>
                        <a href="{{ action(\App\Http\App\Controllers\Settings\Users\UsersIndexController::class) }}">
                            Users
                        </a>
                    </li>
                    <li>Create a new user</li>
                </ul>
            </nav>

            <form
                class="card-grid"
                action="{{ action([\App\Http\App\Controllers\Settings\Users\CreateUserController::class, 'store']) }}"
                method="POST"
            >
                @csrf

                @include('app.users.partials.form')
            </form>
        </section>
    </main>
@endsection
