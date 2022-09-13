<?php

namespace Database\Factories;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Software>
 */
class SoftwareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'producer' => fake()->words('2', true),
            'serial_number' => fake()->sentence(),
            'name' => fake()->firstName(),
            'worker_id' => fake()->numberBetween(Worker::all()->first()->id, Worker::all()->last()->id),
            'description' => fake()->sentence(9),
            'date_of_buy' => fake()->date(),
            'expiry_date' => fake()->date(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
