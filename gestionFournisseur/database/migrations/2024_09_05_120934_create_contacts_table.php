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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Ajoute automatiquement une clé primaire nommée "id"
            $table->string('prenom', 64);
            $table->string('nom', 64);
            $table->string('fonction', 64);
            $table->string('courriel', 64)->unique();
            $table->enum('typeNumTelephone', ['Bureau', 'Télécopieur', 'Cellulaire']);
            $table->string('numTelephone', 10);
            $table->string('poste', 6)->nullable();
            $table->integer('neqFournisseur');
            $table->foreign('neqFournisseur')->references('neq')->on('fournisseurs');
            $table->string('courrielFournisseur', 64);
            $table->foreign('courrielFournisseur')->references('courriel')->on('fournisseurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
