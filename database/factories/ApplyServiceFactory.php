<?php

namespace Database\Factories;

use App\Models\ApplyService;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;
use App\ModeLs\User;
class ApplyServiceFactory extends Factory
{
    protected $model = ApplyService::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(['user_role' => 'provider']),
            'job_id' => Job::factory(),
            'answers' => $this->faker->randomElements([
                'Available immediately', '3 years experience', 'Yes'
            ], 2),
        ];
    }
}

