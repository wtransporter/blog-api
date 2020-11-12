<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create new AuthController instance
     * 
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register given user
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function register(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);
        
        $attributes['password'] = Hash::make($request->input('password'));
        
        $user = new User;

        try {

            $user->create($attributes);

        } catch (\Exception $e) {
            
            return response()->json([
                    'message' => 'Registration failed. Please tray again later.'
                ], 409);
        }
        return response()->json([
                'message' => 'Successfully registered.'
        ], 201);
    }

    /**
     * Login user
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function login(Request $request)
    {
        $attributes = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! $token = Auth::attempt($attributes)) {
            
            return response()->json([
                    'message' => 'Unauthorized. Check credentials or register.'
            ], 401);

        }

        return $this->respondWithToken($token);
    }

    /**
     * Return generated token to a usere
     * 
     * @param $token
     * 
     * @return Response
     */
    public function respondWithToken($token)
    {
        return response()->json([
                'auth_token' => $token,
                'type' => 'Bearer',
                'expire' => Auth::factory()->getTTl()
            ]);
    }

}