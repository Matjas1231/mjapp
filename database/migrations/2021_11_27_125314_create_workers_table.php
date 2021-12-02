<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->index();
            $table->string('surname', 60)->index();
            $table->string('position', 60);
            // $table->foreignId('department_id')->nullable()->references('id')->on('departments')->onDelete('set null');
            $table->foreignId('department_id')->default(1)->constrained('departments')->onDelete('set default');
            $table->string('phone', 12);
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
        Schema::dropIfExists('workers');
    }
}
