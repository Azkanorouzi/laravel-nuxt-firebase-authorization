<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseService
{
    protected $firebase;

    public function __construct()
    {
        // Use the Factory class directly to initialize Firebase
        $this->firebase = (new Factory())
            ->withServiceAccount(config('firebase.credentials')); // Path to your Firebase credentials file
    }

    public function auth()
    {
        return $this->firebase->createAuth();
    }

    public function firestore()
    {
        return $this->firebase->createFirestore();
    }
}
