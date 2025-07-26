<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;



class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_solo_provider_can_register()
    {
        $response = $this->postJson('/api/register', [
            'email' => 'solo.provider@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_role' => 'provider',
            'account_type' => 'solo',
            'full_name' => 'Test Provider',
            'age' => 25,
            'gender' => 'male',
            'phone' => '01012345678',
            'city' => 'Cairo',
            'zip_code' => '12345',
            'job_title' => 'Developer',
            'years_experience' => 2,
            'education_level' => 'Bachelor',
            'preferred_work_nature' => 'full-time',
            'skills' => 'Laravel'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Verification code sent.']);
    }

    public function test_solo_requester_can_register()
    {
        $response = $this->postJson('/api/register', [
            'email' => 'solo.requester@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_role' => 'seeker',
            'account_type' => 'solo',
            'full_name' => 'Requester User',
            'age' => 30,
            'gender' => 'female',
            'phone' => '01087654321',
            'city' => 'Alexandria',
            'zip_code' => '54321',
            'education_level' => 'Masters',
            'preferred_work_nature' => 'part-time',
            'skills' => 'UI/UX'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Verification code sent.']);
    }

    public function test_company_provider_can_register()
    {
        $response = $this->postJson('/api/register', [
            'email' => 'company.provider@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'user_role' => 'provider',
        'account_type' => 'company',
        'company_name' => 'Provider Corp',
        'industry' => 'IT',
        'established_year' => 2010,
        'tax_license' => 'TX123456',
        'company_size' => '11-50',
        'description' => 'Tech solutions company',
        'phone' => '01234567890',
        'city' => 'Giza',
        'postal_code' => '11111',
        'address' => '15 Nile Street'

        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Verification code sent.']);
    }

    public function test_company_requester_can_register()
    {
        $response = $this->postJson('/api/register', [
            'email' => 'company.provider@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'user_role' => 'provider',
        'account_type' => 'company',
        'company_name' => 'Provider Corp',
        'industry' => 'IT',
        'established_year' => 2010,
        'tax_license' => 'TX123456',
        'company_size' => '11-50',
        'description' => 'Tech solutions company',
        'phone' => '01234567890',
        'city' => 'Giza',
        'postal_code' => '11111',
        'address' => '15 Nile Street'
    ]);


        $response->assertStatus(200)
                 ->assertJson(['message' => 'Verification code sent.']);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'login@example.com',
            'password' => bcrypt('password'),
            'email_verified' => true,
            'user_role' => 'provider',
            'account_type' => 'solo',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'login@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token', 'user']);
    }
}
