<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PythonFile;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalcProblem>
 */
class CalcProblemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'A' => $this->faker->sentence,
            'B' => $this->faker->sentence,
            'C' => $this->faker->sentence,
            'D' => $this->faker->sentence,
            'answer_letter' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'answer' => $this->faker->sentence,
            'difficulty' => $this->faker->randomElement(['easy', 'medium', 'hard']),
            'tutorial_video' => $this->faker->url,
            'collegeboard_unit' => $this->faker->randomElement(['Unit 1', 'Unit 2', 'Unit 3']),
            'tags' => json_encode($this->faker->words(3)),
            'python_file_id' => PythonFile::factory()->create()->id
        ];
    }
}
