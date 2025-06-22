<?php

namespace Database\Factories;

use App\Models\COA;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\COA>
 */
class COAFactory extends Factory
{
    protected $model = COA::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => $this->faker->unique()->regexify('[1-9]{1}\.[0-9]{1}(\.[0-9]{1})?'),
        ];
    }
}
