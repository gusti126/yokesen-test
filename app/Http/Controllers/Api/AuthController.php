<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'register berhasil silahkan login',
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $credential = $request->only('email', 'password');
        $token = JWTAuth::attempt($credential);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password anda salah'
            ], 401);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'login berhasil',
            'data' => Auth::user(),
            'token' => $token
        ], 200);
    }
}
