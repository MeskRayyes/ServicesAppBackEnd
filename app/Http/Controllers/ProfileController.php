<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        if ($user->account_type === 'solo') {
            $profile = $user->solo;
        } else {
            $profile = $user->company;
        }

        return response()->json([
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->user_role,
                'account_type' => $user->account_type,
            ],
            'profile' => $profile
        ]);
    }
}
