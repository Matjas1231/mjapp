<?php

namespace Database\Seeders;

use App\Models\Department;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('workers')->truncate();

        for ($j = 0; $j < 1; $j++) {
            $workers = [];
            for ($i = 0; $i < $faker->numberBetween(652, 2125); $i++) {
                $workers[] = [
                    'name' => $faker->name(),
                    'surname' => $faker->name(),
                    'position' => $faker->name(),
                    'department_id' => $faker->numberBetween(1, Department::all()->count()),
                    'phone' => $faker->phoneNumber(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('workers')->insert($workers);
    }
}
