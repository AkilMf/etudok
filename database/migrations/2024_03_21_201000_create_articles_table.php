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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->json('titre');
            $table->json('contenu');
            $table->date('date');
            $table->timestamps();
            $table->foreignId('etudiant_id')->constrained('etudiants');
        });
    }
    //php artisan make:migration create_articles_table
    //php artisan migrate --path=/database/migrations/2024_03_21_201000_create_articles_table.php
    //php artisan make:migration add_etudiant_id_to_articles_table
    //php artisan migrate --path=/database/migrations/2024_03_21_204236_add_etudiant_id_to_articles_table.php

    /*  SELECT TABLE_NAME, CONSTRAINT_TYPE, CONSTRAINT_NAME
        FROM information_schema.table_constraints
        WHERE table_name='etudiants'; */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');/* 
$table->dropForeign(['etudiant_id']);
$table->dropColumn('etudiant_id'); */
    }
};
