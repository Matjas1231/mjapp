<?php

namespace Database\Seeders;

use App\Models\Worker;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SoftwaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('softwares')->delete();

        for ($j = 0; $j < 1; $j++) {
            $softwares = [];
            for ($i = 0; $i < $faker->numberBetween(20, 150); $i++) {
                $softwares[] = [
                    'producer' => $faker->words('2', true),
                    'serial_number' => $faker->sentence(),
                    'name' => $faker->firstName(),
                    'worker_id' => $faker->numberBetween(Worker::all()->first()->id, Worker::all()->last()->id),
                    'description' => $faker->sentence(9),
                    'date_of_buy' => $faker->date(),
                    'expiry_date' => $faker->date(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('softwares')->insert($softwares);
    }
}
