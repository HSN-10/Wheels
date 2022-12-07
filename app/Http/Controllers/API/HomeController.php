<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Adresource;
use App\Http\Resources\BodyTypeCollection;
use App\Http\Resources\PostCollection;
use App\Models\BodyType;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Get All Body Type
     * @return BodyType
     */
    public function getBodyType()
    {
        try{
            $bodyType = BodyTypeCollection::collection(BodyType::all());
            //return new BodyTypeCollection(BodyType::all());
            return response()->json($bodyType, 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
        /**
     * Report Post
     * @param Request $request

     * @return response
     */
    public function report(Request $request)
    {
        try{
            $validate = Validator::make($request->all(),[
                'post_id'=> 'required'
            ]);

            if($validate->fails())
                return response()->json([
                    'status' => 400,
                    'title' => 'One or more validation errors occurred',
                    'errors' => $validate->errors()
                ], 400);

            $report = Report::create($request->only(['post_id', 'comment']));
            return response()->json($report, 201);
        }catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'title' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function search($title)
    {
        $search = PostCollection::collection(Post::Where('title', 'like', "%$title%")->get());
        return response()->json($search, 200);
    }
    public function searchBodyType($bodytype)
    {
        $filter = PostCollection::collection(Post::Where('body_type_id', $bodytype)->get());
        return response()->json($filter, 200);
    }
}
