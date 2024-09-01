<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // Try to authenticate the user using the token
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            // Token is invalid or not provided, return a 401 Unauthorized response
            return response()->json(['error' => 'Token is invalid'], 401);
        }

        // Proceed with the request
        return $next($request);
    }
}
