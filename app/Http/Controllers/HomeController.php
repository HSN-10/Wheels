<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\BodyType;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

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

        $data = [
            'date' => [],
            'number' => []
        ];
        $from_date = Carbon::now()->subDay(14);
        $to_date = Carbon::now();
        $period = CarbonPeriod::create($from_date, $to_date);

        foreach ($period as $date) {
            array_push($data['date'], $date->format('Y-m-d'));
            $numbers = Post::where('created_at', '>=', $from_date)
                ->groupBy('date')
                ->get(array(
                    DB::raw('Date(created_at) as date'),
                    DB::raw('COUNT(*) as "number"')
                ));
            $num = 0;
            foreach ($numbers as $number) {
                if ($date->format('Y-m-d') == $number['date']) {
                    $num = $number['number'];
                    break;
                } else
                    $num = 0;
            }
            array_push($data['number'], $num);
        }
        $reports = Report::select('post_id', DB::raw('count(*) as total'))
        ->groupBy('post_id')
        ->get();
        return view('dashboard.home', compact(['postCount', 'bodyTypeCount', 'userCount', 'reportCount', 'data', 'reports']));
    }
}
