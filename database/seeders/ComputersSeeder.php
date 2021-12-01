<?php

namespace Database\Seeders;

use App\Models\ComputerTypes;
use App\Models\Worker;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ComputersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('computers')->truncate();

        for ($j = 0; $j < 1; $j++) {
            $computers = [];
            for ($i = 0; $i < 10; $i++) {
                $computers[] = [
                    'brand' => $faker->randomElement(['Dell', 'HP', 'Lenovo', 'Fujitsu']),
                    // 'brand' => $faker->randomElement(),
                    'model' => $faker->word(),
                    'type_id' => $faker->numberBetween(1, ComputerTypes::all()->count()),
                    'processor' => $faker->words(4, true),
                    'motherboard' => $faker->words(4, true),
                    'description' => $faker->words(30, true),
                    'ram' => $faker->words(2, true),
                    'worker_id' => $faker->numberBetween(1, Worker::all()->count()),
                    'computer_name' => $faker->word(),
                    'date_of_buy' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('computers')->insert($computers);
    }
}
