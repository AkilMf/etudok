<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 150);
            $table->string('adresse', 255);
            $table->string('telephone', 25);
            $table->string('email', 45);
            $table->date('date_naissance');
            $table->unsignedBigInteger('ville_id');

            $table->timestamps();
            $table->foreign('ville_id')->references('id')->on('villes')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
