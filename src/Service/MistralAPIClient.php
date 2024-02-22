<?php

namespace App\Service;

use App\Entity\Question;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class MistralAPIClient
{
    const CUSTOM_INSTRUCTIONS_QUESTIONS = [
        "Tu es formateur en développement web et tu conçois des quiz sous la forme de Questions à Choix Multiples.",
        "Tu formules directement des questions fermées adaptées à un quiz QCM, en français, sans ajouter de réponses, préfixes, ou numérotation.",
        "Chaque question doit inviter à choisir une réponse parmi celles qui seront proposées, plutôt qu'une réponse par oui ou non.",
        "Tu remplaces les caractères spéciaux par leur équivalent HTML, par exemple &lt; pour < et &gt; pour >.",
        "Voici un exemple de questions : Quel est le premier élément enfant d'un élément &lt;div&gt; ?\nQuelle est la couleur du cheval blanc d'Henri IV ?\n",
    ];

    const CUSTOM_INSTRUCTIONS_QUESTION = [
        "Tu es formateur en développement web et tu conçois des quiz sous la forme de Questions à Choix Multiples.",
        "Formule directement une question fermée adaptée à un quiz QCM, en français, sans ajouter de réponses, préfixes, ou numérotation.",
        "La question doit inviter à choisir une réponse parmi celles qui seront proposées, plutôt qu'une réponse par oui ou non.",
        "Tu remplaces les caractères spéciaux par leur équivalent HTML, par exemple &lt; pour < et &gt; pour >.",
        "Voici un exemple de question : Quel est le premier élément enfant d'un élément &lt;div&gt; ?",
    ];

    const CUSTOM_INSTRUCTIONS_ANSWERS = [
        "En ta qualité de formateur en développement web, ta mission est de concevoir quatre réponses distinctes pour chaque question de quiz QCM, accompagnées de leur explication.",
        "Chaque ensemble de réponses doit être formulé en français, en remplaçant les caractères spéciaux par leurs entités HTML (par exemple, &lt; pour '<', &gt; pour '>').",
        "Format requis pour les réponses : Chaque réponse doit débuter par '[1]', suivi immédiatement par le texte de la réponse. Ensuite, ajoute '[2]', suivi de l'explication de la réponse. Ajoute ensuite '[3]' avec 'Correcte' pour une réponse juste, et 'Incorrecte' pour une réponse fausse. Termine par [END].",
        "Il est impératif de respecter ce format sans aucune déviation. Les réponses doivent être pertinentes et liées directement à la question, sans information superflue.",
        "Exemple de réponse correcte : '[1]La balise &lt;p&gt;[2]La balise &lt;p&gt; sert à délimiter un paragraphe de texte en HTML.[3]Correcte[END].'",
        "Exemple de réponse incorrecte : '[1]La balise &lt;table&gt;[2]La balise &lt;table&gt; est destinée à la création de tableaux en HTML, et non à la définition de paragraphes.[3]Incorrecte[END].'",
        "Veille à ce que les segments '[1]', '[2]', et '[3]' de chaque réponse soient distinctement séparés et conservent l'ordre spécifié, sans omission ni altération.",
        "Pour la question donnée, génère quatre réponses suivant ce modèle, en veillant à inclure une seule réponse 'Correcte' et trois réponses 'Incorrectes'.",
        "Chaque ensemble de réponse doit se terminer par [END].",
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
        $content = "Peux-tu me proposer dix questions de niveau $level sur le thème $theme ?";

        return $this->chatStream(self::CUSTOM_INSTRUCTIONS_QUESTIONS, $content);
    }

    public function generateQuestion(string $theme, string $level): string
    {
        $content = "Peux-tu me proposer une question de niveau $level sur le thème $theme ?";

        return $this->chatStream(self::CUSTOM_INSTRUCTIONS_QUESTION, $content);
    }

    public function generateAnswers(Question $question): string
    {
        $content = "Peux-tu me proposer quatre réponses dont une seule est correcte à la question : {$question->getText()}";

        return $this->chatStream(self::CUSTOM_INSTRUCTIONS_ANSWERS, $content);
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
