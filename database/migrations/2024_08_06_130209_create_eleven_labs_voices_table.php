<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevenLabsVoicesTable extends Migration
{
    public function up()
    {
        Schema::create('eleven_labs_voices', function (Blueprint $table) {
            $table->id();
            $table->string('api_voice_id'); // ElevenLabs API'den alınan ses modeli ID'si
            $table->string('name');
            $table->string('language');
            $table->string('age');
            $table->string('gender');
            $table->string('descriptive')->nullable();
            $table->longText('description')->nullable();
            $table->string('example_voice')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleven_labs_voices');
    }
}
