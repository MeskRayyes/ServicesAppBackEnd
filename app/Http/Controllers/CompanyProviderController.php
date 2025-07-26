<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyProviderController extends Controller
{
    public function handle(Request $request)
    {
        return response()->json(['message' => 'Welcome company provider']);
    }
}
