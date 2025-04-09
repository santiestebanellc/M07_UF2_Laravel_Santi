<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Actor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'birthdate' => $this->faker->date('Y-m-d', '-18 years'),
            'country' => $this->faker->country(),
            'img_url' => $this->faker->imageUrl(640, 480, 'people'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}