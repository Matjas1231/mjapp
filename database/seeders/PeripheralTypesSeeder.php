<?php

namespace Database\Seeders;

use Database\Factories\PeripheralTypeFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeripheralTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peripheral_types')->truncate();
        $factory = new PeripheralTypeFactory(fake()->numberBetween(3, 15));

        $factory->create();
    }
}
