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
        Schema::table('computers', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('computer_types')->onDelete('set null');
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('computers', function (Blueprint $table) {
            $table->dropForeign('computers_type_id_foreign');
            $table->dropColumn('type_id');
            $table->dropForeign('computers_worker_id_foreign');
            $table->dropColumn('worker_id');
        });
    }
};
