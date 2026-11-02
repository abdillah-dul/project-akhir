<?php

namespace Database\Factories;

use App\Models\LayananServis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LayananServis>
 */
class LayananServisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->unique()->words(2, true),
            'deskripsi' => fake()->sentence(),
            'harga' => fake()->numberBetween(100000, 1000000),
            'estimasi_menit' => fake()->randomElement([30, 60, 90, 120]),
            'is_active' => true,
        ];
    }
}
