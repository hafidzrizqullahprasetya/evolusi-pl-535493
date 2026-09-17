<?php

namespace Database\Factories;

use App\Models\Tugas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tugas>
 */
class TugasFactory extends Factory
{
    protected $model = Tugas::class;

    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(3),
            'mata_kuliah' => fake()->randomElement(['KEPL', 'PPD', 'PPG', 'PPKN']),
            'tenggat' => fake()->dateTimeBetween('now', '+1 month'),
            'selesai' => fake()->boolean(),
        ];
    }
}
