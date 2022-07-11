<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFreedomwallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('freedomwall', function (Blueprint $table) {
            $table->foreign(['acadYrID'], 'FK_127')->references(['acadYrID'])->on('academicyear');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('freedomwall', function (Blueprint $table) {
            $table->dropForeign('FK_127');
        });
    }
}
