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

            $computerTypes = [];

            $computerTypes[] = [
                'type' => 'PC',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $computerTypes[] = [
                'type' => 'Laptop',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $computerTypes[] = [
                'type' => 'AiO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $computerTypes[] = [
                'type' => 'Terminal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];


        DB::table('computer_types')->insert($computerTypes);
    }
}
