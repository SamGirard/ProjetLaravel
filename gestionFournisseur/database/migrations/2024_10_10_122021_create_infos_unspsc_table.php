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
        Schema::create('infos_unspsc', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('neqFournisseur');
            $table->integer('code');
            $table->string('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('infos_unspsc');
    }
};
