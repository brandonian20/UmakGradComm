<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicyearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academicyear', function (Blueprint $table) {
            $table->integer('acadYrID', true);
            $table->year('year');
            $table->string('theme', 500)->nullable();
            $table->string('youtubeLiveLink', 1000)->nullable();
            $table->integer('batchNum')->nullable();
            $table->integer('updatedBy')->nullable();
            $table->dateTime('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academicyear');
    }
}
