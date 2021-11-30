<?php

namespace Database\Seeders;

use App\Models\PeripheralType;
use App\Models\Worker;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
        $faker = Factory::create();

        DB::table('peripherals')->truncate();

        for ($j = 0; $j < 1; $j++) {
            $peripherals = [];
            for ($i = 0; $i < 20; $i++) {
                $peripherals[] = [
                    'brand' => $faker->randomElement(['Dell', 'HP', 'Brother', 'Canon']),
                    'model' => $faker->words(4, true),
                    'type_id' => $faker->numberBetween(1, PeripheralType::all()->count()),
                    'description' => $faker->words(30, true),
                    'worker_id' => $faker->numberBetween(1, Worker::all()->count()),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('peripherals')->insert($peripherals);
    }
}
