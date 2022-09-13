<?php

namespace Database\Factories;

use App\Models\PeripheralType;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peripheral>
 */
class PeripheralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand' => fake()->randomElement(['Dell', 'HP', 'Brother', 'Canon']),
            'model' => fake()->words(2, true),
            'serial_number' => fake()->words(5, true),
            'type_id' => fake()->numberBetween(PeripheralType::all()->first()->id, PeripheralType::all()->last()->id),
            'description' => fake()->words(30, true),
            'worker_id' => fake()->numberBetween(Worker::all()->first()->id, Worker::all()->last()->id),
            'date_of_buy' => fake()->date(),
            'ip_address' => fake()->ipv4(),
            'mac_address' => fake()->macAddress(),
            'network_name' => fake()->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
