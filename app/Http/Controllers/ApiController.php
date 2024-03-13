<?php

namespace App\Http\Controllers;
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
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class ApiController extends Controller
{
	//listing featured projects
	//Api Error Codes [EZ001 => 'Invalid Request', EZ002 => Validation Error, EZ003 => Parameter Required]
	public function __construct()
	{
		$this->categoryArray = [
			['id' => 1,'name'=>'Residential'],
			['id' => 2,'name'=> 'Commercial']
		]; 
		$this->statusArray = [
			['id'=>1, 'name'=>'Ongoing'],
			['id'=>2,'name' => 'Completed'],
			['id'=>3, 'name'=> 'On Hold']
		];
	}

	public function getFeaturedProjects()
	{
		$projects = Project::whereFeatured(true)->whereActive(true)->with('Type')->orderBy('priority','asc')->get();

		if($projects){
			foreach ($projects as $key => $value) {
				$value->image = asset(Storage::url($value->image));
				$value->featuredImage = asset(Storage::url($value->featuredImage));
				$location = Location::find($value->location);
				$value->location = $location->location;
			}
			return ['status' => 'true','data' => $projects,'message'=>''];
		}
		return ['status' => 'false','error',
			['code' => 'EZ001','name'=>'Not Available','message' => 'Invalid Request'

		]];
		
	}
    //listing all projects

    public function getProjects(Request $request)
	{
		if($request->has('type'))
		{
			$projects = Project::whereActive(true)->whereType($request->type)->with('Type')->select('id','title','location','type','image','status','type','category_id')->with('location')->orderBy('priority','asc')->get();
		}
		elseif($request->has('status'))
		{
			$projects = Project::whereActive(true)->whereStatus($request->status)->with('Type')->select('id','title','location','type','image','status','type','category_id')->with('location')->orderBy('priority','asc')->get();
		}
		elseif($request->has('location'))
		{
			$projects = Project::whereActive(true)->whereLocation($request->location)->with('Type')->select('id','title','location','type','image','status','type','category_id')->with('location')->orderBy('priority','asc')->get();
		}
		elseif($request->has('category'))
		{
			$projects = Project::whereActive(true)->whereCategoryId($request->category)->with('Type')->select('id','title','location','type','image','status','type','category_id')->with('location')->orderBy('priority','asc')->get();
		}else{
			$projects = Project::whereActive(true)->with('type')->with('location')->select('id','title','location','type','image','status','type','category_id','featuredImage')->orderBy('priority','asc')->get();
		}
		

		if($projects){
			foreach ($projects as $key => $value) {
				$value->image = asset(Storage::url($value->image));
				$value->featuredImage = asset(Storage::url($value->featuredImage));
				if($value->category_id){
					$value->categoryValue = $this->getCatName($value);
				}
				

			}
			return ['status' => 'true','data' => $projects,'message'=>'Success'];
		}
		return ['status' => 'false','error',
			['code' => 'EZ001','name'=>'Not Available','message' => 'Invalid Request'
		]];
		//return Project::whereActive(true)->get();
	}

	function getCatName($project)
	{
		foreach ($this->categoryArray as $key => $value) {
			if($project->category_id==$value['id'])
			{
				$categoryValue = $value['name'];	
			}
		}
		return $categoryValue;
	}

	public function ShowProject($id)
	{
		if($id){
			$project = Project::whereId($id)->with('Type')->with('Spec')->with('Gallery')->with('Floorplan')->with('keyInformation')->orWhere('slug',$id)->with('Type')->with('Spec')->with('Gallery')->with('Floorplan')->with('keyInformation')->first();

			if($project){
				if($project->image)
				{
					$project->image = asset(Storage::url($project->image));
				}
				if($project->brochure)
				{
					$project->brochure = asset(Storage::url($project->brochure));
				}
				
				if($project->logo)
				{
					$project->logo = asset(Storage::url($project->logo));
				}
				
				$location = Location::find($project->location);
				$project->location=$location->location;
				if($project->amenities!='null')
				{
					$project->amenities = ProjectAmenities::whereIn('id',json_decode($project->amenities))->orderBy('priority','asc')->get();
				}
				
				return ['status' => 'true','data' => $project,'message'=>''];
			}
			return ['status' => 'false','error',
				['code' => 'EZ001','name'=>'Not Available','message' => 'Invalid Request'
			]];
		}
		return ['status' => 'false','error',
				['code' => 'EZ003','name'=>'Parame','message' => 'Parameter Required'
			]];
		
	}

	public function getTestimonials()
	{
	 	$test = Testimonial::whereActive(true)->orderBy('priority','asc')->get();
	 	if($test){
			return ['status' => 'true','data' => $test,'message'=>'Success'];
		}
		return ['status' => 'false','error',
				['code' => 'EZ001','name'=>'Invalid','message' => 'Invalid Request'
			]];
	}

	public function getNewsAndEvents()
	{
		$data = NewsAndEvent::whereActive(true)->with('Newsimage')->get();
		if($data){
			return ['status' => 'true','data' => $data,'message'=>'Success'];
		}else{
			return ['status' => 'false','error',
				['code' => 'EZ001','name'=>'Invalid','message' => 'Invalid Request'
			]];
		}
		
	}

	public function getSingleNewsEvent($id)
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

			return $res;
		}else{
			return ['status' => 'false','error',
				['code' => 'EZ001','name'=>'Invalid','message' => 'Invalid Request'
			]];
		}
		
	}

	public function postRequestCallBack(Request $request)
	{
		// dd($request->all());

		
		// $user=session::get('data');
		// dd($user);
		$rules =[
			'name' => 'required',
			'phone' => 'required_if:email,null',
			'email' => 'required_if:phone,null',
			'subject' => 'required'
		];

		$validator = \Validator::make($request->toArray(), $rules);
        if($validator->fails()) {
          return response()->json(['errors'=>$validator->errors()]);
        }

		$inputs = $request->only(['name','phone','email','subject','message','is_callback']);
		$data = CallBackRequest::create($inputs);
		if($data)
		{
			//send sms

			
				$this->sendMail($inputs);
			if($this->sendSms($inputs)){
				return redirect($request->url);
			
			}else{
				return ['status' => 'false','error',
					['code' => 'EZ001','name'=>'Invalid','message' => 'Invalid Request'
				]];
			}
			
		}
	}

	public function getVideos()
	{
		$videos = Video::whereActive(true)->get();
		if($videos){
			return ['status' => 'true','data' => $videos,'message'=>'Success'];
		}else{
			return ['status' => 'false','error',
				['code' => 'EZ001','name'=>'Invalid','message' => 'Invalid Request'
			]];
		}
		
	}
	public function getPhotos()
	{
		$photos = PhotoAlbum::whereActive(true)->whereParentId(0)->get();
		if($photos){
			return ['status' => 'true','data' => $photos,'message'=>'Success'];
		}else{
			return ['status' => 'false','error',
				['code' => 'EZ001','name'=>'Invalid','message' => 'Invalid Request'
			]];
		}
		

	}
	public function getSinglePhoto($id)
	{
		if($id){
			$photo =PhotoAlbum::whereActive(true)->whereParentId($id)->get();
		}else{
			return ['status' => 'false','error',
				['code' => 'EZ003','name'=>'Parameter Required','message' => 'Parameter must be required'
			]];
		}
		if($photo){
			return ['status' => 'true','data' => $photo,'message'=>'Success'];
		}else{
			return ['status' => 'false','error',
				['code' => 'EZ001','name'=>'Not Available','message' => 'Invalid Request'
			]];
		}
		
	}

	public function SaveTestimonial(Request $request)
	{
		$rules = [
            'name' => 'required',
            // 'image' => 'image|mimes:jpeg,jpg,png',
            'description' => 'required|min:10'
        ];
        $validator = \Validator::make($request->toArray(), $rules);
        if($validator->fails()) {
          return response()->json(['errors'=>$validator->errors()]);
        }

        $inputs = $request->only(['name','designation','description']);
        if($request->has('image'))
        {
        	$file = $request->image;
            $resize = Image::make($file)->fit(130)->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "public/testimonial/{$hash}.jpg";
            Storage::put($path, $resize->__toString());

            //Storage::putFile('public/newsandevents', $img);
            //$path = $request->image->storeAs('public/newsandevents', $filename);
            $inputs['image'] = $path;
		}
		
        $data = Testimonial::create($inputs);
        if($data)
        {
			return ['status' => 'true','data' => $data,'message'=>'Testimonial saved successfully!!'];
		}else{
				return ['status' => 'false','error',
				['code' => 'EZ001','name'=>'Not Available','message' => 'Oops Something went wrong!!'
			]];
		}
	
     }

	private function sendSms($inputs)
     {
     	
     	$Apikey = env('SMS_API_KEY');
     	$senderId= env('SMS_SENDER_ID');
     	$phoneNos = env('SMS_SALES_TEAM');

     	$message='Name :'.$inputs['name'].' Email :'.$inputs['email'].' Phone :'.$inputs['phone'].' Subject :'.$inputs['subject'].' Description :'.$inputs['message'];
		$message = urlencode($message);
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,'https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY='.$Apikey.'&MobileNo='.$phoneNos.'&SenderID='.$senderId.'&Message='.$message.'&ServiceName=TEMPLATE_BASED');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		
		$output =curl_exec($ch);
		Log::info($output);

		curl_close($ch);
		return 'true';
		

     }

    // public function sendMail(Request $request)
    // {
    
    //     $mail = new \stdClass();
    //     $mail->subject = $subject = $request->input('subject');
    //     $mail->name = $request->input('name');
    //     $mail->phone  = $request->input('phone');
    //     $mail->content=  $request->input('message');
    //     $mail->email = $request->email;
    //     $mail = Mail::send('mails.custom', ['mail'=>$mail], function($message) use ($subject)
    //     {    
    //         $message->from('projects@citadeldevelopers.com', 'CITADEL DEVELOPERS');
    //         $message->to('faisalpthalakkadathur@gmail.com')->subject($subject);
    //     });
    //     if($mail){
    //     	return 'true';
    //     }
    //     return 'false';
    // }



     function getFilterMasters()
     {
     	// $category = ['1' => 'Residential','2' => 'Commercial'];
     	// $status = ['1' => 'Ongoing','2' => 'Completed','3' => 'On Hold'];
     	$data = [];
     	$types = ProjectType::all()->toArray();
     	$locations = Location::all()->toArray();
     	$data['data'][]= [
     			'types' => $types,
     			'location' => $locations,
     			'status' => $this->statusArray,
     			'category' => $this->categoryArray
     	];

     	$data['status'] = 'true';
     	//return $data;

     	return \Response::json($data);//
 
     }

     public function sendMail($request)
	 {
	 	$to = 'projects@citadeldevelopers.com';
		$subject = $request['subject'];
		$from = 'admin@citadeldevelopers.com';
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: Website Enquiry'.'<'.$from.'>'."\r\n".
		    'Reply-To: '.$from."\r\n" .
		    'X-Mailer: PHP/' . phpversion();

		  
		 
		//Compose a simple HTML email message

		$message = '<html><body>';
		$message .= '<h3>From : '.$request['name'].'!</h1>';
		$message .= '<h4>Email : '.$request['email'].'!</h3>';
		$message .= '<h4>Phone : '.$request['phone'].'!</h3>';
		$message .= '<p style="font-size:14px;">'.$request['message'].'</p>';
		$message .= '</body></html>';

		// Sending email

		if(mail($to, $subject, $message, $headers)){
		    return 'true';
		} else{
		    return 'false';
		}
	 }


}
