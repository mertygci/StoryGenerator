<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\VoiceAudio;
use Exception;
use Illuminate\Http\Request;
use App\Services\GeminiService;
use App\Services\ElevenLabsService;

class StoryController extends Controller
{

    protected $geminiService;
    protected $elevenLabsService;

    public function __construct(GeminiService $geminiService, ElevenLabsService $elevenLabsService)
    {
        $this->geminiService = $geminiService;
        $this->elevenLabsService = $elevenLabsService;
    }

    public function index()
    {
        return view('story.multistep');
    }


    /**
     * @throws Exception
     */
    public function generateStory(Request $request)
    {
        set_time_limit(120);

        $validated = $request->validate([
            'subject' => 'nullable',
            'location' => 'nullable',
            'character' => 'nullable',
            'title' => 'nullable',
            'language' => 'nullable',
            'voice' => 'nullable',
        ]);

        $story = $this->geminiService->generateStory($validated);

        $storyContent = $this->elevenLabsService->convertTextToAudio($story,$validated['voice'],$validated['language'],'eleven_multilingual_v2');

        $savedStory = Story::create([
            'title' => $validated['title'] ?? 'Generated Story',
            'content' => $story,
        ]);

        $fileName = $validated['title'] . '.mp3';
        $filePath = public_path('audio/' . $fileName);
        file_put_contents($filePath, $storyContent);

        VoiceAudio::create([
            'story_id' => $savedStory->id,
            'voice_id' => $validated['voice'] ?? 'default_voice',
            'file_path' => 'audio/' . $fileName,
        ]);

        return redirect(route('showStory'))->with('audio_url', asset('audio/' . $fileName));
    }

    public function show()
    {
        $stories = Story::with(['voiceAudios'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('story.show',compact('stories'));
    }
}
