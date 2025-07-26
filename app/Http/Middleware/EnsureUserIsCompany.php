<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsCompany
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->account_type !== 'company') {
            return response()->json(['error' => 'Unauthorized - Company access only'], 403);
        }

        return $next($request);
    }
}

