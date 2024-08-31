<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        $v = \validator($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($v->fails()) 
            return response()->json(['message' => $v->errors()]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'type' => 'danger',
                'title' => env('APP_NAME'),
                'message' => 'Incorrect credentials, please try again'
            ], 401);
        }
        $user = Users::where('email', $request->email)->first();
        return response()->json([
            'type' => 'success',
            'title' => env('APP_NAME'),
            'message' => 'Logged Successfully',
            'token' => $request->user()->createToken($user->name. '_authToken',  ['*'], Carbon::now()->addHour(1))->plainTextToken,
            'user' => $user
        ]);
    }

    public function logout(Request $request) : JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'type' => 'success',
            'title' => env('APP_NAME'),
            'message' => 'Logout successfully'
        ]);
    }
}
