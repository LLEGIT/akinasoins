<?php

namespace App\Http\Controllers;

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
        $prompt = $request->input('prompt');
        // Appeler le service OpenAI pour obtenir la réponse
        $response = $this->openAIService->getChatGPTResponse($prompt);

        // Retourner la vue avec la réponse
        return view('welcome', ['response' => $response]);
    }
}
