<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BodyType;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get All Body Type
     * @return BodyType
     */
    public function getBodyType()
    {
        return BodyType::all();
    }

    /**
     * Last Posts
     * @return Post
     */
    public function lastPosts()
    {
        return Post::orderBy('created_at', 'desc')->limit(10)->get();
    }
    /**
     * @param $id
     * @return Post
     */
    public function post($id)
    {
        return Post::where('id', '=', $id)->first();
    }
}
