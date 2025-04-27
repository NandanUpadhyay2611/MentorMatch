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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== $role) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 403);
            }

            // Redirect based on user's actual role
            if ($request->user()->role === 'mentor') {
                return redirect()->route('mentor.dashboard')
                    ->with('error', 'Access denied. Redirected to mentor dashboard.');
            } else {
                return redirect()->route('startup.dashboard')
                    ->with('error', 'Access denied. Redirected to startup dashboard.');
            }
        }

        return $next($request);
    }
} 