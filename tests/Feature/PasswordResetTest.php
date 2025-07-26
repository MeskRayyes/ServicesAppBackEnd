<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_reset_password()
    {
        $user = User::factory()->create(['email' => 'resetme@example.com']);

        // Simulate sending a password reset request
        $this->postJson('/api/forgot-password', [
            'email' => $user->email,
        ])->assertStatus(200);

    
        $token = Password::createToken($user);


        $this->postJson('/api/reset-password', [
            'email' => $user->email,
            'token' => $token,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ])->assertStatus(200)
          ->assertJson(['message' => 'Password has been reset.']);


        $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
    }
}
