@extends('layout')



@section('content')
    <div class="p-10">
        <h3 class="lg:text-2xl">Quelques statistiques sur nos utilisateurs :</h3>
        <ul class="list-disc lg:text-2xl">
            <li>{{ $smoker_count }}% de nos utilisateurs sont des fumeurs</li>
            <li>{{ $drinks_alcohol_count }}% de nos utilisateurs boivent de l'alcool régulièrement</li>
            <li>{{ $mental_disorder_count }}% des troubles diagnostiqués sont d’ordre mental</li>
            <li>{{ $physical_disorder_count }}% des troubles diagnostiqués sont d’ordre physique</li>
            <li>{{ $has_medical_history_count }}% de nos utilisateurs ont des antécédents médicaux</li>
            <li>{{ $physical_activity_count }}% de nos utilisateurs pratiquent une activité physique</li>
        </ul>
    </div>
@endsection
