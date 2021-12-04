<?php

use App\Models\ComputerTypes;
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
            // $table->integer('type_id', false, false);
            $table->foreignId('type_id')->nullable()->references('id')->on('computer_types')->onDelete('set null');
            $table->string('processor', 60);
            $table->string('motherboard', 100);
            $table->string('ram', 200);
            $table->text('description')->nullable();
            $table->foreignId('worker_id')->nullable()->references('id')->on('workers')->onDelete('set null');
            $table->string('ip_address')->default('Dynamic');
            $table->string('computer_name');
            $table->date('date_of_buy')->default('Nieprzypisany');
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
