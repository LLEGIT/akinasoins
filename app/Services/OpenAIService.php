<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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

    public function getChatGPTResponse(array $prompt): string
    {
        try {
            $response = $this->client->post('chat/completions', [
                'json' => [
                    'model' => 'gpt-4o-mini',
                    'messages' => $prompt,
                    'max_tokens' => 100,
                ],
            ]);
        } catch (GuzzleException $exception) {
            return $exception->getMessage();
        }

        if (null === ($response->getBody())) {
            return 'Je n\'ai pas pu répondre à la question';
        }

        $body = json_decode((string) $response->getBody(), true);
        return $body['choices'][0]['message']['content'];
    }
}
