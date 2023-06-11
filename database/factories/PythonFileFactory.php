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
            'filename' => 'power_rule.py',
            'filenameWithoutExtension' => 'power_rule',
            'path'=> 'storage\app\python\calcBC\power_rule.py',
            'subject' => 'calcBC',
        ];
    }
}
