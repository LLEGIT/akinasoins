<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Services\OpenAIService;

class ChatGPTController extends Controller
{   
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

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
    public function initialize_game() {
        
        Session::put('current_prompt', "Je joue à Akinator, tu es le génie qui pose les questions et j'y répond. Mes réponses sont 'oui' ou 'non' Cela est sur le domaine de la santé et tu dois deviner ma maladie. Tu as un maximum de 15 questions. Le jeu commence maintenant. Je ne veux pas de texte inutile, poses-moi simplement les questions. Cela concerne le plan {mental/phyisique} (potentiel requête). Tu t'arrêtes quand tu penses avoir trouvé ce que c'est. Une fois trouvé, je souhaite que tu me fasses un diagnostic avec les possibilités de traitement en fonction de la maladie trouvé. Je répète, pas de phrase inutile. Si tu trouves avant la fin des 15 questions, tu peux terminer les questions et passer le diagnostic."); 
        $response = $this->openAIService->getChatGPTResponse(Session::get('current_prompt'));
        Session::put('current_prompt', Session::get('current_prompt') . "Voici la liste des questions - réponses posés jusque là : $response - ");

       return view('questions', ['response' => substr($response, offset: 4)]);  
    }
}

