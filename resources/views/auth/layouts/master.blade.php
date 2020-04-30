<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($title) ? "{$title} | Mailcoach" : 'Mailcoach' }}</title>

    <link rel="stylesheet" href="{{ asset('vendor/mailcoach/app.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.0/css/all.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#1288ff">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript" src="{{ asset('vendor/mailcoach/app.js') }}" defer></script>
</head>
<body class="bg-blue-100">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 bg-blue-900 overflow-hidden"
        style="border-bottom-left-radius: 40vw 10px; border-bottom-right-radius: 60vw 35px; height: 52vh; width: 110%; left: -5%;">
            <div class="absolute inset-0"
                style="opacity: .1;">
                <img loading="eager"
                class="absolute w-full h-full"
                srcset="{{ asset('images/banner-3000.jpg') }} 3000w,
                {{ asset('images/banner-2000.jpg') }} 2000w,
                {{ asset('images/banner-1000.jpg') }} 1000w"
                sizes="100vw"
                src="{{ asset('images/banner-3000.jpg') }}"
                style="object-fit: cover; object-position: center right;"
                alt="">
            </div>
        </div>
    </div>


    <div id="app">
        @include('mailcoach::app.layouts.partials.flash')

        <div class="min-h-screen flex flex-col p-6">
            <div class="flex-grow flex items-center justify-center">
                <div class="w-full max-w-lg">
                    <div class="grid grid-cols-auto-1fr mb-8 text-white">
                        <a href="{{ route('mailcoach.home') }}" class="opacity-50 h-8 mr-1 | hover:opacity-75">
                            @include('mailcoach::app.layouts.partials.logoSvg')
                        </a>
                        @yield('breadcrumbs')
                    </div>

                    <div class="card shadow-2xl">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('mailcoach::app.layouts.partials.footer')
        </div>
    </div>
</body>
</html>
