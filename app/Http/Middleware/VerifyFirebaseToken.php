<?php

namespace App\Http\Middleware;

use Closure;
use Kreait\Firebase\Auth;
use Illuminate\Http\Request;

class VerifyFirebaseToken
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        // Get the ID token from the Authorization header
        $idToken = $request->bearerToken();

        if (!$idToken) {
            return response()->json(['error' => 'Unauthorized. Token missing.'], 401);
        }

        try {
            // Verify the ID token
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);

            // Attach the user's email to the request for use in the controller
            $request->merge(['email' => $verifiedIdToken->claims()->get('email')]);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized. Invalid token.'], 401);
        }
    }
}
