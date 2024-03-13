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

class Front_Testimonial_controller extends Controller
{
    public function index()
    {
        $test = Testimonial::whereActive(true)->orderBy('created_at', 'dsc')->get();
        return view('front_end.testimonials',compact('test'));
  
    }
    public function save_testimonoal(Request $request)
    {
        // return "vfd";
        

        $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'description' => 'required'
        ]);
        $Testimonial = new Testimonial();
        $Testimonial->name=$request->name;
        $Testimonial->designation=$request->designation;
        $Testimonial->description=$request->description;
        // $Testimonial->priority=$request->priority;
        $Testimonial->active="0";
        // $inputs = $request->only(['name','designation','description','priority']);
        // $inputs['active'] =0;
        if($request->has('image'))
        {
            $file = $request->file('image');
            $ext = $request->image->extension();
            $filename = time().'.'.$ext;
            $path = $request->image->storeAs('public/testimonial', $filename);
            // $inputs['image'] = 'testimonial/'.$filename;
            $Testimonial->image = 'testimonial/'.$filename;
        }
        // $Album = new Testimonial();
        // $Testimonial->save();
        // dd("hai");
        
        if( $Testimonial->save())
        {
            // return "hai";
            return redirect('/testimonials')->withSuccess('Thank You For Your Valuable Feedback');
        }
        return redirect('/testimonials')->withError('Oops Something went wrong!!');
    }
}
