<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $token = Str::random(60);

            $user = Auth::user();
            $user->update(['api_token' => hash('sha256', $token)]);

            $data = [
                'url' => route('admin.dashboard'),
                'api_token' => $token
            ];

            return response()->json($data);
        }

        $data = [
            'status' => 'error',
            'code' => 401,
            'message' => 'Введены некорректные данные',
        ];

        return response()->json($data, 401);

    }

    public function logout(Request $request)
    {
    }

    public function register(Request $request)
    {
    }
}
