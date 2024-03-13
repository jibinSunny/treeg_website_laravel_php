<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials=  Testimonial::orderBy('created_at', 'dsc')->paginate(20);
        return view('admin.testimonials.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
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
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'description' => 'required'
        ]);
        $Testimonial = new Testimonial();
        $Testimonial->name=$request->name;
        $Testimonial->designation=$request->designation;
        $Testimonial->description=$request->description;
        $Testimonial->priority=$request->priority;
        // $Testimonial->active=$request->status;
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
            return redirect('/admin/testimonial')->withSuccess('Testimonial created successfully');
        }
        return redirect('/admin/testimonial')->withError('Oops Something went wrong!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return $testimonial;
        return view('admin.testimonials.show',compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {

        if($request->has('approve'))
        {
            $testimonial->active = $request->approve;
            if($testimonial->update())
            {
                return redirect('/admin/testimonial')->withSuccess('Testimonial Updated successfully');
            }
            return redirect('/admin/testimonial')->withError('Oops Something went wrong!!');
        }
        $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
            'description' => 'required'
        ]);

        $inputs = $request->only(['name','designation','description','priority']);
        if($request->has('image'))
        {
            Storage::delete($testimonial->image);
            $file = $request->file('image');
            $ext = $request->image->extension();
            $filename = time().'.'.$ext;
            $path = $request->image->storeAs('public/testimonial', $filename);
            $inputs['image'] = 'testimonial/'.$filename;
        }
        if($testimonial->update($inputs))
        {
            return redirect('/admin/testimonial')->withSuccess('Testimonial Updated successfully');
        }
        return redirect('/admin/testimonial')->withError('Oops Something went wrong!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {

        if($testimonial->delete())
        {
            return response()->json('true',200);
        }
        return response()->json('false');
    }
}
