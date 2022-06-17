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

        DB::table('peripherals')->delete();

        for ($j = 0; $j < 1; $j++) {
            $peripherals = [];
            for ($i = 0; $i < $faker->numberBetween(100, 110); $i++) {
                $peripherals[] = [
                    'brand' => $faker->randomElement(['Dell', 'HP', 'Brother', 'Canon']),
                    'model' => $faker->words(2, true),
                    'serial_number' => $faker->words(5, true),
                    'type_id' => $faker->numberBetween(PeripheralType::all()->first()->id, PeripheralType::all()->last()->id),
                    'description' => $faker->words(30, true),
                    'worker_id' => $faker->numberBetween(Worker::all()->first()->id, Worker::all()->last()->id),
                    'date_of_buy' => $faker->date(),
                    'ip_address' => $faker->ipv4(),
                    'mac_address' => $faker->macAddress(),
                    'network_name' => $faker->word(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('peripherals')->insert($peripherals);
    }
}
