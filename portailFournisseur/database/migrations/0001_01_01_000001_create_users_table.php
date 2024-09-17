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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('neq')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nomEntreprise', 64);
            $table->unsignedBigInteger('infos_rbq_id');
            $table->foreign('infos_rbq_id')->references('id')->on('infos_rbqs');
            $table->string('numCivique', 8);
            $table->string('rue', 64);
            $table->string('bureau', 64)->nullable();
            $table->string('ville', 64);
            $table->enum('province', ['Québec', 'Ontario', 'Alberta', 'Manitoba', 'Saskatchewan', 'Colombie-Britannique', 'Nunavut', 'Territoire du Nort-Ouest', 'Yukon', 'Île-du-Prince-Édouard', 'Nouveau-Brunswick', 'Nouvelle-Écosse', 'Terre-Neuve-et-Labrador']);
            $table->string('codePostal', 6);
            $table->string('siteInternet', 64)->nullable();
            $table->string('régionAdministrative', 64)->nullable();
            $table->enum('TypeNumTelephone', ['Bureau', 'Télécopieur', 'Cellulaire']);
            $table->integer('numéroTelephone');
            $table->string('poste', 64)->nullable();
            $table->string('courrielContact', 64);
            $table->integer('numTPS')->nullable();
            $table->integer('numTVQ')->nullable();
            $table->string('conditionPaiement', 128)->nullable();
            $table->string('devise', 64)->nullable();
            $table->string('modeCommunication', 64)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
