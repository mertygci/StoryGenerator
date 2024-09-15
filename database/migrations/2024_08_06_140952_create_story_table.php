<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryTable extends Migration
{
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('content');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
