<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->enum('type', ['PC', 'Laptop', 'AiO', 'Terminal']);
            $table->string('processor', 60);
            $table->string('motherboard', 100);
            $table->string('ram', 200);
            $table->string('description', 1000);
            $table->integer('worker_id', false, true);
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
