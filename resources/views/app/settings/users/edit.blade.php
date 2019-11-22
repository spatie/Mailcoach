@extends('mailcoach::app.layouts.app', ['title' => $user->name])

@section('header')
    <nav class="breadcrumbs">
        <ul>
            <li>
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li>
                {{ $user->email }}
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card card-grid">

        <form
            class="card-grid"
            action="{{ route('users.edit', $user) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <x-text-field type="email" label="Email" name="email" :value="$user->email" required/>

            <x-text-field label="Name" name="name" :value="$user->name" required/>

            <div class="buttons">
                <button type="submit" class="button">
                    Save
                </button>
            </div>
        </form>
    </section>
@endsection
