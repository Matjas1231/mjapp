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

        DB::table('workers')->delete();

        for ($j = 0; $j < 1; $j++) {
            $workers = [];
            for ($i = 0; $i < $faker->numberBetween(10, 100); $i++) {
                $workers[] = [
                    'name' => $faker->name(),
                    'surname' => $faker->name(),
                    'position' => $faker->name(),
                    'department_id' => $faker->numberBetween(Department::all()->first()->id, Department::all()->last()->id),
                    'phone' => $faker->word(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        dd($workers);
        DB::table('workers')->insert($workers);
    }
}
