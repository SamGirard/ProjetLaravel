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
        Schema::create('fournisseur', function (Blueprint $table) {
            $table->string('neq')->primary();
            $table->string('courriel')->primary();
            $table->string('password');
            $table->string('nomEntreprise');
            $table->string('numRBQ');
            $table->string('numCivique');
            $table->string('rue');
            $table->string('bureau');
            $table->string('ville');
            $table->enum('province', ['Québec', 'Ontario', 'Alberta', 'Manitoba', 'Saskatchewan', 'Colombie-Britannique', 'Nunavut', 'Territoire du Nort-Ouest', 'Yukon', 'Île-du-Prince-Édouard', 'Nouveau-Brunswick', 'Nouvelle-Écosse', 'Terre-Neuve-et-Labrador']);
            $table->string('codePostal');
            $table->string('siteInternet');
            $table->string('régionAdministrative');
            $table->enum('TypeNumTelephone', ['Bureau', 'Télécopieur', 'Cellulaire']);
            $table->string('numéroTelephone');
            $table->string('poste');
            $table->string('courrielContact');
            $table->string('numTPS')->nullable();
            $table->string('numTVQ')->nullable();
            $table->string('conditionPaiement');
            $table->string('devise');
            $table->string('modeCommunication');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseur');
    }
};
