@extends('mailcoach::app.layouts.app', ['title' => 'Users'])

@section('header')
    <nav class="breadcrumbs">
        <ul>
            <li>
                Users
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <main class="layout-main">
        <section class="card card-grid">
            <h1 class="markup-h1">Users</h1>

            <div class="flex justify-between">
                <button class="button" data-modal-trigger="create-template">
                    Create a new user
                </button>

                <x-modal title="Create user" name="create-template" :open="$errors->any()">
                    @include('app.settings.users.partials.create')
                </x-modal>

                <x-search placeholder="Filter users…"/>

                <input
                    type="text"
                    class="form-input w-64 rounded-full"
                    placeholder="Filter users…"
                >
            </div>

            <table class="table">
                <thead>
                <tr>
                    <x-th sort-by="email" sort-default>Email</x-th>
                    <x-th sort-by="-name">Name</x-th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="markup-links">
                            <a href="{{ route('users.edit', $user) }}">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if ($user->id !== auth()->user()->id)
                                <x-form-button
                                    :action="route('users.delete', $user)"
                                    method="DELETE"
                                    data-confirm
                                >
                                    Delete
                                </x-form-button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <x-table-status
                name="user"
                :paginator="$users"
                :total-count="$totalUsersCount"
                :show-all-url="route('users')"
            ></x-table-status>
    </main>
@endsection
