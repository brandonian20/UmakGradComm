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
            $table->integer('acadYrID')->primary();
            $table->date('year');
            $table->string('theme', 500);
            $table->string('youtubeLiveLink', 1000);
            $table->integer('batchNum');
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
