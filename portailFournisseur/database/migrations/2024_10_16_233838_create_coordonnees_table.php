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
        Schema::create('coordonnees', function (Blueprint $table) {
            $table->id();
            $table->string('numCivique', 8);
            $table->string('rue', 64);
            $table->string('bureau', 64)->nullable();
            $table->string('ville', 64);
            $table->enum('province', ['Québec', 'Ontario', 'Alberta', 'Manitoba', 'Saskatchewan', 'Colombie-Britannique', 'Nunavut', 'Territoire du Nort-Ouest', 'Yukon', 'Île-du-Prince-Édouard', 'Nouveau-Brunswick', 'Nouvelle-Écosse', 'Terre-Neuve-et-Labrador']);
            $table->string('codePostal', 7);
            $table->string('siteInternet', 64)->nullable();
            $table->string('regionAdministrative', 64)->nullable();
            $table->string('code_administratif');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordonnees');
    }
};
