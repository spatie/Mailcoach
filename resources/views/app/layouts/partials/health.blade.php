@if (! request()->routeIs('mailConfiguration'))
    @if(! $mailConfigurationValid)
        <div class="z-50 p-1 text-center text-xs text-red-200 bg-red-500">
            Your mail configuration is invalid. Head over to the <a href="{{ route('mailConfiguration') }}">mail
                configuration</a> screen.
        </div>
    @endif

    @if(! $horizonActive)
        <div class="z-50 p-1 text-center text-xs text-red-200 bg-red-500">
            Horizon is not active.
        </div>
    @endif

@endif
