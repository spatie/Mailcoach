@extends('app.settings.mailConfiguration.layouts.mailConfiguration', ['title' => 'Mail configuration'])

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
            label="Driver"
            name="driver"
            :value="$mailConfiguration->driver"
            :options="[
                'ses' => 'Amazon SES',
                'sendgrid' => 'SendGrid',
                'mailgun' => 'Mailgun',
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

        <div class="form-grid" data-conditional-driver="smtp">
            @include('app.settings.mailConfiguration.partials.smtp')
        </div>

        <div class="form-buttons">
            <button class="button">
                <x-icon-label icon="fa-cogs" text="Save configuration" />
            </button>
        </div>
    </form>
@endsection
