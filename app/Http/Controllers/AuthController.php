<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Solo;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationCode;
use Illuminate\Contracts\Mail\Mailable;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'user_role' => 'required|in:provider,seeker',
            'account_type' => 'required|in:solo,company',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_role' => $request->user_role,
            'account_type' => $request->account_type,
            'verification_code' => rand(100000, 999999),
        ]);

        if ($request->account_type === 'solo') {
            Solo::create([
                'user_id' => $user->id,
                'full_name' => $request->full_name,
                'age' => $request->age,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'job_title' => $request->job_title,
                'years_experience' => $request->years_experience,
                'education_level' => $request->education_level,
                'preferred_work_nature' => $request->preferred_work_nature,
                'skills' => json_encode($request->skills),
            ]);
        } else {
            Company::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,
                'industry' => $request->industry,
                'established' => $request->established,
                'tax_license' => $request->tax_license,
                'company_size' => $request->company_size,
                'description' => $request->description,
                'email' => $request->contact_email,
                'phone' => $request->phone,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
            ]);
        }

        Mail::to($user->email)->send(new EmailVerificationCode($user->verification_code));

        return response()->json(['message' => 'Verification code sent.']);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->verification_code != $request->code) {
            return response()->json(['error' => 'Invalid code'], 422);
        }

        $user->email_verified = true;
        $user->verification_code = null;
        $user->save();

        return response()->json(['message' => 'Email verified']);
    }



public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    if (!$user->email_verified) {
        return response()->json(['error' => 'Email not verified'], 403);
    }

    $token = $user->createToken('authToken')->plainTextToken;
     $profile = null;
        if ($user->account_type === 'solo') {
            $profile = $user->solo;
        } elseif ($user->account_type === 'company') {
            $profile = $user->company;
        }

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'user_role' => $user->user_role,
                'account_type' => $user->account_type,
            ],
            'profile' => $profile
        ]);
}


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}



