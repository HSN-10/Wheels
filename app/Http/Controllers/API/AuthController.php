<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register User
     * @param Request $request
     * @return User
     */
    public function register(Request $request)
    {
        try{
            $validate = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'phone' => 'required|integer|digits:8|unique:users,phone'
            ]);

            if($validate->fails())
                return response()->json([
                    'validate_errors' => $validate->errors()
                ], 400);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone
            ]);

            return response()->json([
                'user' => $user,
                'token' => $user->createToken('API_Token')->plainTextToken
            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login User
     * @param Request $request
     * @return User
     */
    public function login(Request $request)
    {
        try{
            $validate = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if($validate->fails())
                return response()->json([
                    'validate_errors' => $validate->errors()
                ], 400);

            if(!Auth::attempt($request->only(['email', 'password'])))
                return response()->json([
                    'error' => 'Email and Password not match with our system',
                ], 400);

            $user = User::where('email', $request->email)->first();


            return response()->json([
                'user' => $user,
                'token' => $user->createToken('API_Token')->plainTextToken
            ]);

        }catch(\Throwable $th){
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
