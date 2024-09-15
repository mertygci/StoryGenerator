<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ElevenLabsService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.eleven_labs.key');
    }

    /**
     * @throws \Exception
     */
    public function convertTextToAudio(
        $textToConvert,
        $voiceId,
        $language = 'tr',
        $modelId = null
    ) {
        $postData = [
            'text' => $textToConvert,
            'model_id' => $modelId,
            'language' => $language
        ];


        $response = Http::withHeaders([
            'accept' => 'audio/mpeg',
            'content-type' => 'application/json',
            'xi-api-key' => $this->apiKey,
        ])->post('https://api.elevenlabs.io/v1/text-to-speech/' . $voiceId, $postData);

        if ($response->successful()) {
            return $response->body();
        } else {
            Log::error('Metin ses dönüşümünde bir sorun yaşandı: ' . $response->status() . ' - ' . $response->body());
            throw new \Exception('Metin ses dönüşümünde bir sorun yaşandı: ' . $response->status() . ' - ' . $response->body());
        }
    }
}
