<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGuestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest', function (Blueprint $table) {
            $table->foreign(['entID'], 'FK_90')->references(['entID'])->on('entity');
            $table->foreign(['positionID'], 'FK_107')->references(['positionID'])->on('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest', function (Blueprint $table) {
            $table->dropForeign('FK_90');
            $table->dropForeign('FK_107');
        });
    }
}
