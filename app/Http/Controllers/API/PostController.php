<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Last Posts
     * @return Post
     */
    public function lastPosts()
    {
        try{
            $lastPosts =  Post::orderBy('created_at', 'desc')->limit(10)->get();
            return response()->json($lastPosts, 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * @param Post $post
     * @return Post
     */
    public function post(Post $post)
    {
        try{
            return response()->json($post, 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Create Post
     *  @param Request $request
     *  @return Post
     */
    public function create(Request $request)
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
                'gas_type' => 'required|integer',
                'doors' => 'required|integer',
                'engine_cylinders' => 'required|integer',
                'condition' => 'required|integer',
                'number_of_owners' => 'required|integer',
                'number_of_accidents' => 'required|integer',
            ]);

            if($validate->fails())
                return response()->json([
                    'status' => 400,
                    'title' => 'One or more validation errors occurred',
                    'errors' => $validate->errors()
                ], 400);

            $post = Auth::user()->posts()->create($request->all());

            return response()->json($post, 201);

        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Edit Post
     * @param Post $post
     * @param Request $request
     * @return Post
     */
    public function edit(Post $post, Request $request)
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
                'gas_type' => 'required|integer',
                'doors' => 'required|integer',
                'engine_cylinders' => 'required|integer',
                'condition' => 'required|integer',
                'number_of_owners' => 'required|integer',
                'number_of_accidents' => 'required|integer',
            ]);

            if($validate->fails())
                return response()->json([
                    'status' => 400,
                    'title' => 'One or more validation errors occurred',
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
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Delete Post
     * @param Post $post
     * @return response
     */
    public function delete(Post $post)
    {
        try{
            $user = Auth::user();
            if($user->id != $post->user_id)
                return response()->json([
                    'status' => 401,
                    'title' => 'Unauthorized',
                    'errors' => 'You don\'t have access to delete this post'
                ], 401);
            $post->delete();
            $post->save();
            return response()->json($post,200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Create Counter Offer
     * @param Request $request
     * @param Post $post
     * @return CounterOffer
     */
    public function counterOffer(Request $request, Post $post)
    {
        try{
            $validate = Validator::make($request->all(),[
                'post_id' => 'required|integer',
                'user_id' => 'required|integer',
                'price' => 'required|integer',
            ]);
            if($validate->fails())
                return response()->json([
                    'status' => 400,
                    'title' => 'One or more validation errors occurred',
                    'errors' => $validate->errors()
                ], 400);

            $counterOffer = $post->counter_offers()->create($request->all());

            return response()->json($counterOffer, 201);

        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show User Counter Offers
     * @return counterOffer
     */
    public function counterOffers()
    {
        try{
            return Auth::user()->counter_offers()->get();
        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
}
