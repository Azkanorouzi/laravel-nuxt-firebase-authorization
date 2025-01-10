<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Convert404ToJson
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->status() === 404 && $request->wantsJson()) {
            return response()->json([
                'error' => 'Resource not found',
                'message' => 'The requested resource could not be found.'
            ], 404);
        }

        return $response;
    }
}
