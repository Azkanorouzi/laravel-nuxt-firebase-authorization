<?php

namespace App\services;

use App\repositories\FirebaseAuthRepository;
use Illuminate\Http\Request;
use Exception;

class AuthService
{
    protected $firebaseAuthRepository;

    public function __construct(FirebaseAuthRepository $firebaseAuthRepository)
    {
        $this->firebaseAuthRepository = $firebaseAuthRepository;
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
            $user = $this->firebaseAuthRepository->createUserWithEmailAndPassword($email, $password);

            return [
                'message' => 'User signed up successfully',
                'user' => [
                    'uid' => $user['uid'],
                    'email' => $user['email'],
                ],
            ];
        } catch (Exception $e) {
            return [
                'error' => 'Failed to sign up',
                'message' => $e->getMessage(),
            ];
        }
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $signInResult = $this->firebaseAuthRepository->signInWithEmailAndPassword($email, $password);

            return [
                'message' => 'User signed in successfully',
                'user' => [
                    'uid' => $signInResult['user']['localId'], // Firebase user UID
                    'email' => $signInResult['user']['email'], // User email
                    'token' => $signInResult['idToken'], // ID token for authenticated requests
                ],
            ];
        } catch (Exception $e) {
            return [
                'error' => 'Failed to sign in',
                'message' => $e->getMessage(),
            ];
        }
    }
}
