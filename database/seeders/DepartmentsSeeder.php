<?php

namespace Database\Seeders;

use Database\Factories\DepartmentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();

        $factory = new DepartmentFactory(fake()->numberBetween(5,24));
        $factory->create();
    }
}
