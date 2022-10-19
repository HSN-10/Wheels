<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create Post
     *  @param Request $request
     *  @return Post
     */
    public function createPost(Request $request)
    {
        try{
            $validate = Validator::make($request->all(),[
                'title' => 'required',
                'price' => 'required|integer',
                'is_ask_price' => 'required|boolean',
                'maker' => 'required',
                'model' => 'required',
                'colour' => 'required',
                'years' => 'required|integer',
                'body_type_id' => 'required|integer',
                'transmission_type' => 'required',
                'kilometrage' => 'required|integer',
                'gas_type' => 'required',
                'doors' => 'required|integer',
                'engine_cylinders' => 'required|integer',
                'condition' => 'required',
                'number_of_owners' => 'required|integer',
                'number_of_accidents' => 'required|integer',
            ]);

            if($validate->fails())
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $validate->errors()
                ], 400);

            $post = Auth::user()->posts()->create($request->all());

            return response()->json($post, 201);

        }catch(\Throwable $th){
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Create Counter Offer
     * @param Request $request, $id
     * @return CounterOffer
     */
    public function counterOffer(Request $request, $id)
    {
        try{
            $post = Post::where('id', '=', $id)->first();

            $validate = Validator::make($request->all(),[
                'post_id' => 'required|integer',
                'user_id' => 'required|integer',
                'price' => 'required|integer',
            ]);
            if($validate->fails())
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $validate->errors()
                ], 400);

            $counterOffer = $post->counter_offers()->create($request->all());

            return response()->json($counterOffer, 201);

        }catch(\Throwable $th){
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show User Counter Offers
     * @return counterOffer
     */
    public function counterOffers()
    {
        return Auth::user()->counter_offers()->get();
    }
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
                    'message' => 'Validation Error',
                    'errors' => $validate->errors()
                ], 400);

            $alert = Auth::user()->alerts()->create($request->all());

            return response()->json($alert, 201);

        }catch(\Throwable $th){
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Show Alerts
     * @return Alert
     */
    public function alerts()
    {
        return Auth::user()->alerts()->get();
    }

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
                    'message' => 'Validation Error',
                    'errors' => $validate->errors()
                ], 400);


            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            return response()->json($user, 200);

        }catch(\Throwable $th){
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Edit Post
     * @param Post $post
     * @param Request $request
     * @return Post
     */
    public function editPost(Post $post, Request $request)
    {
        try{
            $validate = Validator::make($request->all(),[
                'title' => 'required',
                'price' => 'required|integer',
                'is_ask_price' => 'required|boolean',
                'maker' => 'required',
                'model' => 'required',
                'colour' => 'required',
                'years' => 'required|integer',
                'body_type_id' => 'required|integer',
                'transmission_type' => 'required',
                'kilometrage' => 'required|integer',
                'gas_type' => 'required',
                'doors' => 'required|integer',
                'engine_cylinders' => 'required|integer',
                'condition' => 'required',
                'number_of_owners' => 'required|integer',
                'number_of_accidents' => 'required|integer',
            ]);

            if($validate->fails())
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $validate->errors()
                ], 400);

            $post->title = $request->title;
            $post->price = $request->price;
            $post->is_ask_price = $request->is_ask_price;
            $post->maker = $request->maker;
            $post->model = $request->model;
            $post->colour = $request->colour;
            $post->years = $request->years;
            $post->body_type_id = $request->body_type_id;
            $post->transmission_type = $request->transmission_type;
            $post->kilometrage = $request->kilometrage;
            $post->gas_type = $request->gas_type;
            $post->doors = $request->doors;
            $post->engine_cylinders = $request->engine_cylinders;
            $post->condition = $request->condition;
            $post->number_of_owners = $request->number_of_owners;
            $post->number_of_accidents = $request->number_of_accidents;
            $post->save();

            return $post;
        }catch(\Throwable $th){
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
