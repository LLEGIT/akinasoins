<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'verify' => false,  // Ajoutez cette ligne pour désactiver la vérification SSL

        ]);
        
    }

    public function getChatGPTResponse($prompt)
    {
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4o-mini', 
                'messages' => [ 
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => 100,
                'temperature' => 0.3,  
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['choices'][0]['message']['content'];
    }
}
