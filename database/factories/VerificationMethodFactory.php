<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VerificationMethod>
 */
class VerificationMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'field_text' => $this->faker->sentence(20),
            'default_response' => $this->faker->sentence(30),
            'response_type' => '',
            
        ];
    }
}
