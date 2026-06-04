<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('billets', function (Blueprint $table) {
            $table->foreignId('billet_categorie_id')
                  ->nullable()
                  ->after('evenement_id')
                  ->constrained('billet_categories')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('billets', function (Blueprint $table) {
            $table->dropForeign(['billet_categorie_id']);
            $table->dropColumn('billet_categorie_id');
        });
    }
};
