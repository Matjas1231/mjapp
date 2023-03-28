<?php

namespace Database\Seeders;

use Database\Factories\SoftwareFactory;
use Illuminate\Database\Seeder;
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
        DB::table('softwares')->delete();

        $factory = new SoftwareFactory(fake()->numberBetween(20, 150));
        $factory->create();
    }
}
