<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
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
    public function ask(Request $request)
    {
        // Récupérer le prompt de l'utilisateur
        $prompt = $request->input('response');
        var_dump($prompt);
        Session::put('current_prompt',  Session::get('current_prompt') . " $prompt / " );
        // Appeler le service OpenAI pour obtenir la réponse
        $response = $this->openAIService->getChatGPTResponse(Session::get('current_prompt'));
        Session::put('current_prompt', Session::get('current_prompt') . "$response : ");
        return view('questions', ['response' => $response]);
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
    public function initialize_game() {
        
        Session::put('current_prompt', "Je joue à Akinator, tu es le génie qui pose les questions et j'y répond. Mes réponses sont 'oui' ou 'non' Cela est sur le domaine de la santé et tu dois deviner ma maladie. Tu as un maximum de 15 questions. Le jeu commence maintenant. Je ne veux pas de texte inutile, poses-moi simplement les questions. Cela concerne le plan {mental/phyisique} (potentiel requête). Tu t'arrêtes quand tu penses avoir trouvé ce que c'est. Une fois trouvé, je souhaite que tu me fasses un diagnostic avec les possibilités de traitement en fonction de la maladie trouvé. Je répète, pas de phrase inutile. Si tu trouves avant la fin des 15 questions, tu peux terminer les questions et passer le diagnostic."); 
        $response = $this->openAIService->getChatGPTResponse(Session::get('current_prompt'));
        Session::put('current_prompt', Session::get('current_prompt') . "Voici la liste des questions - réponses posés jusque là : $response - ");

       return view('questions', ['response' => substr($response, offset: 4)]);  
    }
}

