<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Update Profile
     * @param Request $request
     * @return User
     */
    public function updateProfile(Request $request)
    {
        try{
            $user = Auth::user();
            $validate = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'. $user->id,
                'phone' => 'required|integer|digits:8|unique:users,phone,'. $user->id
            ]);

            if($validate->fails())
                return response()->json([
                    'status' => 400,
                    'title' => 'One or more validation errors occurred',
                    'errors' => $validate->errors()
                ], 400);


            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            return response()->json($user, 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

}
