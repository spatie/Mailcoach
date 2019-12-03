@if (! request()->routeIs('mailConfiguration') || ! $horizonActive)
    <div class="z-50 text-red-100 bg-red-500 px-4 py-4">
        <div class="max-w-6xl mx-auto grid gap-1">
            @if (! request()->routeIs('mailConfiguration'))
                @if(! $mailConfigurationValid)
                    <div class="flex items-baseline">
                        <span class="w-6"><i class="fas fa-cog opacity-50"></i></span>
                        <span class="ml-2">Your <strong>mail configuration</strong> is invalid. Head over to the <a class="underline" href="{{ route('mailConfiguration') }}">mail
                            configuration</a> screen.</span>
                    </div>
                @endif

                @if(! $horizonActive)
                    <div class="flex items-baseline">
                        <span class="w-6"><i class="fas fa-database opacity-50"></i></span>
                        <span class="ml-2"><strong>Horizon</strong> is not active on your server.</span>
                    </div>
                @endif

            @endif
        </div>
    </div>
@endif
