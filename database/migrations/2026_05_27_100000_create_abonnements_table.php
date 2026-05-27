<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nom')->nullable();
            $table->enum('type', ['newsletter', 'blog'])->default('newsletter');
            $table->string('token', 64)->unique();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->timestamps();

            $table->unique(['email', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
