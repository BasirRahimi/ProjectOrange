<?php

namespace Database\Factories;

use App\Models\CaseType;
use App\Models\POCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\POCase>
 */
class POCaseFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = POCase::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'       => User::factory(),
            'case_type_id'  => CaseType::first()->id,
            'name'          => fake()->name(),
            'status'        => 'Awaiting Submission',
            'pre_submitted' => 0
        ];
    }
}
