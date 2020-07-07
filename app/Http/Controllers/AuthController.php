<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // login
    public function login(Request $request) {

        try {
            if(Auth::attempt($request->only('email','password'))){
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                return response([
                    'message'=> 'Successfully Login',
                    'token'=> $token,
                    'user'=> $user
                ],400);
            }
        }
        catch (Exception $exception) {
            return response([
                'message'=> $exception->getMessage()
            ],400);
        }

        return response([
            'message'=> 'Invalid Email or Password'
        ],401);
    }
}
