@extends('app.settings.transactionalMailConfiguration.layouts.mailConfiguration', ['title' => __('Transactional mail configuration')])

@section('breadcrumbs')
    <li>{{ __('Transactional mail configuration') }}</li>
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

        @if(! $mailConfiguration->isValid())
            <div class="alert alert-warning max-w-xl">
                {{ __("You haven't configured a transactional mailer yet. Mailcoach will send confirmation mails and welcome mails using the regular mailer.") }}
            </div>
        @endif

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

        <div class="form-buttons">
            <button class="button">
                <x-icon-label icon="fa-server" :text="__('Save configuration')"/>
            </button>
        </div>
    </form>

    @if($mailConfiguration->isValid())
        <form
            class="mt-8"
            action="{{ route('deleteTransactionalMailConfiguration') }}"
            method="POST"
            data-cloak
        >
            @csrf
            @method('DELETE')
            <div class="form-buttons">
                <button class="text-red-400 hover:text-red-500">
                    <x-icon-label caution="true" icon="fa-trash" :text="__('Delete configuration')"/>
                </button>
            </div>
        </form>
    @endif
@endsection

