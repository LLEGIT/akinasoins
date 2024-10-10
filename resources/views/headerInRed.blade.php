<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="h-screen w-screen">
    <div class="w-screen h-screen flex flex-col md:flex-row">

        <div class="flex-1 flex items-center justify-center">
            <img src="{{ asset('images/returnHome.png') }}" alt="logo akinasoins" class="max-w-full h-auto">
        </div>

        <div class="flex-1 flex items-center justify-center">
            @yield('home')
        </div>

    </div>

</body>

</html>