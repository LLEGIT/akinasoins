@extends('layout')

@section('content')
    <div class="flex flex-col space-y-4">
        <a href="{{ route('questions', 1)}}" class="bg-cornFlower text-white font-bold py-2 px-4 rounded inline-block">Démarrer
            un diagnostic</a>
        <a href="/" class="bg-ruddyPink text-white font-bold py-2 px-4 rounded inline-block">Les
            préconisations</a>
        <a href="{{ route('statistics') }}"
           class="bg-tealDeer text-white font-bold py-2 px-4 rounded inline-block">Statistiques</a>
    </div>
@endsection
