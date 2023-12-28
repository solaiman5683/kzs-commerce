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
        // Create a new user
        $userInfo = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        if (!$userInfo) {
            // Handle user creation failure
            return $this->errorResponse('User registration failed.', 400);
        }

        // Attempt to log in the user and generate a token
        try {
            $token = auth('jwt')->attempt(request()->only('email', 'password'));

            if (!$token) {
                return $this->errorResponse('Invalid credentials', 401);
            }
        } catch (JWTException $e) {
            return $this->errorResponse('Could not create token', 500);
        }

        // Retrieve user information
        $user = auth('jwt')->user();
        $userData = User::select('id', 'name', 'email')->find($user->id);

        if (!$userData) {
            return $this->errorResponse('User data not found', 500);
        }

        // Set token to never expire
        $cookie = cookie('jwt', $token, null);

        // Return a success response
        return response()->json([
            'status' => 'ok',
            'success' => true,
            'message' => 'User created and logged in successfully.',
            'token' => $token,
            'user' => $userData,
        ])->withCookie($cookie);
    }

    private function errorResponse($message, $statusCode)
    {
        return response()->json([
            'status' => 'error',
            'code' => $statusCode,
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
    //User Login
    public function userLogin()
    {
        $credentials = request()->only('email', 'password');

        try {
            if (!$token = auth('jwt')->attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $user = auth('jwt')->user();

        if ($user) {
            $userData = User::select('id', 'name', 'email')->find($user->id);

            if ($userData) {
                $cookie = cookie('jwt', $token, null); // Set token to never expire
                return response()->json([
                    'status' => 'ok',
                    'token' => $token,
                    'user' => $userData,
                ])->withCookie($cookie);
            }
        }

        return response()->json(['error' => 'Invalid email or password. Please try again.'], 401);
    }
}
