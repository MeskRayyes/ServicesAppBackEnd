<?php

namespace Tests\Feature;

use App\Models\User;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Laravel\Sanctum\Sanctum;

class JobPostingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_post_a_job()
    {
        
        $user = User::factory()->create([
            'user_role' => 'seeker',
            'account_type' => 'company',
        ]);


        Sanctum::actingAs($user);

        $response = $this->postJson('/api/jobs', [
            'title' => 'Facebook Social Media Manager',
            'category' => 'Marketing',
            'job_type' => 'Full Time',
            'work_place' => 'On Site',
            'country' => 'Egypt',
            'city' => 'Cairo',
            'experience_from' => 1,
            'experience_to' => 3,
            'salary_range' => '1500$/m',
            'deadline' => '2025-02-12',
            'skills' => ['Graphic', 'Art', 'PHP'],
            'questions' => [
                'Question One',
                'Question Two',
                'Question Three'
            ]
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Job posted successfully']);
    }
}


