<?php

namespace Database\Seeders;
use App\Models\ElevenLabsVoice;
use App\Services\ElevenLabsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ElevenLabsVoiceSeeder extends Seeder
{
    protected $elevenLabsService;

    public function __construct(ElevenLabsService $elevenLabsService)
    {
        $this->elevenLabsService = $elevenLabsService;
    }

    public function run()
    {
        try {
            $voices = $this->elevenLabsService->getVoices();

            foreach ($voices['voices'] as $voice) {
                ElevenLabsVoice::where('api_voice_id', $voice['voice_id'])
                    ->update(['example_voice' => $voice['preview_url']]);

                /*ElevenLabsVoice::create([
                    'api_voice_id' => $voice['voice_id'],
                    'name' => $voice['name'],
                    'language' => $voice['fine_tuning']['language'],
                    'age' => $voice['labels']['age'],
                    'gender' => $voice['labels']['gender'],
                    'descriptive' => $voice['labels']['descriptive']??$voice['labels']['description']??null,
                    'description' => $voice['description']??null,
                    'example_voice' => $voice['preview_url'],
                ]);*/

            }
        } catch (\Exception $e) {
            \Log::error('Seeder failed: ' . $e->getMessage());
        }
    }
}
