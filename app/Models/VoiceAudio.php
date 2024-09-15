<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceAudio extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_id',
        'voice_id',
        'file_path',
    ];


    public function story(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Story::class);
    }
}
