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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->integer('neq')->primary(); // Clef primaire
            $table->string('courriel', 64)->unique(); //clef primaire secondaire
            $table->string('password', 64);
            $table->string('nomEntreprise', 64);
            $table->string('num_rbq', 10);
            $table->foreign('num_rbq')->references('numLicense')->on('infos_rbq');

            $table->string('numCivique', 8);
            $table->string('rue', 64);
            $table->string('bureau', 64)->nullable();
            $table->string('ville', 64);
            $table->enum('province', ['Québec', 'Ontario', 'Alberta', 'Manitoba', 'Saskatchewan', 'Colombie-Britannique', 'Nunavut', 'Territoire du Nort-Ouest', 'Yukon', 'Île-du-Prince-Édouard', 'Nouveau-Brunswick', 'Nouvelle-Écosse', 'Terre-Neuve-et-Labrador']);
            $table->string('codePostal', 6);
            $table->string('siteInternet', 64)->nullable();
            $table->string('régionAdministrative', 64)->nullable();
            $table->enum('TypeNumTelephone', ['Bureau', 'Télécopieur', 'Cellulaire']);
            $table->string('numéroTelephone', 64);
            $table->string('poste', 64)->nullable();
            $table->string('courrielContact', 64);
            $table->integer('numTPS')->nullable();
            $table->integer('numTVQ')->nullable();
            $table->string('conditionPaiement', 128)->nullable();
            $table->string('devise', 64)->nullable();
            $table->string('modeCommunication', 64)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
