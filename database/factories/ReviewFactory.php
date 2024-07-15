<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'pengajuan_id' => $this->faker->numberBetween(1, 12),
            'statusPengajuan' => "Accept",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}