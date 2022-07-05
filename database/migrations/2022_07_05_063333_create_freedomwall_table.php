<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreedomwallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freedomwall', function (Blueprint $table) {
            $table->integer('freedomWallID')->primary();
            $table->string('content', 1000);
            $table->integer('acadYrID')->index('FK_129');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freedomwall');
    }
}
