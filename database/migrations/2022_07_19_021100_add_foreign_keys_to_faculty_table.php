<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faculty', function (Blueprint $table) {
            $table->foreign(['positionID'], 'FK_113')->references(['positionID'])->on('position');
            $table->foreign(['entID'], 'FK_100')->references(['entID'])->on('entity');
            $table->foreign(['collegeID'], 'FK_97')->references(['collegeID'])->on('college');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faculty', function (Blueprint $table) {
            $table->dropForeign('FK_113');
            $table->dropForeign('FK_100');
            $table->dropForeign('FK_97');
        });
    }
}
