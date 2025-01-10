<?php

use App\Http\Middleware\VerifyFirebaseToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;

// Sign up a new user
Route::post('/sign-up', [FirebaseController::class, 'signUp']);

// Sign in a user
Route::post('/sign-in', [FirebaseController::class, 'signIn']);

Route::get('/', [FirebaseController::class, 'index'])->middleware(VerifyFirebaseToken::class);

Route::fallback(function () {
    return response()->json(['message' => 'Page Not Found'], 404);
});
