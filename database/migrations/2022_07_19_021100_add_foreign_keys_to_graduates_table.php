<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGraduatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graduates', function (Blueprint $table) {
            $table->foreign(['honorID'], 'FK_61')->references(['honorID'])->on('honor');
            $table->foreign(['programID'], 'FK_47')->references(['programID'])->on('program');
            $table->foreign(['semID'], 'FK_68')->references(['semID'])->on('semester');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('graduates', function (Blueprint $table) {
            $table->dropForeign('FK_61');
            $table->dropForeign('FK_47');
            $table->dropForeign('FK_68');
        });
    }
}
