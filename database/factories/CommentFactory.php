<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'byuserid' => $this->faker->randomDigit(),
            'content' => $this->faker->randomDigit(),
            'date' => $this->faker->dateTime(),
            'onarticleid' => $this->faker->randomDigit(),
            'status' => $this->faker->randomDigit(),
            'authorizedbyid' => $this->faker->randomDigit(),
            'authorizeddate' => $this->faker->dateTime(),

        ];
    }
}
