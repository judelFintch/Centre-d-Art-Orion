<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('podcast_episodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('series')->nullable();
            $table->string('episode_number')->nullable();
            $table->string('guest')->nullable();
            $table->string('duration')->nullable();
            $table->text('excerpt');
            $table->longText('description')->nullable();
            $table->longText('transcript')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('audio_file')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('accent')->default('#4caf7d');
            $table->boolean('featured')->default(false);
            $table->boolean('actif')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('podcast_episodes');
    }
};
