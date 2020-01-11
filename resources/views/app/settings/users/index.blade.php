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
    <section class="card">
        <div class="table-actions">
            <button class="button" data-modal-trigger="create-template">
                <x-icon-label icon="fa-user" text="Create new user" />
            </button>

            <x-modal title="Create user" name="create-template" :open="$errors->any()">
                @include('app.settings.users.partials.create')
            </x-modal>

            <div class=table-filters>
                <x-search placeholder="Filter users…" />
            </div>
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
                        <a href="{{ $user->id === auth()->user()->id ? route('account') : route('users.edit', $user) }}">
                            {{ $user->email }}
                        </a>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td class="td-action">
                        @if ($user->id !== auth()->user()->id)
                        <div class="dropdown" data-dropdown>
                            <button class="icon-button" data-dropdown-trigger>
                                <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                            </button>
                            <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                <li>
                                    <x-form-button :action="route('users.delete', $user)" method="DELETE" data-confirm>
                                        <x-icon-label icon="fa-trash-alt" text="Delete" :caution="true" />
                                    </x-form-button>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <x-table-status name="user" :paginator="$users" :total-count="$totalUsersCount" :show-all-url="route('users')">
        </x-table-status>
@endsection
