<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SaleChart;
use App\Charts\UserChart;
use App\Models\Sale;
use App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['verified','user_role']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
          $today_users = User::whereDate('created_at', today())->count();
          $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
          $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

          $chart = new UserChart;
          $chart->labels(['2 days ago', 'Yesterday', 'Today']);
          $chart->dataset('User', 'pie', [$users_2_days_ago, $yesterday_users, $today_users])->options([
              'color' =>['red','green','blue'],
          ]);
        
        return view('backend.dashboard',['chart'=>$chart]);
    }
}
