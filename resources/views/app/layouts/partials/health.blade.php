@if (! request()->routeIs('mailConfiguration'))
    @if(! $mailConfigurationValid)
        <div style="z-index: 10000" class="bg-red-200">
            Your mail configuration is invalid. Head over to the <a href="{{ route('mailConfiguration') }}">mail
                configuration</a> screen.
        </div>
    @endif

    @if(! $horizonActive)
        <div style="z-index: 10000" class="bg-red-200">
            Horizon is not active
        </div>
    @endif

@endif
