@extends('layout')

@section('content')
    <div class="md:w-1/2 w-full bg-white p-6 rounded-lg">
        <h2 class="text-lg font-semibold mb-4 text-center">{{ $question['titre'] }}</h2>

        <div>
            <form method="POST"
                  action="{{ $question['id'] ? route('questions.answer', $question['id']) : route('chatgpt.ask', $nextStep ?? 1) }}"
                  class="flex flex-col items-center gap-y-4"
            >
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
                    @if (
                        false === \is_string($reponse) &&
                        $reponse->value == 'mental'
                    )
                        <button type="submit" name="answer" value="{{ $reponse }}">
                            @include('components/chooseMentalDisease')
                        </button>
                    @elseif (
                        false === \is_string($reponse) &&
                        $reponse->value == 'physical'
                    )
                        <button type="submit" name="answer" value="{{ $reponse }}">
                            @include('components/choosePhysiqueDisease')
                        </button>
                    @else
                        @if ($reponse == 'oui')
                            <button type="submit" name="answer" value="{{ $reponse }}">
                                @include('components/chooseYes')
                            </button>
                        @else
                            <button type="submit" name="answer" value="{{ $reponse }}">
                                @include('components/chooseNo')
                            </button>
                        @endif
                    @endif
                @endforeach
            </form>
        </div>
    </div>
@endsection
