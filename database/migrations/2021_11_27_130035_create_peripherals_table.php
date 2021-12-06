<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeripheralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peripherals', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 60);
            $table->string('model', 100)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->foreignId('type_id')->nullable()->references('id')->on('peripheral_types')->onDelete('set null');
            $table->text('description')->nullable();
            $table->foreignId('worker_id')->nullable()->references('id')->on('workers')->onDelete('set null');
            $table->date('date_of_buy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peripherals');
    }
}
