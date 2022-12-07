<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AlertController extends Controller
{
    /**
     * Create Alert
     *  @param Request $request
     *  @return Alert
     */
    public function createAlert(Request $request)
    {
        try{
            $validate = Validator::make($request->all(),[
                'price_from' => 'required|integer',
                'price_to' => 'required|integer',
            ]);

            if($validate->fails())
                return response()->json($validate->errors(), 400);

            $alert = Auth::user()->alerts()->create($request->all());

            return response()->json($alert, 201);

        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Show Alerts
     * @return Alert
     */
    public function alerts()
    {
        try{
            return Auth::user()->alerts()->get();
        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function delete_alert(Alert $alert)
    {
        try{
            $user = Auth::user();
            if($user->id != $alert->user_id)
                return response()->json([
                    'status' => 401,
                    'title' => 'Unauthorized',
                    'errors' => 'You don\'t have access to delete this post'
                ], 401);
            $alert->delete();
            $alert->save();
            return  response()->json([
                'status' => 200,
                'title' => 'Deleted',
                'errors' => 'Alert is Deleted'
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
}
