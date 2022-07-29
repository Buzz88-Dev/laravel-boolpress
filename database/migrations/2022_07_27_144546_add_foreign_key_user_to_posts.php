<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyUserToPosts extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);  // con questa sintassi annulliamo questa istruzione ma la colonna rimane; togliamo la chiave esterna e poi la colonna
            $table->dropColumn(['user_id']);   // con questa sintassi eliminiamo la colonna
        });
    }
}
