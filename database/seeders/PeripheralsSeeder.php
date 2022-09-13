<?php

namespace Database\Seeders;
use Database\Factories\PeripheralFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeripheralsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peripherals')->delete();

        $factory = new PeripheralFactory(fake()->numberBetween(100, 110));
        $factory->create();
    }
}
