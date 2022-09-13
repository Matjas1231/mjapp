<?php

namespace Database\Seeders;

use App\Models\ComputerTypes;
use App\Models\Worker;
use Database\Factories\ComputerFactory;
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
        DB::table('computers')->delete();

        $factory = new ComputerFactory(fake()->numberBetween(100, 300));
        $factory->create();
    }
}
