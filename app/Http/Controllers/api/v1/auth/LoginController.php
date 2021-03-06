<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Invalid login credentials.'
            ], 401)
                ->header('Content-Type', 'text/plain');
        }

        $user = Auth::user();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'message' => 'User logged in successfully.',
            'user' => $user,
            'access_token' => $accessToken
        ], 201);
    }

    public function hello() {
        return response([
            'message' => 'Works'
        ]);
    }
}
