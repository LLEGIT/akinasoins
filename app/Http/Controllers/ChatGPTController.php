<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\OpenAIService;

/**
 * @OA\Info(
 *     title="API Akinasoins",
 *     version="1.0.0",
 *     description="API pour interagir avec ChatGPT pour un jeu de devinettes médicales.",
 *     @OA\Contact(
 *         email="support@akinasoins.com"
 *     )
 * )
 */
class ChatGPTController extends Controller
{
    protected $openAIService;
    private const MAX_QUESTIONS_ALLOWED = 10;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }
    /**
     * @OA\Post(
     *     path="/ask",
     *     summary="Envoyer un prompt à ChatGPT et recevoir une réponse",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="response",
     *                 type="string",
     *                 description="Le prompt ou la question à envoyer à ChatGPT"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Réponse réussie",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="response",
     *                 type="string",
     *                 description="La réponse de ChatGPT"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête incorrecte"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
     */
    public function ask(Request $request, string $step): View
    {
        if (false === \is_numeric($step)) {
            return \view('home');
        }

        $prompt = $request->input('answer');
        $conversationHistory = Session::get('current_prompt') ?? [];

        $response = $this->openAIService->getChatGPTResponse($conversationHistory);

        if (\str_contains($response, 'Diagnostic')) {
            $response = \str_replace(
                'Possibilités de traitement :',
                '<br>Possibilités de traitement :<br>',
                $response,
            );

            $response = \str_replace(
                '**',
                '',
                $response,
            );

            $response = \str_replace(
                '###',
                '',
                $response,
            );

            $response = \str_replace(
                ' :',
                ' :<br>',
                $response,
            );

           return \view('diagnosis', [
               'response' => $response,
           ]);
        }

        $userAnswer = 'A la question précédente, je réponds ' . $prompt;

        if ($response === $userAnswer) {
            $response = $this->openAIService->getChatGPTResponse($conversationHistory);
        }

        $conversationHistory[] = [
            'role' => 'user',
            'content' => [
                [
                    'type' => 'text',
                    'text' => $userAnswer,
                ],
            ],
        ];

        $conversationHistory[] = [
            'role' => 'assistant',
            'content' => [
                [
                    'type' => 'text',
                    'text' => $response,
                ],
            ],
        ];

        Session::put('current_prompt', $conversationHistory);

        if (((int)$step - 1) === self::MAX_QUESTIONS_ALLOWED) {
            return \view('diagnosis', [
                'response' => $response,
            ]);
        }

        $question = [
            'id' => null,
            'titre' => $response,
            'reponses' => [
                'oui',
                'non',
            ],
        ];

        return \view('questions', [
            'question' => $question,
            'nextStep' => (int)$step + 1,
        ]);
    }

        /**
     * @OA\Get(
     *     path="/initialize-game",
     *     summary="Initialiser un jeu de devinettes médicales avec ChatGPT",
     *     @OA\Response(
     *         response=200,
     *         description="Jeu initialisé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="response",
     *                 type="string",
     *                 description="La première question de ChatGPT pour commencer le jeu"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
     */
    public function initializeGame(string $disorderType): View
    {
        $promptInstructions = [
            "Je joue à Akinator, tu es le génie qui pose les questions et j'y répond.",
            "Mes réponses sont 'oui' ou 'non' Cela est sur le domaine de la santé et tu dois deviner ma maladie.",
            "Tu as un maximum de " . self::MAX_QUESTIONS_ALLOWED . "  questions. Le jeu commence maintenant. Je ne veux pas de texte inutile, poses-moi simplement les questions.",
            "Cela concerne le plan $disorderType. Tu t'arrêtes uniquement lorsque tu as atteins le quota de questions",
            "Une fois trouvé, je souhaite que tu me fasses un diagnostic avec les possibilités de traitement en fonction de la maladie trouvé.",
            "Je répète, pas de phrase inutile. Tu dois uniquement renvoyer la prochaine question en adéquation avec ce que tu as en contexte.",
            "Tu dois absolument arrêter de poser tes questions si tu dépasses le quota de " . self::MAX_QUESTIONS_ALLOWED . " et rendre ton diagnostic, même s'il n'est pas parfait.",
            "Ne précise pas à l'utilisateur que tu as dépassé ton quota de questions",
        ];

        Session::put('current_prompt', [
            [
                'role' => 'user',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => join($promptInstructions),
                    ],
                ],
            ],
        ]);

        $response = $this->openAIService->getChatGPTResponse(Session::get('current_prompt'));

        $question = [
            'id' => null,
            'titre' => $response,
            'reponses' => [
                'oui',
                'non',
            ]
        ];

        return view('questions', [
            'question' => $question,
            'nextStep' => 1,
        ]);
    }
}

