<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ComputerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('computer_types')->truncate();

        for ($j = 0; $j < 1; $j++) {
            $computerTypes = [];
            for ($i = 0; $i < 6; $i++) {
                $computerTypes[] = [
                    'type' => $faker->word(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('computer_types')->insert($computerTypes);
    }
}
