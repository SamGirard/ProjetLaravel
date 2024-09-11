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
        Schema::create('demandes', function (Blueprint $table) {
            $table->integer('neqFournisseur')->unique();
            $table->foreign('neqFournisseur')->references('neq')->on('fournisseurs');

            $table->enum('etatDemande', ['Accepter', 'Refusé', 'En attente', 'Réviser']);
            $table->dateTime('dateChangementEtat');
            $table->dateTime('dateDeCreation');
            $table->dateTime('dateDerniereModif');
            $table->integer('numDemande')->primary();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
