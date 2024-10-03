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
        Schema::create('modele_courriel', function (Blueprint $table) {
            $table->string('objet', 64)->primary(); // Clé primaire personnalisée
            $table->text('message');
            $table->string('role')->references('role')->on('roleCourriel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modele_courriel');
    }
};
