@extends('layout')

@section('content')
<div class="md:w-1/2 w-full bg-white p-6 rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">{{ $question['titre'] }}</h2>

    <div class="flex space-x-4">
        <form method="POST" action="{{ $question['id'] ? route('questions.answer', $question['id']) : route('chatgpt.ask', $nextStep ?? 1) }}">
            @csrf
            @foreach ($question['reponses'] as $key => $reponse)
                @php
                    $bgColor = '';
                    if ($key === 1) {
                        $bgColor = 'bg-tealDeer';
                    } else {
                        $bgColor = 'bg-ruddyPink';
                    }
                @endphp
                <button type="submit" name="answer" value="{{ $reponse }}"
                        class="px-4 py-2 {{ $bgColor }} text-white rounded-lg">{{ $reponse }}</button>
            @endforeach
        </form>
    </div>
</div>
@endsection
