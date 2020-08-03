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
    Here come the tokens
@endsection
