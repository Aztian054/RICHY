<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user || !$user->is_active) {
            return redirect()->route('login')->with('error', 'Akun Anda tidak aktif.');
        }

        // Super Admin can access everything
        if ($user->level == 1) {
            return $next($request);
        }

        // Check if user's level is in allowed roles
        if (!in_array((string)$user->level, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}