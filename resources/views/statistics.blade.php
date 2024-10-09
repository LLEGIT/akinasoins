@extends('layout')

@section('statistics')
<div class="flex-1 flex items-center justify-center p-4">
    <ul class="list-disc text-left">
        <li>{{ $pourcent['smokerCount'] }}% de nos utilisateurs sont des fumeurs</li>
        <li>{{ $pourcent['smokerCount'] }}% de nos utilisateurs boivent de l'alcool régulièrement</li>
        <li>{{ $pourcent['troubleMental'] }} des troubles diagnostiqués sont d’ordre mental</li>
        <li>{{ $pourcent['troubleMental'] }} des troubles diagnostiqués sont d’ordre physique</li>
        <li>{{ $pourcent['hasMedicalHistoryCount'] }}% de nos utilisateurs ont des antécédents médicaux graves</li>
        <li>{{ $pourcent['smokerCount'] }}% des diagnostiqués déclarent fumer ou boire de l’alcool régulièrement</li>

    </ul>
</div>
@endsection



De quel type de troubles souffrez vous ?
Avez vous des antécédents médicaux ?
Pratiquez vous une activité physique régulière ?
Etes vous fumeur ?
Buvez vous de l'alccol ?
Avez vous des allergies ?