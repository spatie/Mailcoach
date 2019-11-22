@extends('mailcoach::app.layouts.app', ['title' => $user->name])

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
                    <li>{{ $user->name }}</li>
                </ul>
            </nav>

            <form
                class="card-grid"
                action="{{ action([\App\Http\App\Controllers\Settings\Users\UpdateUserController::class, 'update'], $user) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <x-text-field type="email" label="Email" name="email" :value="$user->email" required />

                <x-text-field label="Name" name="name" :value="$user->name" required />

                <div class="buttons">
                    <button type="submit" class="button">
                        Save
                    </button>
                </div>
            </form>

            <form
                class="card-grid"
                action="{{ action(\App\Http\App\Controllers\Settings\Users\DestroyUserController::class, $user) }}"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button class="link-delete">
                    Delete
                </button>
            </form>
        </section>
    </main>
@endsection
