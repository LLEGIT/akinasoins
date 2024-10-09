@extends('layout')

@section('questions')
<div class="md:w-1/2 w-full bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">{{ $question['titre'] }}</h2>

    <div class="flex space-x-4">
        <form method="POST" action="{{ route('question.answer', ['page' => $page]) }}">
            @csrf
            <input type="hidden" name="question_id" value="{{ $question['id'] }}">

            <button type="submit" name="answer" value="oui"
                class="px-4 py-2 bg-green-500 text-white rounded-lg">Oui</button>
            <button type="submit" name="answer" value="non"
                class="px-4 py-2 bg-red-500 text-white rounded-lg">Non</button>
            <button type="submit" name="answer" value="peut-être"
                class="px-4 py-2 bg-yellow-500 text-white rounded-lg">Peut-être</button>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('questions.page', ['page' => $nextPage]) }}"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg">Question suivante</a>
    </div>
</div>
@endsection