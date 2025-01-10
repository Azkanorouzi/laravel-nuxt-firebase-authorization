<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class FirebaseController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    /**
     * Protected route: Confirm the user is logged in.
     */
    public function index(Request $request)
    {
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
        $request->validate([
            'email' => 'required|email|unique:users,email', // Ensure email is unique
            'password' => 'required|min:8', // Enforce strong passwords
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $user = $this->firebase->auth()->createUserWithEmailAndPassword($email, $password);
            return response()->json([
                'message' => 'User signed up successfully',
                'user' => [
                    'uid' => $user->uid,
                    'email' => $user->email,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to sign up',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Sign in a user with email and password.
     */
    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        try {
            // Sign in the user
            $signInResult = $this->firebase->auth()->signInWithEmailAndPassword($email, $password);

            // Get the user data
            $user = $signInResult->data();

            // Get the ID token
            $idToken = $signInResult->idToken();

            return response()->json([
                'message' => 'User signed in successfully',
                'user' => [
                    'uid' => $user['localId'], // Firebase user UID
                    'email' => $user['email'], // User email
                    'token' => $idToken, // ID token for authenticated requests
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to sign in',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
