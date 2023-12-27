<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserAuthController extends Controller
{
    public function userRegister()
    {
            User::create([
            'name' => request('name'),
            'email' => request('email'),
            
            'password' => bcrypt(request('password')),
            
        ]);
        
        return response()->json([
            'status' => 'ok',
            'message' => 'User CReated'
        ]);
    }
    //userLogin
    public function userLogin()
    {
        $credentials = request()->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::user();

        // if ($user) {
        //     if ($user->status === 'pending') {
        //         return response()->json(['error' => 'User is pending approval.'], 403);
        //     }

            $userData = User::select('id', 'name', 'email')->find($user->id);


            if ($userData) {

                $cookie = cookie('jwt', $token, 60 * 24);
                return response()->json([
                    'status' => 'ok',
                    'token' => $token,
                    'user' => $userData,

                ])->withCookie($cookie);
            } else {
                return response()->json(['error' => 'User not found or has missing columns.'], 404);
            }
    }
}
