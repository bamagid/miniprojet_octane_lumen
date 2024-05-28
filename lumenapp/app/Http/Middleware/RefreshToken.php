<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefreshToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  dd(auth()->user());
        if (! $request->bearerToken()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $response=$next($request);
        $response->headers->set('Authorization', 'Bearer '. auth()->refresh());

        return $response;
    }
}
