<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('billets', function (Blueprint $table) {
            // mpesa | airtel | orange | especes | null (gratuit)
            $table->string('methode_paiement')->nullable()->after('statut');
            $table->string('reference_paiement')->nullable()->after('methode_paiement');
            $table->string('preuve_paiement')->nullable()->after('reference_paiement'); // chemin fichier
            $table->boolean('paiement_verifie')->default(false)->after('preuve_paiement');
        });
    }

    public function down(): void
    {
        Schema::table('billets', function (Blueprint $table) {
            $table->dropColumn(['methode_paiement', 'reference_paiement', 'preuve_paiement', 'paiement_verifie']);
        });
    }
};
