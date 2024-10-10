@extends('layout')

@section('content')
    <div class="flex flex-col p-4 gap-y-4">
        <div>{{ $response }}</div>
        <div class="flex justify-between">
            @include('components/returnHomeEndButton')
            @include('components/shareButton')
        </div>
    </div>
@endsection
