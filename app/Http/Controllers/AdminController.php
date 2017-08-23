<?php

namespace App\Http\Controllers;

use App\Cv;
use App\Demend_de_emp;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;



class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        $Registered_today_count = User::where('created_at' ,'like' ,$current_date.'%')->count();
        $aamel_today_count = Cv::where('created_at' ,'like' ,$current_date.'%')->count();
        $wadifa_today_count = Demend_de_emp::where('created_at' ,'like' ,$current_date.'%')->count();
        $Registered_count = User::all()->count();
        $aamel_count = Cv::all()->count();
        $wadifa_count = Demend_de_emp::all()->count();
        $arr = Array(
            'user' => Auth::user(),
            'Registered_today_count'=> $Registered_today_count,
            'aamel_today_count' => $aamel_today_count,
            'wadifa_today_count' => $wadifa_today_count,
            'Registered_count' => $Registered_count,
            'aamel_count' => $aamel_count,
            'wadifa_count' => $wadifa_count,
        );
        return view('admin.home',$arr);
    }
    public function show_registered_today(){
        $current_date = Carbon::now()->format('Y-m-d');
        $registered_today =  User::where('created_at' ,'like' ,$current_date.'%')->paginate(10);
        $arr = Array('user'=>Auth::user(),'registered_today'=> $registered_today);
        return view('admin.admin pages.registered_today_list',$arr);
    }

}
