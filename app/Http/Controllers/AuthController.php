<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $data = [
                'url' => route('admin.dashboard'),
            ];

            return response()->json($data);
        }

        $data = [
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
