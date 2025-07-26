<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoloRequesterController extends Controller
{
    public function handle(Request $request)
    {
        return response()->json(['message' => 'Welcome solo seeker']);
    }
}
