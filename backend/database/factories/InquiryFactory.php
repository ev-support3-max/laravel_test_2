<?php

namespace Database\Factories;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{

    protected $model = Inquiry::class;
    
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'corp_name' => $this->faker->optional()->company,
            'email' => $this->faker->safeEmail,
            'content' => $this->faker->realText(120),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
