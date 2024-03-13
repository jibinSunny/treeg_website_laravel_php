<?php

namespace App\Http\Controllers;

use App\Project;
use App\Testimonial;
use App\CallBackRequest;
use Illuminate\Http\Request;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $data['projects']=count(Project::whereActive(true)->get());
        $data['projects_percent'] = 95;
        $data['callback_requests'] = count(CallBackRequest::whereIsCallback(true)->get());
        $data['new_callbacks'] = 50;
        $data['enquiries'] = count(CallBackRequest::whereIsCallback(false)->get());
        $data['new_enquiries']= 50;
        $data['testimonials'] = count(Testimonial::whereActive(true)->get());
        $data['testimonial_today'] = count(Testimonial::whereActive(true)->whereDate('created_at','=',date('Y-m-d'))->get());
        return view('admin.dashboard',compact('data'));
    }
}
