<?php

namespace Database\Factories;

use App\Models\Publication; // Make sure Publication model is imported
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publication::class; // Ensure model is linked

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4), // Generate a short sentence for the title
            'content' => $this->faker->paragraphs(3, true), // Generate 3 paragraphs as a single string
            // created_at and updated_at are handled automatically
        ];
    }
}
