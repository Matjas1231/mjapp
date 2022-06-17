<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CreateSoftwaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softwares', function (Blueprint $table) {
            $table->id();
            $table->string('producer', 50);
            $table->string('serial_number', 150)->unique('sn');
            $table->string('name', 60);
            $table->foreignId('worker_id')->nullable()->references('id')->on('workers')->onDelete('set null');
            $table->text('description')->nullable();
            $table->date('date_of_buy')->default(Carbon::now()->format('Y-m-d'));
            $table->date('expiry_date')->default(Carbon::now()->format('Y-m-d'));
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
        Schema::dropIfExists('softwares');
    }
}
