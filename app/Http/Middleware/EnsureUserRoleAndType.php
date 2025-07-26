<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRoleAndType
{
    public function handle(Request $request, Closure $next, string $role, string $type)
    {
        $user = $request->user();

        if (!$user || $user->user_role !== $role || $user->account_type !== $type) {
            return response()->json(['error' => 'Access denied.'], 403);
        }

        return $next($request);
    }
}
