@if ((! $mailConfigurationValid && ! request()->routeIs('mailConfiguration')) || ! $horizonActive)
    <div class="fixed bottom-0 right-0 z-50 alert alert-error shadow-2xl">
        <div class="max-w-layout mx-auto grid">
            @if (! request()->routeIs('mailConfiguration'))
                @if(! $mailConfigurationValid)
                    <div class="flex items-baseline">
                        <span class="w-6"><i class="fas fa-server opacity-50"></i></span>
                        <span class="ml-2 text-sm | lg:text-base">Your <strong>mail configuration</strong> is invalid. Head over to the <a href="{{ route('mailConfiguration') }}">mail
                            configuration</a> screen.</span>
                    </div>
                @endif
            @endif

            @if(! $horizonActive)
                <div class="flex items-baseline">
                    <span class="w-6"><i class="fas fa-database opacity-50"></i></span>
                    <span class="ml-2 text-sm | lg:text-base"><strong>Horizon</strong> is not active on your server. <a href="https://mailcoach.app/docs">Read the docs</a>.</span>
                </div>
            @endif
        </div>
    </div>
@endif
