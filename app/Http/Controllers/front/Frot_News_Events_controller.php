<?php

namespace App\Http\Controllers\front;
use App\Project;
use App\Testimonial;
use App\NewsAndEvent;
use App\Video;
use App\PhotoAlbum;
use App\Http\Resources\ProjectCollection;
use App\CallBackRequest;
use Intervention\Image\Facades\Image;
use App\ProjectType;
use Illuminate\Support\Facades\Mail;
use App\Location;
use App\ProjectAmenities;
use Illuminate\Support\Facades\Storage;
use DB;
use Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Frot_News_Events_controller extends Controller
{
    public function index()
	{
        $data = NewsAndEvent::whereActive(true)->with('Newsimage')->orderBy('created_at', 'dsc')->get();
        // return $data;
		if($data){
			return view('front_end.news-events',compact('data'));
		}else{
            return view('front_end.news-events',compact('data'));
			
		}
		
    }
    // public function view($id)
	// {
	// 	if($id){
    //         $data1 =NewsAndEvent::whereActive(true)->whereParentId($id)->get();
    //     return $data1;
	// 	}else{
	// 		return view('front_end.news-events');
	// 	}
	// 	if($data1){
	// 		return view('front_end.news-events-detail',compact('data1'));
	// 	}else{
	// 		return view('front_end.news-events');
	// 	}
		
	// }
	public function view($id)
	{
		$data = NewsAndEvent::whereId($id)
			->whereActive(true)
			->with('Newsimage')
			->first()->toArray();

		if($data){
			$related = NewsAndEvent::whereActive(true)->where('id','!=',$id)->limit(4)->get()->toArray();
			$res['status'] = 'true';
			$res['data'] = $data;
			$res['data']['related'] = $related;
			// return $res['data']['newsimage'][0]['image'];
			return view('front_end.news-events-detail',compact('res'));
		}else{
			return view('front_end.news-events');
		}
		
	}
}
