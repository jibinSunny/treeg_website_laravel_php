<?php

namespace App\Http\Controllers;
use DB;
use App\ProjectAmenities;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;

class ProjectAmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amenities = ProjectAmenities::all();
        return view('admin.project_amenities.index',compact('amenities'));
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
    // dd($request->all());
        $request->validate([
            'project_id' => 'required',
            'title' => 'required',
        ]);
        $Testimonial = new ProjectAmenities();
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
            $path = $request->image->storeAs('public/amenities', $filename);
            // $inputs['image'] = 'amenities/'.$filename;
            $Testimonial->image = 'amenities/'.$filename;
           
        }
        if( $Testimonial->save())
            {
                return redirect('/admin/projects/'.$request->project_id)->withSuccess('Amenities Created Successfully!!');
            }
            return redirect('/admin/project_amenity')->withError('Oops Something went wrong!!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectAmenities  $projectAmenities
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectAmenities $projectAmenity)
    {
        return $projectAmenity;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectAmenities  $projectAmenities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $projectAmenities= ProjectAmenities::where('id',$id)->get();
        // dd($projectAmenities[0]->id);
        return view('admin.projects.amenities_edit',compact('projectAmenities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectAmenities  $projectAmenities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectAmenities $projectAmenity)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
        ]);


            // $inputs = $request->only(['title','priority']);
            if($request->has('image'))
            {
                \File::delete($projectAmenity->image);
                if($request->has('image'))
                {
                    $file = $request->file('image');
                    $ext = $request->image->extension();
                    $filename = time().'.'.$ext;
                    $path = $request->image->storeAs('public/amenities', $filename);
                    $data=DB::table('project_amenities')
                    ->where('id', '=', $projectAmenity->id)
                    ->update([
                        'title' => $request->title,
                        'priority' => $request->priority,
                        
                        'image' => 'amenities/'.$filename,
                        'created_at' =>  \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                       
                    ]);
                }
            }
                else
                {
                $data=DB::table('project_amenities')
                ->where('id', '=', $projectAmenity->id)
                ->update([
                   'title' => $request->title,
                    'priority' => $request->priority,
                   'created_at' =>  \Carbon\Carbon::now(),
                   'updated_at' => \Carbon\Carbon::now(),
                   
                ]);
                }
                if($data)
                {
                    return redirect('/admin/projects/'.$request->project_id)->withSuccess('Amenities Updated Successfully!!');
                }
                return redirect('/admin/projects/'.$request->project_id)->withSuccess('Oops Something went wrong!!');
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectAmenities  $projectAmenities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(ProjectAmenities::find($id)->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
