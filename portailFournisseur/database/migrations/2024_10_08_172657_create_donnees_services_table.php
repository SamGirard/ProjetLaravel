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
        Schema::create('donnees_services', function (Blueprint $table) {
            $table->id();
            $table->string('nature');
            $table->string('code_categorie');
            $table->string('description_Categorie');
            $table->string('categorie');
            $table->string('code_unspsc');
            $table->string('description_detaille_unspsc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donnees_services');
    }
};
