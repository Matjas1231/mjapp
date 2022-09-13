<?php

namespace Database\Factories;

use App\Models\ComputerTypes;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand' => fake()->randomElement(['Dell', 'HP', 'Lenovo', 'Fujitsu']),
            'model' => fake()->word(),
            'type_id' => fake()->numberBetween(ComputerTypes::all()->first()->id, ComputerTypes::all()->last()->id),
            'processor' => fake()->words(4, true),
            'motherboard' => fake()->words(4, true),
            'description' => fake()->words(30, true),
            'ram' => fake()->words(2, true),
            'worker_id' => fake()->numberBetween(Worker::all()->first()->id, Worker::all()->last()->id),
            'ip_address' => fake()->ipv4(),
            'mac_address' => fake()->macAddress(),
            'computer_name' => fake()->word(),
            'date_of_buy' => fake()->date(),
            'serial_number' => fake()->sentence(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
