@php use Spatie\Mailcoach\Mailcoach; @endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="always">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>{{ isset($title) ? "{$title} | Mailcoach" : 'Mailcoach' }}</title>

    @filamentStyles
    @livewireStyles
    {!! Mailcoach::styles() !!}
</head>
<body class="text-gray-800 bg-indigo-900/5 ">
<div id="app" class="min-h-screen flex flex-col p-10 gap-10">
    <div class="flex-grow flex items-center justify-center">
        <div class="card w-full max-w-md !p-0">
            <header class="navigation-main !relative !px-6 md:!px-10 !py-4 !rounded-b-none !rounded-t-md">
                <a href="{{ route('login') }}" class="flex items-center group gap-2">
                            <span class="flex w-10 h-6 text-white transform group-hover:scale-90 transition-transform duration-150">
                                @include('mailcoach::app.layouts.partials.logoSvg')
                            </span>
                    <span class="text-white uppercase text-xs font-bold tracking-wider">Mailcoach</span>
                </a>
            </header>
            <main class="p-6 md:p-10">
                @yield('content')
            </main>
        </div>
    </div>
    @include('mailcoach::app.layouts.partials.footer')
</div>
@filamentScripts
@livewireScriptConfig
{!! Mailcoach::scripts() !!}
</body>
</html>
