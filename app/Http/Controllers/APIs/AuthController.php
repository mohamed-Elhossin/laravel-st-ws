<?php

namespace App\Http\Controllers\APIs;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed"
        ]);

        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password']),
        ]);

        $token = $user->createToken("user_token")->plainTextToken;

        $reponse = [
            "status" => 200,
            "data" => $user,
            "token" => $token,
            "message" => "Create User successfully"
        ];


        return response($reponse, 200);
    }


    public function login(Request $request)
    {
        $data = $request->validate([

            "email" => "required|email",
            "password" => "required"
        ]);


        $user = User::where("email", '=', $data['email'])->first();


        if (!Hash::check($data['password'], $user->password) && !$user) {
            $reponse = [
                "status" => 400,
                "message" => "Wrong Data"
            ];
        }
        $token = $user->createToken("user_token")->plainTextToken;
        $reponse = [
            "status" => 200,
            "data" => $user,
            "token" => $token,
            "message" => "Create User successfully"
        ];

        return response($reponse, 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        $reponse = [
            "status" => 200,

            "message" => "Logout successfully"
        ];

        return response($reponse, 200);
    }
}
