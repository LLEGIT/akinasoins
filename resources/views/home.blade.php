@extends('layout')

@section('content')
<div class="flex flex-col space-y-4">
    <a href="{{ route('questions')}}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded inline-block">Démarrer
        le diagnostique</a>
    <a href="{{ route('recommendations') }}" class="bg-red-500 text-white font-bold py-2 px-4 rounded inline-block">Les
        préconisations</a>
    <a href="{{ route('statistics') }}"
        class="bg-green-500 text-white font-bold py-2 px-4 rounded inline-block">Statistiques</a>

</div>
@endsection
