<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BodyType;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    /**
     * Get All Body Type
     * @return BodyType
     */
    public function getBodyType()
    {
        $bodyType = BodyType::all();
        return response()->json($bodyType, 200);
    }

    /**
     * Last Posts
     * @return Post
     */
    public function lastPosts()
    {
        $lastPosts =  Post::orderBy('created_at', 'desc')->limit(10)->get();
        return response()->json($lastPosts, 200);
    }
    /**
     * @param $id
     * @return Post
     */
    public function post($id)
    {
        $post = Post::where('id', '=', $id)->first();
        return response()->json($post, 200);
    }
        /**
     * Report Post
     * @param Request $request, $id
     * @return response
     */
    public function report(Request $request, $id)
    {
        try{
            $validate = Validator::make($request->all(),[
                'post_id'=> 'required'
            ]);

            if($validate->fails())
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $validate->errors()
                ], 400);

            $report = Report::create($request->all());
            return response()->json($report, 201);
        }catch(\Throwable $th){
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
