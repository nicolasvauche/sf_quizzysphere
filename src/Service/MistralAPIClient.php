<?php

namespace App\Service;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class MistralAPIClient
{
    const CUSTOM_INSTRUCTIONS_QUESTIONS = [
        "Tu es formateur en développement web et tu conçois des quiz sous la forme de Questions à Choix Multiples.",
        "Tu formules directement des questions ouvertes adaptées à un quiz QCM, en français, sans ajouter de réponses, préfixes, ou numérotation.",
        "Chaque question doit inviter à choisir une réponse parmi celles qui seront proposées, plutôt qu'une réponse par oui ou non.",
        "Voici un exemple de questions : Quelle est la capitale de la France ?\nQuelle est la couleur du cheval blanc d'Henri IV ?\n",
    ];

    const CUSTOM_INSTRUCTIONS_QUESTION = [
        "Tu es formateur en développement web et tu conçois des quiz sous la forme de Questions à Choix Multiples.",
        "Formule directement une question ouverte adaptée à un quiz QCM, en français, sans ajouter de réponses, préfixes, ou numérotation.",
        "La question doit inviter à choisir une réponse parmi celles qui seront proposées, plutôt qu'une réponse par oui ou non.",
        "Voici un exemple de question : Quelle est la capitale de la France ?",
    ];

    private GuzzleClient $client;
    private string $model;

    public function __construct(string $apiKey, string $model, string $baseUrl)
    {
        $this->client = new GuzzleClient([
            'base_uri' => $baseUrl,
            'bearer' => $apiKey,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ],
        ]);
        $this->model = $model;
    }

    public function generateQuestions(string $theme, string $level): string
    {
        $content = "Peux-tu me proposer 10 questions de niveau $level sur le thème $theme ?";

        return $this->chatStream(self::CUSTOM_INSTRUCTIONS_QUESTIONS, $content);
    }

    public function generateQuestion(string $theme, string $level): string
    {
        $content = "Peux-tu me proposer 1 question de niveau $level sur le thème $theme ?";

        return $this->chatStream(self::CUSTOM_INSTRUCTIONS_QUESTION, $content);
    }

    public function chatStream(array $customInstructions, string $content): string
    {
        $payload = [
            'model' => $this->model,
            'messages' => [
                ['role' => 'system', 'content' => implode(' ', $customInstructions)],
                ['role' => 'user', 'content' => $content],
            ],
            'temperature' => 0.5,
            'top_p' => 1,
        ];

        try {
            $response = $this->client->post('', [
                'json' => $payload,
            ]);

            return $this->processResponse(json_decode($response->getBody()->getContents(), true));
        } catch(GuzzleException $e) {
            throw new \RuntimeException('Failed to communicate with Mistral API: ' . $e->getMessage(), 0, $e);
        }
    }

    private function processResponse(array $response): string
    {
        $content = $response['choices'][0]['message']['content'];

        $cleanContent = preg_replace('/^\s*[\d\w]+[\)\.\-]\s*/m', '', $content);

        return $cleanContent;
    }
}
