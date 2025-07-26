<?php


namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->jobTitle,
            'category' => 'IT',
            'job_type' => 'Full Time',
            'work_place' => 'Remote',
            'country' => 'Egypt',
            'city' => 'Cairo',
            'experience_from' => 1,
            'experience_to' => 3,
            'salary_range' => '2000$/m',
            'deadline' => now()->addDays(30),
        ];
    }
}
