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
class Front_Photo_Gallary_controller extends Controller
{
    public function index()
	{
		$photos = PhotoAlbum::whereActive(true)->whereParentId(0)->orderBy('priority', 'asc')->get();
		if($photos){
		
			
			return view('front_end.photo-gallery',compact('photos'));

			
		}else{
			return view('front_end.photo-gallery');
		}
		

	}
	public function view($id)
	{
		if($id){
			$photo =PhotoAlbum::whereActive(true)->whereParentId($id)->get();
		}else{
			return view('front_end.photo-gallery');
		}
		if($photo){
			return view('front_end.photo-gallery-detail',compact('photo'));
		}else{
			return view('front_end.photo-gallery');
		}
		
	}
	public function videoindex()
	{
		$videos = Video::whereActive(true)->get();
		// return $videos;
		if($videos){
			return view('front_end.video-gallery',compact('videos'));
		}else{
			return view('front_end.video-gallery');
		}
	}

}
