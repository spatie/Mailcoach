@extends('app.settings.mailConfiguration.layouts.mailConfiguration', ['title' => 'Mail configuration'])

@section('mailConfiguration')
    <form
        class="card-grid"
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
                'mailgun' => 'Mailgun',
                'smtp' => 'SMTP',
            ]"
            data-conditional="driver"
        />

        <div data-conditional-driver="ses">
            @include('app.settings.mailConfiguration.partials.ses')
        </div>
        <div data-conditional-driver="mailgun">
            @include('app.settings.mailConfiguration.partials.mailgun')
        </div>
        <div data-conditional-driver="smtp">
            @include('app.settings.mailConfiguration.partials.smtp')
        </div>

        <button class="button">
            Save
        </button>
    </form>
@endsection
