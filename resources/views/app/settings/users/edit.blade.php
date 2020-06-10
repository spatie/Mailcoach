@extends('mailcoach::app.layouts.app', ['title' => $user->name])

@section('header')
<nav>
    <ul class="breadcrumbs">
        <li>
            <a href="{{ route('users') }}">{{ __('Users') }}</a>
        </li>
        <li>
            {{ $user->email }}
        </li>
    </ul>
</nav>
@endsection

@section('content')
<section class="card">

    <form class="form-grid" action="{{ route('users.edit', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <x-text-field type="email" :label="__('Email')" name="email" :value="$user->email" required />

        <x-text-field :label="__('Name')" name="name" :value="$user->name" required />

        <div class="form-buttons">
            <button type="submit" class="button">
                <x-icon-label icon="fa-user" :text="__('Save user')" />
            </button>
        </div>
    </form>
</section>
@endsection
