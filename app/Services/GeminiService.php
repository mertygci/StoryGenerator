<?php

namespace App\Services;
// app/Services/ChatGPTService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function generateStory(array $data): string
    {
        $prompt = $this->constructPrompt($data);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            $responseData = $response->json();
            $story = $responseData['candidates'][0]['content']['parts'][0]['text'];
            $story = preg_replace('/^##.*\n/', '', $story);

            return $story ?? 'Oluşturulmuş bir masal yok.';
        } catch (\Exception $e) {
            return 'Masal oluştururken bir hata oluştu: ' . $e->getMessage();
        }
    }

    private function constructPrompt(array $data): string
    {
        $subjects = implode(', ', $data['subject'] ?? []);
        $location = $data['location'] ?? '';
        $characters = implode(', ', $data['character'] ?? []);
        $title = $data['title'] ?? '';
        $language = $data['language']?? 'TR';

        return "Create a story with the following details:\n\n"
            . "Title: $title\n"
            . "Subjects: $subjects\n"
            . "Location: $location\n"
            . "Characters: $characters\n\n"
            . "Language: $language\n"
            . "Your answer should be just the text of the story.";
    }
}
