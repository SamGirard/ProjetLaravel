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
        Schema::create('fichier_externes', function (Blueprint $table) {
            $table->id();
            $table->integer('neqFournisseur')->unique();
            $table->foreign('neqFournisseur')->references('neq')->on('fournisseurs');

            $table->string('courrielFournisseur', 64)->unique();
            $table->foreign('courrielFournisseur')->references('courriel')->on('fournisseurs');

            $table->string('fichier', 255);
            $table->string('carteAffaire', 255);
            $table->dateTime('dateCreation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichier_externes');
    }
};
