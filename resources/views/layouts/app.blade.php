<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SoulMatch Matrimony')</title>
    <meta name="description" content="@yield('meta_description', 'Find your perfect life partner with SoulMatch Matrimony.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/matrimony.css') }}">
    @stack('head')
</head>

<body class="is-loading">
    <div class="page-loader" id="pageLoader" aria-hidden="true">
        <div class="loader-heart"></div>
        <p>Preparing your match experience...</p>
    </div>

    <div class="site-wrap">
        @include('partials.header')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <script src="{{ asset('js/matrimony.js') }}"></script>
    @stack('scripts')
</body>

</html>
