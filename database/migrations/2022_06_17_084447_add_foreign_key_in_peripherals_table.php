<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peripherals', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('peripheral_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('peripherals', function (Blueprint $table) {
            $table->dropForeign('peripherals_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
};
