@if ((! $mailConfigurationValid && ! request()->routeIs('mailConfiguration')) || ! $horizonActive)
    <div class="alert alert-error shadow-2xl">
        <div class="max-w-layout mx-auto grid">
            @if (! request()->routeIs('mailConfiguration'))
                @if(! $mailConfigurationValid)
                    <div class="flex items-baseline">
                        <span class="w-6"><i class="fas fa-server opacity-50"></i></span>
                        <span class="ml-2 text-sm | lg:text-base">
                            {!! __('Your <strong>mail configuration</strong> is invalid. Head over to the <a href=":mailConfigurationLink">mail configuration</a> screen.', ['mailConfigurationLink' => route('mailConfiguration')]) !!}
                        </span>
                    </div>
                @endif
            @endif

            @if(! $horizonActive)
                <div class="flex items-baseline">
                    <span class="w-6"><i class="fas fa-database opacity-50"></i></span>
                    <span class="ml-2 text-sm | lg:text-base">
                        {!! __('<strong>Horizon</strong> is not active on your server. <a target="_blank" href=":docsLink">Read the docs</a>.', ['docsLink' => 'https://mailcoach.app/docs']) !!}
                    </span>
                </div>
            @endif
        </div>
    </div>
@endif
