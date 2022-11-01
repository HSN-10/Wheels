<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
                'years' => 'integer',
                'body_type_id' => 'integer',
                'kilometrage' => 'integer',
                'doors' => 'integer',
                'engine_cylinders' => 'integer',
                'number_of_owners' => 'integer',
                'number_of_accidents' => 'integer',
            ]);

            if($validate->fails())
                return response()->json([
                    'status' => 400,
                    'title' => 'One or more validation errors occurred',
                    'errors' => $validate->errors()
                ], 400);

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
}
