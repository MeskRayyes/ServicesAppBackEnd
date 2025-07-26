<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoloProviderController extends Controller
{
    public function handle(Request $request)
    {
        return response()->json(['message' => 'Welcome solo provider']);
    }
}
