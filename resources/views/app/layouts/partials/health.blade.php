@if ((! $mailConfigurationValid && ! request()->routeIs('mailConfiguration')) || ! $horizonActive)
    <div class="z-50 text-white bg-red-500 px-4 py-8">
        <div class="max-w-6xl mx-auto grid gap-3">
            @if (! request()->routeIs('mailConfiguration'))
                @if(! $mailConfigurationValid)
                    <div class="flex items-baseline">
                        <span class="w-6"><i class="fas fa-cog opacity-50"></i></span>
                        <span class="ml-2">Your <strong>mail configuration</strong> is invalid. Head over to the <a class="underline" href="{{ route('mailConfiguration') }}">mail
                            configuration</a> screen.</span>
                    </div>
                @endif
            @endif

            @if(! $horizonActive)
                <div class="flex items-baseline">
                    <span class="w-6"><i class="fas fa-database opacity-50"></i></span>
                    <span class="ml-2"><strong>Horizon</strong> is not active on your server. <a class="underline" href="https://mailcoach.app/docs">Read the docs</a>.</span>
                </div>
            @endif
        </div>
    </div>
@endif
