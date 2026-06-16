<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipe_roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->string('couleur', 20)->default('#4caf7d');
            $table->boolean('actif')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });

        DB::table('equipe_roles')->insert([
            ['nom' => 'PDG / CEO', 'slug' => 'ceo', 'couleur' => '#d4a030', 'actif' => true, 'ordre' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Chef de centre', 'slug' => 'chef_centre', 'couleur' => '#d4a030', 'actif' => true, 'ordre' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Formateur(trice)', 'slug' => 'formateur', 'couleur' => '#4caf7d', 'actif' => true, 'ordre' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Artiste', 'slug' => 'artiste', 'couleur' => '#e07030', 'actif' => true, 'ordre' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Membre', 'slug' => 'membre', 'couleur' => '#4caf7d', 'actif' => true, 'ordre' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('equipe_roles');
    }
};
