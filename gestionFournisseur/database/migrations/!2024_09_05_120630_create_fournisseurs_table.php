<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('neq')->unique()->nullable();
            $table->string('nomEntreprise', 64);
            $table->json('typeNumTelephone');
            $table->json('numeroTelephone');
            $table->json('poste')->nullable();
            $table->string('email')->unique();
            $table->enum('etatDemande', ['Acceptée', 'Refusée', 'En attente', 'À réviser'])->default('En attente');
            $table->string('raisonRefus')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('numTPS')->nullable();
            $table->integer('numTVQ')->nullable();
            $table->string('conditionPaiement')->nullable();
            $table->string('devise', 64)->nullable();
            $table->string('modeCommunication', 64)->nullable();
            $table->string('numCivique', 8);
            $table->string('rue', 64);
            $table->string('bureau', 64)->nullable();
            $table->string('ville', 64);
            $table->enum('province', ['Québec', 'Ontario', 'Alberta', 'Manitoba', 'Saskatchewan', 'Colombie-Britannique', 'Nunavut', 'Territoire du Nort-Ouest', 'Yukon', 'Île-du-Prince-Édouard', 'Nouveau-Brunswick', 'Nouvelle-Écosse', 'Terre-Neuve-et-Labrador']);
            $table->string('codePostal', 7);
            $table->string('siteInternet', 64)->nullable();
            $table->string('regionAdministrative', 64)->nullable();
            $table->string('code_administratif');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
    }
};
