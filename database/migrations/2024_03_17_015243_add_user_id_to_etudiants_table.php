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
        //php artisan make:migration add_user_id_to_etudiants_table

        // php artisan migrate --path=/database/migrations/2024_03_17_015243_add_user_id_to_etudiants_table.php
        Schema::table('etudiants', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('etudiants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
