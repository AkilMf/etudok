<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // insert into users (id, name, email, password) SELECT id, nom, EMAIL,DATE_FORMAT(date_naissance, '%Y%m%d') as password from etudiants
    // UPDATE etudiants SET user_id = id;
    // ALTER TABLE etudiants MODIFY id INT, DROP PRIMARY KEY, ADD PRIMARY KEY (user_id);
    //ALTER TABLE etudiants MODIFY user_id BIGINT UNSIGNED AUTO_INCREMENT;
    //alter TABLE etudiants drop COLUMN id
    //ALTER TABLE etudiants DROP PRIMARY KEY, CHANGE user_id id BIGINT UNSIGNED AUTO_INCREMENT, ADD PRIMARY KEY (id);

    //alter table etudiants AUTO_INCREMENT = 102 
    //comes from 'max(id) from etudiants'  + 1

    //alter TABLE etudiants drop COLUMN email, drop column nom

    //ALTER TABLE etudiants MODIFY id BIGINT UNSIGNED, DROP PRIMARY KEY, ADD PRIMARY KEY (id); (je delete l'AI as it will receive the id from users)


    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('etudiants', function (Blueprint $table) {
            // deleting primary key


            /*             $table->dropPrimary();
                        $table->unsignedInteger('id')->change();
                        $table->dropColumn('id');
                        $table->bigIncrements('user_id')->primary()->change(); */


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
