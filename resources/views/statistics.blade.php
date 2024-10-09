@extends('layout')

@section('statistics')
<div class="flex-1 flex items-center justify-center p-4">
    <ul class="list-disc text-left">
        <li>{{ $pourcentage['antecedent'] }}% de nos utilisateurs ont des antécédents médicaux graves</li>
        <li>{{ $pourcentage['fumeur'] }}% des diagnostiqués déclarent fumer ou boire de l’alcool régulièrement
        </li>
        <li>{{ $pourcentage['consulteGeneraliste'] }} des diagnostics se concluent par un aiguillage vers un
            mèdecin
            généraliste</li>
        <li>{{ $pourcentage['troubleMental'] }} des troubles diagnostiqués sont d’ordre mental</li>
    </ul>
</div>
@endsection