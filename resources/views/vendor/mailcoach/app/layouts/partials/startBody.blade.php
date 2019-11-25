@if(! app(\App\Support\MailConfiguration\MailConfiguration::class)->isValid())
    @if (! request()->routeIs('mailConfiguration'))
        <div style="z-index: 10000" class="bg-red-200">
            Your mail configuration is invalid. Head over to the <a href="{{ route('mailConfiguration') }}">mail
                configuration</a> screen.
        </div>
    @endif
@endif
