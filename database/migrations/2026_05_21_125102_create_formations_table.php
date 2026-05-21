<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('contenu')->nullable();
            $table->string('duree')->nullable();
            $table->string('niveau')->nullable();   // débutant, intermédiaire, avancé
            $table->string('public_cible')->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->string('categorie')->nullable();
            $table->boolean('actif')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
