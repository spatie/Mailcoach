@extends('app.settings.transactionalMailConfiguration.layouts.mailConfiguration', ['title' => 'Transactional mail configuration'])

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

        @if(! $mailConfiguration->isValid())
            <x-help>
                You haven't configured a transactional mailer yet. Mailcoach will send confirmation mails and welcome mails
                using the regular mailer.
            </x-help>
        @endif

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

        <div class="form-buttons">
            <button class="button">
                <x-icon-label icon="fa-server" text="Save configuration"/>
            </button>
        </div>
    </form>

    @if($mailConfiguration->isValid())
        <form
            class="form-grid"
            action="{{ route('deleteTransactionalMailConfiguration') }}"
            method="POST"
            data-cloak
        >
            @csrf
            @method('DELETE')
            <button class="button">
                <x-icon-label icon="fa-server" text="Delete configuration"/>
            </button>
        </form>
    @endif
@endsection
