<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entity', function (Blueprint $table) {
            $table->foreign(['orgID'], 'FK_24')->references(['orgID'])->on('organization');
            $table->foreign(['entTypeID'], 'FK_17')->references(['entTypeID'])->on('entitytype');
            $table->foreign(['acadYrID'], 'FK_34')->references(['acadYrID'])->on('academicyear');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entity', function (Blueprint $table) {
            $table->dropForeign('FK_24');
            $table->dropForeign('FK_17');
            $table->dropForeign('FK_34');
        });
    }
}
