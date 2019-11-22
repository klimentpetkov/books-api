<?php

namespace App\Http\Middleware;

use Closure;
use App\Constants;

class AuthenticateApi
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
        if ( $request->segment(2) === 'books' && !is_null($request->bearerToken()) && auth()->user() && auth()->user()->isUser()) {

            if (
                ($request->isMethod("GET") && $request->segment(3) === 'create') ||
                (
                    ($request->isMethod("PATCH") || $request->isMethod("DELETE")) &&
                    is_numeric($request->segment(3))
                )
            ) {
                return response()->json(['message' => Constants::ACCESS_DENIED], Constants::STATUS_OK);
            }
        }

        return $next($request);
    }
}
