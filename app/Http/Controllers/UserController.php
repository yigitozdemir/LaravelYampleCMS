<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * Authenticate the user
     * @param Request $request
     * 
     * @return [JSON] Authentication Result
     */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth('api')->attempt($credentials);
        if(!$token){
            return response()->json([
                'status' => 'error',
                'message' => 'unauthorized'
            ], 401);
        }

        $user = Auth('api')->user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ]);
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function profile(Request $request) {
        $user = Auth('api')->user();
        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function register(Request $request){
        $request->validate([
            'name' => 'string|required|max:255',
            'email' => 'string|required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User successfully created',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out user',
        ]);
    }

    public function refresh(Request $request){
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
