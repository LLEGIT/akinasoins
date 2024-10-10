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
        <div class="absolute cursor-pointer {{ Route::current()->getName() == 'home' ? 'hidden' : '' }} top-4 left-4">
            @include('components/returnHomeButton')
        </div>

        <div >
            <img src="{{ asset('images/akinasoins_logo.webp') }}" alt="logo akinasoins" class="w-full h-auto">
        </div>

        <div class="flex flex-col items-center">
            @yield('content')
        </div>

        <div class="absolute bottom-0 right-0 {{ Route::current()->getName() == 'recommendations' ? 'hidden' : '' }}">
            <img src="{{ asset('/images/label-sante.png') }}">
        </div>
    </div>

</body>

</html>
