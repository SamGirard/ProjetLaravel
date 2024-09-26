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
        Schema::create('infos_rbq', function (Blueprint $table) {
            $table->string('numLicense', 10)->primary(); // Clé primaire personnalisée
            $table->integer('neqFournisseur');
            $table->string('courrielFournisseur', 64);
            $table->enum('statut', ['Valide', 'Valide avec restriction', 'Non valide']);
            $table->enum('typeLicense', ['Entrepreneur', 'Contracteur-Propriétaire']);
            $table->enum('Catégorie', ['Général', 'Spécialisé']);
            $table->string('codeSousCategorie', 64);
            $table->string('travauxPermis', 249);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos_rbq');
    }
};
