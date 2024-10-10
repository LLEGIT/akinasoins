@extends('layout')

@section('content')
    <div class="flex flex-col gap-y-4 mt-10 lg:p-20 lg:gap-y-20">
        <a href="{{ route('questions', 1)}}" class="bg-cornFlower p-4 rounded inline-block lg:text-2xl lg:p-8">Démarrer
            un diagnostic</a>
        <a href="{{ route('recommendations')  }}" class="bg-ruddyPink p-4 rounded inline-block lg:text-2xl lg:p-8">Les
            préconisations</a>
        <a href="{{ route('statistics') }}"
           class="bg-tealDeer p-4 rounded inline-block lg:text-2xl lg:p-8">Statistiques</a>
    </div>
@endsection
