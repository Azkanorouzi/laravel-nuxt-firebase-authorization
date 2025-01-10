<?php

namespace App\repositories;

use Kreait\Firebase\Auth;
use Exception;

class FirebaseAuthRepository
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Create a new user with email and password.
     */
    public function createUserWithEmailAndPassword(string $email, string $password): array
    {
        try {
            $user = $this->auth->createUserWithEmailAndPassword($email, $password);
            return [
                'uid' => $user->uid,
                'email' => $user->email,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function signInWithEmailAndPassword(string $email, string $password): array
    {
        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);

            return [
                'user' => $signInResult->data(),
                'idToken' => $signInResult->idToken(),
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
