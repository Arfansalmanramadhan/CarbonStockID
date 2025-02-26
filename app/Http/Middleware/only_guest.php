<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class only_guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Pastikan user tidak login
        if ($user) {
            // Pastikan ID user adalah string (UUID)
            if (!is_string($user->id)) {
                abort(400, 'Invalid user ID format');
            }
            return redirect('dashboard');
        }

        return $next($request);
    }
}
