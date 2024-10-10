@extends('layout')

@section('content')
<div class="flex h-screen justify-center">

    <div class="w-2/3 flex items-center justify-center">
        <div class="grid grid-cols-2 gap-8">
            <div class="flex flex-col items-center bg-slate-400">
                <img src="{{ asset('images/logo_activite_physique.png') }}"
                    alt="Pratiquer une activité physique régulière<" class="h-16 mb-4">
                <p class="text-center">Pratiquer une activité physique régulière</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo_manger_fruit_legume.png') }}" alt="Manger des fruits et légumes"
                    class="h-16 mb-4">
                <p class="text-center">Manger des fruits et légumes</p>
            </div>

            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo_eviter_tabac.png') }}" alt="Eviter le tabac et l'alcool"
                    class="h-16 mb-4">
                <p class="text-center">Eviter le tabac et l'alcool</p>
            </div>
            <div class="flex flex-col items-center bg-gray-200 p-4 rounded-lg">
                <img src="{{ asset('images/logo_manger_bio.png') }}" alt="Manger bio" class="h-16 mb-4">
                <p class="text-center">Manger bio</p>
            </div>

            <div class="flex flex-col items-center bg-slate-400">
                <img src="{{ asset('images/logo_reduire_sucre.png') }}" alt="Réduire les boissons sucrées"
                    class="h-16 mb-4">
                <p class="text-center">Réduire les boissons sucrées</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo_hydratez_vous.png') }}" alt="Hydratez vous régulièrement"
                    class="h-16 mb-4">
                <p class="text-center">Hydratez vous régulièrement</p>
            </div>
        </div>
    </div>
    @endsection
