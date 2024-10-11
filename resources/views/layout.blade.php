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
<div class="h-screen flex flex-col ">
    <div class="hidden lg:block">
        @include('components.header')
    </div>

    <div class="absolute lg:hidden {{ Route::current()->getName() == 'home' ? 'hidden' : '' }} top-4 left-4">
        @include('components.returnHomeButton')
    </div>

    <div class="lg:flex lg:px-40 lg:mt-5 lg:gap-x-5 lg:items-center">
        <div>
            <img src="{{ asset('images/akinasoins_logo.webp') }}" alt="logo akinasoins"
                 class="w-full h-auto lg:w-[80%] lg:rounded-2xl">
        </div>

        <div class="flex flex-col items-center lg:block lg:w-[80%]">
            <div class="hidden lg:mb-4 cursor-pointer {{ Route::current()->getName() == 'home' ? 'hidden' : 'lg:block' }}">
                @include('components.returnHomeButton')
            </div>
            @yield('content')
        </div>
    </div>

    <div class="absolute bottom-0 right-0 lg:bottom-5 lg:right-5 {{ Route::current()->getName() == 'recommendations' ? 'hidden' : '' }}">
        <img src="{{ asset('/images/label-sante.png') }}">
    </div>
</div>

</body>

</html>
