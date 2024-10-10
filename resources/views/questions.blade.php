@extends('layout')

@section('content')
    <div class="w-full bg-white p-6">
        <h2 class="text-lg lg:text-2xl font-semibold mb-4 lg:mb-12 text-center">{{ $question['titre'] }}</h2>

        <div>
            <form method="POST"
                  action="{{ $question['id'] ? route('questions.answer', $question['id']) : route('chatgpt.ask', $nextStep ?? 1) }}"
                  class="flex flex-col items-center gap-y-4 lg:gap-y-12"
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
                            @include('components.chooseMentalDisease')
                        </button>
                    @elseif (
                        false === \is_string($reponse) &&
                        $reponse->value == 'physical'
                    )
                        <button type="submit" name="answer" value="{{ $reponse }}">
                            @include('components.choosePhysiqueDisease')
                        </button>
                    @else
                        @if ($reponse == 'oui')
                            <button type="submit" name="answer" value="{{ $reponse }}">
                                @include('components.chooseYes')
                            </button>
                        @else
                            <button type="submit" name="answer" value="{{ $reponse }}">
                                @include('components.chooseNo')
                            </button>
                        @endif
                    @endif
                @endforeach
            </form>
        </div>
    </div>
@endsection
