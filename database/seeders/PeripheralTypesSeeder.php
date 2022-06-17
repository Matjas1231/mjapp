<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
        $faker = Factory::create();

        DB::table('peripheral_types')->delete();

        for ($j = 0; $j < 1; $j++) {
            $peripherals = [];
            for ($i = 0; $i < $faker->numberBetween(3, 15); $i++) {
                $peripherals[] = [
                    'type' => $faker->word(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('peripheral_types')->insert($peripherals);
    }
}
