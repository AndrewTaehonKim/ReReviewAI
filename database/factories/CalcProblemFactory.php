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
            'question' => 'Solve for $\\frac{dy}{dx}$ given $ y=e^x-cos(x) $. Good?',
            'A' => 'The answer is: $e^x$',
            'B' => '$\\frac{dy}{dx} = e^x+sin(x)$',
            'C' => 'No',
            'D' => '$\\frac{dy}{dx}$ = $e^x+sin(x)$',
            'answer_letter' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'answer' => 'The answer is: $\\frac{dy}{dx} = e^x+sin(x)$',
            'difficulty' => $this->faker->randomElement(['easy', 'medium', 'hard']),
            'tutorial_video' => $this->faker->url,
            'collegeboard_unit' => $this->faker->randomElement(['Unit 1', 'Unit 2', 'Unit 3']),
            'tags' => json_encode($this->faker->words(3)),
            'python_file_id' => PythonFile::factory()->create()->id
        ];
    }
}
