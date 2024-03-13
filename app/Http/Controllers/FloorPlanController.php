<?php

namespace App\Http\Controllers;

use App\FloorPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FloorPlanController extends Controller
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
        // dd("gfd");
        $request->validate([
            'title' => 'required'
        ]);

        $inputs = $request->only(['project_id','title','priority']);
        if($request->has('image'))
        {

            $file = $request->file('image');
            $ext = $request->image->extension();
            $filename = time().'.'.$ext;
            $path = $request->image->storeAs('public/floorplan', $filename);
            $inputs['image'] = 'floorplan/'.$filename;
        }
        if(FloorPlan::create($inputs))
        {
            return redirect('/admin/projects/'.$request->project_id)->withSuccess('Floor Plan Created Successfully!!');
        }
        return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FloorPlan  $floorPlan
     * @return \Illuminate\Http\Response
     */
    public function show(FloorPlan $floorplan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FloorPlan  $floorPlan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $floor_plan= FloorPlan::where('id',$id)->get();
        return view('admin.projects.floor_plan_edit',compact('floor_plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FloorPlan  $floorPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,FloorPlan $floorplan)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $inputs = $request->only(['project_id','title','priority']);
        if($request->has('image'))
        {
            Storage::delete($floorplan->image);
            $file = $request->file('image');
            $ext = $request->image->extension();
            $filename = time().'.'.$ext;
            $path = $request->image->storeAs('public/floorplan', $filename);
            $inputs['image'] = 'floorplan/'.$filename;
        }
        if($floorplan->update($inputs))
        {
            return redirect('/admin/projects/'.$request->project_id)->withSuccess('Floor Plan Created Successfully!!');
        }
        return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FloorPlan  $floorPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(FloorPlan $floorplan)
    {
        if($floorplan->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
