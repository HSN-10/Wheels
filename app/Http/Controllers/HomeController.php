<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\BodyType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postCount = Post::all()->count();
        $bodyTypeCount = BodyType::all()->count();
        $userCount = User::all()->count();
        $reportCount = Report::all()->count();
        return view('dashboard.home', compact(['postCount', 'bodyTypeCount', 'userCount', 'reportCount']));
    }
}
