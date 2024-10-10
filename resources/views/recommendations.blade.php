@extends('layout')

@section('content')

    <div>
        <div class="grid grid-cols-2 h-full">
            <div class="flex flex-col justify-center items-center bg-slate-400 p-6 h-40 md:h-32">
                <img src="{{ asset('images/logo_activite_physique.png') }}"
                     alt="Pratiquer une activité physique régulière">
                <p class="text-center">Pratiquer une activité physique régulière</p>
            </div>
            <div class="flex flex-col justify-center items-center p-6 h-40 md:h-32">
                <img src="{{ asset('images/logo_manger_fruit_legume.png') }}" alt="Manger des fruits et légumes">
                <p class="text-center">Manger des fruits et légumes</p>
            </div>

            <div class="flex flex-col justify-center items-center p-6 h-36 md:h-32">
                <img src="{{ asset('images/logo_eviter_tabac.png') }}" alt="Eviter le tabac et l'alcool">
                <p class="text-center">Eviter le tabac et l'alcool</p>
            </div>
            <div class="flex flex-col justify-center items-center bg-slate-400 p-6 h-36 md:h-32">
                <img src="{{ asset('images/logo_manger_bio.png') }}" alt="Manger bio">
                <p class="text-center">Manger bio</p>
            </div>

            <div class="flex flex-col justify-center items-center bg-slate-400 p-6 h-40 md:h-32">
                <img src="{{ asset('images/logo_reduire_sucre.png') }}" alt="Réduire les boissons sucrées">
                <p class="text-center">Réduire les boissons sucrées</p>
            </div>
            <div class="flex flex-col justify-center items-center p-6 h-40 md:h-32">
                <img src="{{ asset('images/logo_hydratez_vous.png') }}" alt="Hydratez vous régulièrement">
                <p class="text-center">Hydratez vous régulièrement</p>
            </div>

        </div>
@endsection
