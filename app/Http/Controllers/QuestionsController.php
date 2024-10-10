<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\DisorderType;
use Illuminate\Http\Client\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuestionsController extends Controller
{
    private const QUESTIONS = [
        [
            'id' => 1,
            'titre' => 'De quel type de troubles souffrez vous ?',
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

        $questionData = self::QUESTIONS[$question - 1] ?? null;

        if (null === $questionData) {
            return view('home');
        }

        $nextPage = ($question < count(self::QUESTIONS)) ? (int) $question + 1 : 1;

        return view('questions', [
            'question' => $questionData,
            'nextPage' => $nextPage,
        ]);
    }

    public function submitAnswer(Request $request, string $question): RedirectResponse {
        dd($request);

        return redirect()->to('http://heera.it');
    }

}
