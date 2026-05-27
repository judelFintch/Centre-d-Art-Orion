<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mail_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mailer')->default('smtp');           // smtp, log, sendmail
            $table->string('from_name')->default('');
            $table->string('from_email')->default('');
            $table->string('reply_to')->nullable();
            $table->string('host')->nullable();
            $table->unsignedSmallInteger('port')->default(587);
            $table->string('username')->nullable();
            $table->text('password')->nullable();               // chiffré
            $table->string('encryption')->nullable();           // tls, ssl ou null
            $table->boolean('actif')->default(false);           // false = utiliser .env
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mail_settings');
    }
};
