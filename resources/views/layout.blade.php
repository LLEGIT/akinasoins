<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AkinaSoins</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/images/health-care.png')  }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="h-screen w-screen">
    <div class="h-screen flex flex-col md:flex-row">

        <div class="flex-1 flex items-center justify-center">
            <img src="{{ asset('images/akinasoins_logo.webp') }}" alt="logo akinasoins" class="max-w-full h-auto">
        </div>

        <div class="flex-1 flex items-center justify-center">
            @yield('content')
        </div>
    </div>

</body>

</html>
