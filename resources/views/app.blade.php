<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Manuel Echavarria">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="ingeniero de software, desarrollo web, diseño web, diseño responsivo, SEO, desarrollo frontend, desarrollo backend, maet.dev, software engineer, web development, web design, responsive design, Laravel, Vue, SEO, frontend development, backend development">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <link rel="shortcut icon" href="{{ asset('img/icon/my-icon.ico') }}">

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-YZCE7NL6GW"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-YZCE7NL6GW');
        </script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>

    <body class="font-sans antialiased text-base font-normal text-gray-700 leading-relaxed">
        @inertia
    </body>
</html>
