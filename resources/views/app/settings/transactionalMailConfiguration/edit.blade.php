@extends('app.settings.transactionalMailConfiguration.layouts.mailConfiguration', ['title' => 'Mail configuration'])

@section('breadcrumbs')
    <li>Transactional mail configuration</li>
@endsection

@section('mailConfiguration')
    <form
        class="form-grid"
        action="{{ route('transactionalMailConfiguration') }}"
        method="POST"
        data-cloak
    >
        @csrf
        @method('PUT')

        <x-select-field
            label="Driver"
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
            @include('app.settings.transactionalMailConfiguration.partials.ses')
        </div>

        <div class="form-grid" data-conditional-driver="mailgun">
            @include('app.settings.transactionalMailConfiguration.partials.mailgun')
        </div>

        <div class="form-grid" data-conditional-driver="sendgrid">
            @include('app.settings.transactionalMailConfiguration.partials.sendgrid')
        </div>

        <div class="form-grid" data-conditional-driver="postmark">
            @include('app.settings.transactionalMailConfiguration.partials.postmark')
        </div>

        <div class="form-grid" data-conditional-driver="smtp">
            @include('app.settings.transactionalMailConfiguration.partials.smtp')
        </div>

        <x-text-field label="Default from mail" name="default_from_mail" type="text" :value="$mailConfiguration->default_from_mail"/>

        <div class="form-buttons">
            <button class="button">
                <x-icon-label icon="fa-server" text="Save configuration" />
            </button>
        </div>
    </form>
@endsection
