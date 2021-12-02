<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('departments')->truncate();

        $defaultDepartment = [
            'name' => 'aaaaaaaaaaaaaa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('departments')->insert($defaultDepartment);

        for ($j = 0; $j < 1; $j++) {
            $department = [];
            for ($i = 0; $i < 4; $i++) {
                $department[] = [
                    'name' => $faker->word(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('departments')->insert($department);
    }
}
