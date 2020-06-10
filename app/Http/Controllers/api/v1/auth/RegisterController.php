<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!$user = User::create($data)) {
            return response([
                'message' => 'Error occured while registering new user.'
            ], 400)
                ->header('Content-Type', 'text/plain');
        }

        return response([
            'message' => 'User created successfully.',
            'user' => $user
        ], 201);
    }
}
