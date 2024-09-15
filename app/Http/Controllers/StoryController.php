<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\VoiceAudio;
use Exception;
use Illuminate\Http\Request;
use App\Services\GeminiService;
use App\Services\ElevenLabsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

class StoryController extends Controller
{

    public function __construct(
        protected GeminiService     $geminiService,
        protected ElevenLabsService $elevenLabsService)
    {
    }

    public function index(): Factory|View|Application
    {
        return view('story.multistep');
    }


    /**
     * @throws Exception
     */
    public function generateStory(Request $request): Redirector|Application|RedirectResponse
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

        $storyContent = $this->elevenLabsService->convertTextToAudio($story, $validated['voice'], $validated['language'], 'eleven_multilingual_v2');

        $savedStory = Story::create([
            'title' => $validated['title'] ?? 'Generated Story',
            'content' => $story,
        ]);

        $fileName = ($validated['title'] ?? 'Generated_Story') . '.mp3';
        $audioDirectory = public_path('audio/');

        // Ensure the 'audio' directory exists
        if (!file_exists($audioDirectory)) {
            mkdir($audioDirectory, 0777, true); // Create the directory with full permissions
        }

        $filePath = $audioDirectory . $fileName;
        file_put_contents($filePath, $storyContent);

        VoiceAudio::create([
            'story_id' => $savedStory->id,
            'voice_id' => $validated['voice'] ?? 'default_voice',
            'file_path' => 'audio/' . $fileName,
        ]);

        return redirect(route('showStory'))->with('audio_url', asset('audio/' . $fileName));
    }

    public function show(): Factory|View|Application
    {
        $stories = Story::with(['voiceAudios'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('story.show', compact('stories'));
    }
}
