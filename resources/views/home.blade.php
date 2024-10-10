@extends('layout')

@section('content')
    <div class="flex flex-col gap-y-2">
        <a href="{{ route('questions', 1)}}" class="bg-cornFlower p-4 rounded inline-block">Démarrer
            un diagnostic</a>
        <a href="/" class="bg-ruddyPink p-4 rounded inline-block">Les
            préconisations</a>
        <a href="{{ route('statistics') }}"
           class="bg-tealDeer p-4 rounded inline-block">Statistiques</a>
    </div>
@endsection
