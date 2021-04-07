<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->isAdmin()) {
            if ($request->wantsJson() || $request->ajax()){
                return response()->json(['message' => "Access denied"], 403);
            }
            return abort(403);
        }

        return $next($request);
    }
}
