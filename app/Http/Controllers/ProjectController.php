<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectType;
use Illuminate\Http\Request;
use App\ProjectSpecification;
use App\ProjectAmenities;
use App\ProjectGallery;
use App\FloorPlan;
use App\ProjectSpecification_category;
use App\Location;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\KeyInformation;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        // $query = Project::query();
        // if($request->has('global_search'))
        // {
        //     $value = $request->global_search;
        //     $query->when($value, function ($q, $value) {
        //         return $q->where('title', 'like', $value.'%');
        //     });
        // }

        // $projects =$query->paginate(20);
        $types = ProjectType::all();
        $projects = Project::orderBy('priority', 'asc')->paginate('20');
        // return $types->id;
        return view('admin.projects.index',compact('projects','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ProjectType::all();
        $amenities = ProjectAmenities::all();
        $locations = Location::all();
        return view('admin.projects.create',compact('types','amenities','locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd( $request->all());
      
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:1024',
            'location' =>'required',
            'latitude' =>'required',
            'longitude' =>'required',
            'longitude' =>'required',
            // 'brochure' => 'mimes:pdf'
        ]);
        $description= html_entity_decode($request->description);
        $inputs = $request->only(['title','type','status','category_id','location','description','priority','phone','address','latitude','longitude','caption','show_booking_status_tab']);
        // $inputs['featured']=  ($request->featured) ? '1' : '0';
        // $inputs['amenities'] = (json_encode($request->amenities)) ? json_encode($request->amenities) : '';
        $inputs['slug']  = Str::slug($request->title, '-');

        // if($request['featured']==true)
        // {
        //     if($request->has('featuredImage'))
        //     {
        //         $file = $request->file('featuredImage');
        //         $ext = $request->featuredImage->extension();
        //         $filename = time().'.'.$ext;
        //     $path = $request->featuredImage->storeAs('public/projects', $filename);
        //         $inputs['featuredImage'] = 'projects/'.$filename;
        //     }
        // }


        if($request->has('brochure'))
        {
            $file = $request->file('brochure');
            $ext = $request->brochure->extension();
            $filename = time().'.'.$ext;
            $path = $request->brochure->storeAs('public/brochures', $filename);
            $inputs['brochure'] = 'brochures/'.$filename;
        }
        
        // dd( $request->all());
        if($request->has('image'))
        {
           
            // $file = $request->file('image');
            // // return $file;
            // $resize = Image::make($file);
            // $resize->resize(969, 485, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->encode('png');
            // $hash = pathinfo($request->thumb, PATHINFO_FILENAME);
            // $path = "public/projects_image/{$request->thumb}.png";
            // Storage::put($path, $resize->__toString());
            // // return $path;
            // $inputs['image'] = $path;
  
            $file = $request->file('image');
            $resize = Image::make($file);
            $resize->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "public/projects_image/{$hash}.jpg";
            Storage::put($path, $resize->__toString());
            $inputs['image'] = $path;
            // $inputs['thumb'] = 'thumbs/'.$request->thumb;














        }
        // if($request->has('image'))
        // {
        //     $file = $request->file('image');
        //     // return $file;
        //     $resize = Image::make($file);
        //     $resize->resize(969, 485, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->encode('jpg');
        //     $hash = pathinfo($request->thumb, PATHINFO_FILENAME);
        //     $path = "public/projects/{$hash}.jpg";
        //     return $hash;
        //     Storage::put($path, $resize->__toString());
        //     return $path;
        //     //Storage::putFile('public/newsandevents', $img);
        //     //$path = $request->image->storeAs('public/newsandevents', $filename);
        //     $inputs['image'] = $path;
        //     $inputs['thumb'] = 'thumbs/'.$request->thumb;
        // }
    
      
        
        if($request->has('logo'))
        {
            $file = $request->file('logo');
            $ext = $request->logo->extension();
            $filename = time().'.'.$ext;
            $path = $request->logo->storeAs('public/logo', $filename);
            $inputs['logo'] = 'logo/'.$filename;
           
        }
        if($request->has('booking_image'))
        {
          

            $file = $request->file('booking_image');
            $ext = $request->booking_image->extension();
            $filename = time().'.'.$ext;
            $path = $request->booking_image->storeAs('public/project_book', $filename);
            // $inputs['image'] = 'amenities/'.$filename;
            $inputs['booking_image'] = 'project_book/'.$filename;
            
        }
        if(Project::create($inputs))
        {
            return redirect('/admin/projects')->withSuccess('Project Created Successfully!!');
        }
        return redirect('/admin/projects')->withError('Oops Something went wrong!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

       $specs = ProjectSpecification::whereProjectId($project->id)->orderBy('priority', 'asc')->paginate(100);
       $specs_category = ProjectSpecification_category::whereProjectId($project->id)->orderBy('priority', 'asc')->paginate(100);
       $location = Location::get();
    //    dd($project);
    //    if($project->amenities!='null' AND $project->amenities!=null AND $project->amenities!=''){
    //        $amen = json_decode($project->amenities);
	//        $amenities = ProjectAmenities::whereIn('id',$amen)->get();
   	// 	}else{
   	// 		$amenities=null;
    //        }
    $amenities = ProjectAmenities::whereProjectId($project->id)->orderBy('priority', 'asc')->paginate(100);
  
       $keyinformations= KeyInformation::whereProjectId($project->id)->orderBy('priority', 'asc')->paginate(10);
       $galleries = ProjectGallery::whereProjectId($project->id)->orderBy('priority', 'asc')->paginate(100);
       $floorplans = FloorPlan::whereProjectId($project->id)->orderBy('priority', 'asc')->paginate(100);
       return view('admin.projects.show',compact('project','specs','location','amenities','galleries','floorplans','keyinformations','specs_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = ProjectType::all();
         $amenities = ProjectAmenities::all();
         $locations = Location::all();
        return view('admin.projects.edit',compact('project','amenities','locations','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {  
        
        // dd($request->all());

        if($request->has('approve'))
        {
            $project->active = $request->approve;
            if($project->update())
            {
                return redirect('/admin/projects')->withSuccess('Projects Updated successfully');
            }
            return redirect('/admin/projects')->withError('Oops Something went wrong!!');
        }

        $request->validate([
            'title' => 'required',
      
       
        ]);
        //  html_entity_decode($request->description);


         $inputs = $request->only(['title','type','status','category_id','location','description','priority','phone','address','latitude','longitude','caption','show_booking_status_tab']);
        // $inputs['featured']=  ($request->featured) ? '1' : '0';
        if($request->show_booking_status_tab =="1")
        {
            $inputs['show_booking_status_tab'] = $request->show_booking_status_tab;

        }
        else
        {
            $inputs['show_booking_status_tab'] = "0";
        }
        // $inputs['amenities'] = json_encode($request->amenities);
        $inputs['slug']  = Str::slug($request->title, '-');

        if($request->has('image'))
        {
            \File::delete($project->image);
            $name = basename($project->image);
            \File::delete('thumbs/'.$name);
            $file = $request->file('image');
            $resize = Image::make($file);
            $resize->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "public/projects_image/{$hash}.jpg";
            Storage::put($path, $resize->__toString());
            $inputs['image'] = $path;
        }

        if($request->has('brochure'))
        {
           

            Storage::delete($project->brochure);
            $file = $request->file('brochure');
            $ext = $request->brochure->extension();
            $filename = time().'.'.$ext;
            $path = $request->brochure->storeAs('public/brochures', $filename);
            $inputs['brochure'] = 'brochures/'.$filename;
        }



        // if($request['featured']==true)
        // {
        //     if($request->has('featuredImage'))
        //     {
        //         \File::delete($project->featuredImage);
        //         $file = $request->file('featuredImage');
        //         $ext = $request->featuredImage->extension();
        //         $filename = time().'.'.$ext;
        //     $path = $request->featuredImage->storeAs('public/projects', $filename);
        //         $inputs['featuredImage'] = 'projects/'.$filename;
            
        //     }
        // }


        if($request->has('logo'))
        {
            \File::delete($project->logo);
            $file = $request->file('logo');
            $ext = $request->logo->extension();
            $filename = time().'.'.$ext;
            $path = $request->logo->storeAs('public/logo', $filename);
            $inputs['logo'] = 'logo/'.$filename;
           
        }
        if($request->has('booking_image'))
        {
            \File::delete($project->booking_image);

            $file = $request->file('booking_image');
            $ext = $request->booking_image->extension();
            $filename = time().'.'.$ext;
            $path = $request->booking_image->storeAs('public/project_book', $filename);
            // $inputs['image'] = 'amenities/'.$filename;
            $inputs['booking_image'] = 'project_book/'.$filename;

            // $file = $request->file('booking_image');
            // $ext = $request->booking_image->extension();
            // $filename = time().'.'.$ext;
            // $path = $request->booking_image->storeAs('public/booking_image', $filename);
            // $inputs['booking_image'] = 'projects/'.$filename;
           
        }
        if($project->update($inputs))
        {
            return redirect('/admin/projects')->withSuccess('Project Updated Successfully!!');
        }
        return redirect('/admin/projects')->withError('Oops Something went wrong!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        
        if($project->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
