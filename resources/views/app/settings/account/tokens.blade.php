@extends('app.settings.account.layouts.account', ['titlePrefix' => __('Tokens')])

@section('breadcrumbs')
    <li>
        <a href="{{ route('account') }}">
            {{ __('Account') }}
        </a>
    </li>
    <li>{{ __('Tokens') }}</li>
@endsection

@section('account')

    <x-help>
        You can use tokens to authenticate against our the Mailcoach. You'll find more info in <a href="https://mailcoach.app/docs">our docs</a>.
    </x-help>

    <form class="mt-6"
        action="{{ route('tokens.create') }}"
        method="POST"
        data-dirty-check
    >
        @csrf

        <div class="flex items-end">
            <div class="flex-grow max-w-xl">
                <x-text-field
                    :label="__('Token name')"
                    name="name"
                    :placeholder="__('My API token')"

                    :required="true"
                    type="text"
                />
            </div>

            <button type="submit" class="ml-2 button">
                <x-icon-label icon="fa-key" :text="__('Create token')"/>
            </button>
        </div>

        @error('emails')
        <p class="form-error">{{ $message }}</p>
        @enderror
    </form>

    @if (session()->has('newToken'))
        Your new token: {{ session()->get('newToken') }}
    @endif

    <table class="table">
        <thead>
        <tr>
            <x-th sort-by="name" sort-default>{{ __('Name') }}</x-th>
            <x-th sort-by="-name">{{ __('Created at') }}</x-th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tokens as $token)
            <tr>
                <td>{{ $token->name }}</td>
                <td>{{ $token->created_at }}</td>
                <td class="td-action">
                        <div class="dropdown" data-dropdown>
                            <button class="icon-button" data-dropdown-trigger>
                                <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                            </button>
                            <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                <li>
                                    <x-form-button :action="route('tokens.delete', $token)" method="DELETE" data-confirm>
                                        <x-icon-label icon="fa-trash-alt" :text="__('Delete')" :caution="true" />
                                    </x-form-button>
                                </li>
                            </ul>
                        </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
