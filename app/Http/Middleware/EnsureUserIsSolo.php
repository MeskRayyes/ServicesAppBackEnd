<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsSolo
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->account_type !== 'solo') {
            return response()->json(['error' => 'Unauthorized - Solo access only'], 403);
        }

        return $next($request);
    }
}

