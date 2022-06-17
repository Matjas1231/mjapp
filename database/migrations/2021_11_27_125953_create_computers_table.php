<?php

use App\Models\ComputerTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 60)->index();
            $table->string('model', 100)->index();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('processor', 60);
            $table->string('motherboard', 100);
            $table->string('ram', 200);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->string('ip_address')->default('Dynamic');
            $table->string('computer_name');
            $table->string('mac_address', 255);
            $table->string('serial_number', 255);
            $table->date('date_of_buy')->default(Carbon::now()->format('Y-m-d'));
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
        Schema::dropIfExists('computers');
    }
}
