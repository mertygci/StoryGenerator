<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];


    public function voiceAudios(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VoiceAudio::class);
    }
}
