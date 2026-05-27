<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->id();

            // Identifiant de session anonyme (UUID généré côté JS, stocké en localStorage)
            $table->string('session_id', 64)->index();

            // Page visitée
            $table->string('page_url', 500);
            $table->string('page_titre', 300)->nullable();

            // Provenance
            $table->string('referrer', 500)->nullable();

            // Appareil & navigateur (déduits du User-Agent côté serveur)
            $table->string('appareil', 20)->nullable();    // desktop | mobile | tablet
            $table->string('navigateur', 50)->nullable();  // Chrome | Firefox | Safari | Edge | Opera | Autre
            $table->string('os', 50)->nullable();          // Windows | macOS | Linux | Android | iOS | Autre

            // IP anonymisée (dernier octet masqué — RGPD)
            $table->string('ip_anonyme', 30)->nullable();

            // Métriques comportementales (mises à jour à la sortie de la page)
            $table->unsignedSmallInteger('temps_passe')->default(0);        // secondes
            $table->unsignedTinyInteger('profondeur_scroll')->default(0);   // 0-100 %

            // Nouveau visiteur ? (true si session_id jamais vu auparavant)
            $table->boolean('est_nouveau_visiteur')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
