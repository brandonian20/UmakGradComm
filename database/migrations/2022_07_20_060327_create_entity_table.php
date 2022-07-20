<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity', function (Blueprint $table) {
            $table->integer('entID', true);
            $table->string('lastName', 100);
            $table->string('firstName', 100);
            $table->string('middleName', 100)->nullable();
            $table->integer('acadYrID')->index('FK_36');
            $table->integer('orgID')->index('FK_26');
            $table->integer('entTypeID')->index('FK_19');
            $table->string('message', 2000)->nullable();
            $table->dateTime('updatedAt')->nullable();
            $table->integer('updatedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity');
    }
}
