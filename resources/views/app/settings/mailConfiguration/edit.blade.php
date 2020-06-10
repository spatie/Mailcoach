@extends('app.settings.mailConfiguration.layouts.mailConfiguration', ['title' => __('Mail configuration')])

@section('breadcrumbs')
    <li>{{ __('Mail configuration') }}</li>
@endsection

@section('mailConfiguration')
    <form
        class="form-grid"
        action="{{ route('mailConfiguration') }}"
        method="POST"
        data-cloak
    >
        @csrf
        @method('PUT')

        <x-select-field
            :label="__('Driver')"
            name="driver"
            :value="$mailConfiguration->driver"
            :options="[
                'ses' => 'Amazon SES',
                'sendgrid' => 'SendGrid',
                'mailgun' => 'Mailgun',
                'postmark' => 'Postmark',
                'smtp' => 'SMTP',
            ]"
            data-conditional="driver"
        />

        <div class="form-grid" data-conditional-driver="ses">
            @include('app.settings.mailConfiguration.partials.ses')
        </div>

        <div class="form-grid" data-conditional-driver="mailgun">
            @include('app.settings.mailConfiguration.partials.mailgun')
        </div>

        <div class="form-grid" data-conditional-driver="sendgrid">
            @include('app.settings.mailConfiguration.partials.sendgrid')
        </div>

        <div class="form-grid" data-conditional-driver="postmark">
            @include('app.settings.mailConfiguration.partials.postmark')
        </div>

        <div class="form-grid" data-conditional-driver="smtp">
            @include('app.settings.mailConfiguration.partials.smtp')
        </div>

        <x-text-field :label="__('Default from mail')" name="default_from_mail" type="text" :value="$mailConfiguration->default_from_mail"/>

        <div class="form-buttons">
            <button class="button">
                <x-icon-label icon="fa-server" :text="__('Save configuration')" />
            </button>
        </div>
    </form>
@endsection
