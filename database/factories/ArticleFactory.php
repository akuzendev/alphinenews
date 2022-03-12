<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'subtitle' => $this->faker->name(),
            'catergory' => $this->faker->randomDigit(),
            'status' => $this->faker->randomDigit(),
            'thumbnail' => $this->faker->imageUrl($width = 640, $height = 480),
            'byuserid' => 1,
            'content' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'date' => $this->faker->dateTime(),
            'authorizedbyid' => 1,
            'authorizeddate' => $this->faker->dateTime(),

        ];
    }
}
