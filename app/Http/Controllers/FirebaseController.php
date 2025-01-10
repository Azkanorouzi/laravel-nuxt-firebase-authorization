<?php

namespace App\Http\Controllers;

use App\services\AuthService;
use Illuminate\Http\Request;
use App\Services\FirebaseService;

class FirebaseController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Protected route: Confirm the user is logged in.
     */
    public function index(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email', // Ensure email is unique
        ]);
        // Get the email from the request (attached by the middleware)
        $email = $request->input('email');

        return response()->json([
            'message' => "Hi, you're logged in with $email email.",
        ]);
    }

    /**
     * Sign up a new user with email and password.
     */
    public function signUp(Request $request)
    {
        $response = $this->authService->signUp($request);

        if (isset($response['error'])) {
            return response()->json($response, 400);
        }

        return response()->json($response);
    }

    /**
     * Sign in a user with email and password.
     */
    public function signIn(Request $request)
    {
        $response = $this->authService->signIn($request);

        if (isset($response['error'])) {
            return response()->json($response, 400);
        }

        return response()->json($response);
    }
}
