<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            // $table->id();  // dobbiamo prendere l id della tabella users e non questo id (perche si incrementerebbe in automatico)
            $table->unsignedBigInteger('user_id');   // unsigned lo vedo nella tabella users colonna id: 1	id Primary	bigint(20) UNSIGNED	No	None AUTO_INCREMENT (copia/incolla dal database)
            // $table->timestamps(); // i timestamps() li togliamo
            $table->string('address', 100);    // queste dichiarazioni rispecchiano quello indicato nella function validator(array $data) in RegisterController.php
            $table->string('phone', 20);
            $table->date('birth');

            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users');  // la chiave esterna, colonna user_id, corrisponde alla colonna id della tabella users   --- onDelete(); analizzare
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_details');
    }
}
