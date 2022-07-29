<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();     // obbligatorio
            $table->string('title', 100);    // obbligatorio
            $table->string('image', 100)->nullable();    //non è obbligatorio e quindi metto nullable()
            $table->text('content')->nullable();     //non è obbligatorio e quindi metto nullable()
            $table->string('excerpt', 1500)->nullable();   //non è obbligatorio e quindi metto nullable()
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
