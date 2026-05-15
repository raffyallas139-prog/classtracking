<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsFaculty {
    public function handle(Request $request, Closure $next): Response {
        // Enforce role-based access checks
        if ($request->user() && $request->user()->role === 'faculty' && $request->user()->is_verified) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Access Denied. Account is unauthorized or pending verification.'
        ], 403);
    }
}