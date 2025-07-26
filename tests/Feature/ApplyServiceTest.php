<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Job;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplyServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_provider_can_apply_to_job()
    {
        $provider = User::factory()->create([
            'user_role' => 'provider',
            'account_type' => 'solo',
        ]);

        $job = Job::factory()->create();

        Sanctum::actingAs($provider);

        $response = $this->postJson("/api/jobs/{$job->id}/apply", [
            'answers' => ['Yes', 'I have 2 years experience.', 'Available full-time.']
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Application submitted successfully.']);

        $this->assertDatabaseHas('apply_services', [
            'user_id' => $provider->id,
            'job_id' => $job->id,
        ]);
    }

    public function test_seeker_cannot_apply_to_job()
    {
        $seeker = User::factory()->create([
            'user_role' => 'seeker',
            'account_type' => 'company',
        ]);

        $job = Job::factory()->create();

        Sanctum::actingAs($seeker);

        $response = $this->postJson("/api/jobs/{$job->id}/apply", [
            'answers' => ['Not allowed']
        ]);

        $response->assertStatus(403);
    }
}
