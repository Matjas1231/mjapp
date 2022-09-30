<?php

namespace Database\Seeders;

use Database\Factories\WorkerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workers')->truncate();

        $factory = new WorkerFactory(fake()->numberBetween(10, 100));
        $factory->create();
    }
}
