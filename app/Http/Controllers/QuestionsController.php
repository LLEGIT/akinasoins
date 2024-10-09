<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function show($page = 1)
    {
        $allQuestions = [
            1 => ['id' => 1, 'titre' => 'Quel trouble pensez vous avoir ?'],
            2 => ['id' => 2, 'titre' => 'Avez-vous des antécédents médicaux importants ?'],
            3 => ['id' => 3, 'titre' => 'Pratiquez-vous régulièrement une activité physique ?'],
            4 => ['id' => 4, 'titre' => 'Consommez-vous des substances comme le tabac, l’alcool ou des drogues ?']
        ];

        // Vérifier la validité de la page et obtenir la question
        if (!isset($allQuestions[$page])) {
            return redirect()->route('questions.page', ['page' => 1]);
        }

        $question = $allQuestions[$page];
        $nextPage = ($page < count($allQuestions)) ? $page + 1 : 1;

        return view('questions', compact('question', 'nextPage', 'page'));
    }

    // Gestion de la soumission de la réponse
    public function submitAnswer(Request $request, $page)
    {
        // Récupérer l'ID de la question et la réponse
        $questionId = $request->input('question_id');
        $answer = $request->input('answer');

        // Enregistrer la réponse (en pratique, dans une base de données)
        // Exemple : Réponses en session pour illustrer
        session()->put("answers.$questionId", $answer);

        // Rediriger vers la question suivante
        return redirect()->route('questions.page', ['page' => $page + 1]);
    }
}