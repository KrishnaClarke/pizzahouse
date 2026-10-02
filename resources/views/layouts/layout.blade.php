<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pizza House')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700" rel="stylesheet">
    <link href="/css/pizzahouse.css" rel="stylesheet">
</head>
<body>
    <header class="site-header">
        <a href="/" class="brand">🍕 Pizza House</a>
        <nav>
            <a href="/pizzas/create">Order</a>
            <a href="/pizzas">Staff orders</a>
        </nav>
    </header>

    <main class="container">
        @if (session('mssg'))
            <div class="flash">{{ session('mssg') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">Pizza House &middot; The best pizza in Bim</footer>
</body>
</html>
