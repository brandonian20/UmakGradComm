<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduates', function (Blueprint $table) {
            $table->integer('studentID', true);
            $table->text('Lastname');
            $table->text('Firstname');
            $table->text('Middlename')->nullable();
            $table->integer('pictureID')->nullable()->index('pictureID');
            $table->integer('bannerImageID')->nullable()->index('bannerImageID');
            $table->integer('acadYrID')->nullable();
            $table->integer('semID')->index('FK_70');
            $table->integer('honorID')->index('FK_63');
            $table->integer('programID')->index('FK_49');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graduates');
    }
}
