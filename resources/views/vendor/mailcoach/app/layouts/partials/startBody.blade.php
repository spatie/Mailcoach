@if(! app(\App\Support\MailConfiguration\MailConfiguration::class)->isValid())
    <div>
        Your mail configuration is invalid. Head over to the <a href="{{ route('mailConfiguration') }}">mail configuration</a> screen.
    </div>
@endif
