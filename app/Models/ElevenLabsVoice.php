<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElevenLabsVoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_voice_id',
        'name',
        'language',
        'age',
        'gender',
        'descriptive',
        'description',
        'example_voice'
    ];
}

