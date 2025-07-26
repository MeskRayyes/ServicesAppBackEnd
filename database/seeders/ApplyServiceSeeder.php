<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplyService;
use App\Models\User;
use App\Models\Job;

class ApplyServiceSeeder extends Seeder
{
    public function run(): void
    {
        $providers = User::where('user_role', 'provider')->get();
        $jobs = Job::all();

        foreach ($providers as $provider) {
            foreach ($jobs->random(min(2, $jobs->count())) as $job) {
                ApplyService::firstOrCreate([
                    'user_id' => $provider->id,
                    'job_id' => $job->id,
                ], [
                    'answers' => ['Answer 1', 'Answer 2'],
                ]);
            }
        }
    }
}
