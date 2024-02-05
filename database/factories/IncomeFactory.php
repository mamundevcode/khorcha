<?php

namespace Database\Factories;


use App\Models\Income;
use Illuminate\Support\str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array{
        return [

             'income_title' =>fake()->text(50),
             'incate_id' =>fake()->numberBetween(1, 5),
             'income_amount' =>fake()->numberBetween(50, 150000),
             'income_date' =>fake()->dateTimeThisMonth()->format('Y-m-d'),

        ];
    }
}
