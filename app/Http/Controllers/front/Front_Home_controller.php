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

class Front_Home_controller extends Controller
{

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
    public function index()
    {
        // return "dvffd";
        $projects = Project::whereActive(true)->with('type')->with('location')->select('id','title','location','type','image','status','type','category_id','description')->orderBy('priority','asc')->get();
        $projects_mobile = Project::whereActive(true)->with('type')->with('location')->select('id','title','location','type','image','status','type','category_id','description')->orderBy('priority','asc')->get();
        $complete_count=count(Project::where('status','2')->get());
        $ongoing_count=count(Project::where('status','1')->get());
        $feature_count=count(Project::where('status','3')->get());
        $projects_count=count(Project::get());
        $test = Testimonial::whereActive(true)->orderBy('priority','asc')->orderBy('created_at', 'dsc')->get();
        $new = NewsAndEvent::whereActive(true)->with('Newsimage')->orderBy('created_at', 'dsc')->get();
        $photos = PhotoAlbum::whereActive(true)->whereParentId(0)->get();
    //   return $test;

        return view('front_end.index',compact('projects','complete_count','ongoing_count','feature_count','projects_count','test','new','photos','projects_mobile'));

    //   return $photos;
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

		$inputs = $request->only(['name','phone','status','email','subject','message','is_callback']);
		$data = CallBackRequest::create($inputs);
		if($data)
		{
			//send sms


				// $this->sendMail($inputs);
			if($this->sendSms($inputs)){
				// dd($request->all());
				if($request->is_callback=="1")
				{
					session()->flash('success','Thank You For Your Request.We Shall Respond You Soon');
					return redirect($request->url);

				}
				else{

				session()->flash('success','Thank You For Your Request.We Shall Respond You Soon');
				return redirect($request->url);
				}

			}else{
				session()->flash('danger','Your request call is faild to placed');
				return redirect($request->url);
			}

		}
    }
    private function sendSms($inputs)
     {

     	$Apikey = env('SMS_API_KEY');
     	$senderId= env('SMS_SENDER_ID');
     	$phoneNos = env('SMS_SALES_TEAM');

		$message='New Callback Request Received\nName: '.$inputs['name'].'\nEmail: '.$inputs['email'].'\nPhone: '.$inputs['phone'].'\nSubject: '.$inputs['subject'].'\nDescription: '.$inputs['message'];
        $message = urlencode($message);
        $message=str_replace("%5Cn","%0a",$message);
		$ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,'https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY='.$Apikey.'&MobileNo='.$phoneNos.'&SenderID='.$senderId.'&Message='.$message.'&ServiceName=TEMPLATE_BASED');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		$output =curl_exec($ch);
		Log::info($output);

		curl_close($ch);
		return 'true';


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
