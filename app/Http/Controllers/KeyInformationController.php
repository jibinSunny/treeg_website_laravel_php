<?php

namespace App\Http\Controllers;
use DB;
use App\KeyInformation;
use Illuminate\Http\Request;

class KeyInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'project_id' => 'required|numeric',
            'title' => 'required',
          
        ]);
        $Testimonial = new KeyInformation();
        // return $Testimonial;
        $Testimonial->title=$request->title;
        $Testimonial->project_id=$request->project_id;
        // $Testimonial->content=$request->content;
        $Testimonial->priority=$request->priority;
        if($request->has('image'))
        {
            $file = $request->file('image');
            $ext = $request->image->extension();
            $filename = time().'.'.$ext;
            $path = $request->image->storeAs('public/KeyInformation', $filename);
            // $inputs['image'] = 'amenities/'.$filename;
            $Testimonial->image = 'KeyInformation/'.$filename;
           
        }
        if( $Testimonial->save())
            {
                // dd($request->all());
                return redirect('/admin/projects/'.$request->project_id)->withSuccess('Key Information Created Successfully!!');
            }
            return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KeyInformation  $keyInformation
     * @return \Illuminate\Http\Response
     */
    public function show(KeyInformation $keyInformation)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KeyInformation  $keyInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(KeyInformation $keyInformation)
    {
        return view('admin.projects.keyInformation_edit',compact('keyInformation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KeyInformation  $keyInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeyInformation $keyInformation)
    {
                 
        //  dd($keyInformation->id);
        $request->validate([
            'title' => 'required',
        ]);

         if($request->has('image'))
         {
            $file = $request->file('image');
            $ext = $request->image->extension();
            $filename = time().'.'.$ext;
            $path = $request->image->storeAs('public/KeyInformation', $filename);
            // $inputs['image'] = 'amenities/'.$filename;
            // $Testimonial->image = 'KeyInformation/'.$filename;
         
         
         $data=DB::table('key_informations')
         ->where('id', '=', $keyInformation->id)
         ->update([
             'title' => $request->title,
             'image' => 'KeyInformation/'.$filename,
             'priority' => $request->priority,
             'created_at' =>  \Carbon\Carbon::now(),
             'updated_at' => \Carbon\Carbon::now(),
            
         ]);
         }
       else
        {
         $data=DB::table('key_informations')
         ->where('id', '=', $keyInformation->id)
         ->update([
             'title' => $request->title,
             'priority' => $request->priority,
             'created_at' =>  \Carbon\Carbon::now(),
             'updated_at' => \Carbon\Carbon::now(),
            
         ]);
        }
 
         if($data)
         {
            // dd($request->all());
            return redirect('/admin/projects/'.$request->project_id)->withSuccess('Key Information Created Successfully!!');
        }
        return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KeyInformation  $keyInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeyInformation $keyInformation)
    {
        if($keyInformation->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
