<?php

namespace App\Http\Controllers;
use App\CallBackRequest;
use Illuminate\Http\Request;
use DB;

class CustomerRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CallBackRequest::query()->orderBy('created_at', 'desc');
        if($request->has('global_search'))
        {
            $value = $request->global_search;
            $query->when($value, function ($q, $value) {
                return $q->where('name', 'like', $value.'%')
                ->orWhere('subject', 'like', $value.'%')
                ->orWhere('phone', 'like', $value.'%');
            });
        }

        $url = request()->segment(2);
         if($url=='customer_requests')
         {
            $urls = explode('_', $url);
            $title = ucfirst($urls[0]).' '.ucfirst($urls[1]);
            $title = str_singular($title);
            $callback_requests= $query->whereIsCallback(true)->paginate(20);
        }else{
            $callback_requests=$query->whereIsCallback(false)->paginate(20);
            $title = ucfirst(str_singular($url)); 
        }

    //    dd($callback_requests);
        return view('admin.callback.index',compact('callback_requests','url','title'));
        
    }

    public function getSms()
    {
        return view('admin.sms');
    }

    public function sendSms(Request $request)
     {

        $Apikey = env('SMS_API_KEY');
        $senderId= env('SMS_SENDER_ID');

        $message='Name :'.$request->name.' Email :'.$request->email.' Phone :'.$request->phone.' Subject :'.$request->subject.' Description :'.strip_tags($request->message);
        $message = urlencode($message);

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,'https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY='.$Apikey.'&MobileNo='.$request->phone.'&SenderID='.$senderId.'&Message='.$message.'&ServiceName=TEMPLATE_BASED');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output =curl_exec($curl);
        curl_close($curl);

        if($output){
            return 'true';
        }

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $callback_request = CallBackRequest::find($id);
        return view('admin.callback.show',compact('callback_request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
// dd($id);

        if($request->has('approve'))
        {
            $data=DB::table('call_back_requests')
            ->where('id', '=', $id)
            ->update([
               'status' => $request->status,
               
            ]);
            if($data)
                { 
                    if($request->is_callback==0)
                    {
                        return redirect('/admin/enquiries')->withSuccess('Data Updated Successfully!!');
                    }
                    return redirect('/admin/customer_requests')->withSuccess('Data Updated Successfully!!');
                }
               return redirect('/admin/customer_requests')->withError('Oops Something went wrong!!');
        }
    //     dd("fdsf");
    //     $url = $request->segment(2);
    //     $request->validate([
    //         'dealer' => 'required'
    //     ]);
    //     $table = CallBackRequest::find($id);
    //     $table->dealer = $request->dealer;
    //     if($table->update())
    //     {
    //         return redirect('/admin/'.$url)->withSuccess('Data Updated Successfully!!');
    //     }
    //    return redirect('/admin/'.$url)->withError('Oops Something went wrong!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(CallBackRequest::find($id)->delete())
        {
            return response()->json('true');
        }
         return response()->json('false');
    }
}
