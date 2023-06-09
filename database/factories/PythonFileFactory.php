<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PythonFile>
 */
class PythonFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'filename' => $this->faker->word,
            'filenameWithoutExtension' => $this->faker->word,
            'path'=> $this->faker->word,
            'subject' => $this->faker->word
        ];
    }
}
