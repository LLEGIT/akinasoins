<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\DisorderType;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class QuestionsController extends Controller
{
    private const QUESTIONS = [
        [
            'id' => 1,
            'titre' => 'Quels troubles pensez vous avoir ?',
            'reponses' => [
                DisorderType::MENTAL,
                DisorderType::PHYSICAL,
            ],
            'column' => 'disorder_type',
        ],
        [
            'id' => 2,
            'titre' => 'Avez vous des antécédents médicaux ?',
            'reponses' => [
                'oui',
                'non',
            ],
            'column' => 'has_medical_history',
        ],
        [
            'id' => 3,
            'titre' => 'Pratiquez vous une activité physique régulière ?',
            'reponses' => [
                'oui',
                'non',
            ],
            'column' => 'physical_activity',
        ],
        [
            'id' => 4,
            'titre' => 'Etes vous fumeur ?',
            'reponses' => [
                'oui',
                'non',
            ],
            'column' => 'smoker',
        ],
        [
            'id' => 5,
            'titre' => 'Buvez vous de l\'alccol ?',
            'reponses' => [
                'oui',
                'non',
            ],
            'column' => 'drinks_alcohol'
        ],
        [
            'id' => 6,
            'titre' => 'Avez vous des allergies ?',
            'reponses' => [
                'oui',
                'non',
            ],
            'column' => 'has_allergies',
        ],
    ];


    public function show(string $question): View
    {
        if (
            false === (is_numeric($question)) ||
            \count(self::QUESTIONS) < $question
        ) {
            return view('home');
        }

        $questionData = self::QUESTIONS[(int) $question - 1] ?? null;

        if (null === $questionData) {
            return view('home');
        }

        return view('questions', [
            'question' => $questionData,
        ]);
    }

    public function submitAnswer(Request $request, string $question): RedirectResponse
    {
        if (false === \is_numeric($question)) {
            return redirect()->route('home');
        }

        $content = $request->getContent() ?? null;

        if (null === $content) {
            return redirect()->route('home');
        }

        $parsedData = [];

        parse_str($content, $parsedData);

        $answer = $parsedData['answer'] ?? null;

        if (null === $answer) {
            return redirect()->route('questions', (int) $question);
        }

        $questionsAnswered = Session::get('questionsAnswered') ?? null;

        if (null === $questionsAnswered) {
            Session::put('questionsAnswered', [
                self::QUESTIONS[(int) $question - 1]['column'] => $answer,
            ]);
        } else {
            Session::put('questionsAnswered', [
                ...$questionsAnswered,
                self::QUESTIONS[(int) $question - 1]['column'] => $answer,
            ]);
        }

        if ((int) $question === \count(self::QUESTIONS)) {
            $questionsAnswered = \array_map(function (string $answer) {
                return $answer === 'oui' ? true : ($answer === 'non' ? false : $answer);
            }, $questionsAnswered);

            $newDiagnosis = new Diagnosis($questionsAnswered);

            if (false === $newDiagnosis->save()) {
                throw new \Exception('Error saving diagnosis');
            }

            return redirect()->route('chatgpt.initialize', $questionsAnswered['disorder_type']);
        }

        return redirect()->route('questions', (int) $question + 1);
    }

}
