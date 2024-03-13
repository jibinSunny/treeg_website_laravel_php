<?php

namespace App\Http\Controllers\front;
use App\Project;
use App\Testimonial;
use App\NewsAndEvent;
use App\Video;
use App\PhotoAlbum;
use App\ProjectGallery;
use App\ProjectSpecification;
use App\Http\Resources\ProjectCollection;
use App\CallBackRequest;
use Intervention\Image\Facades\Image;
use App\ProjectType;
use App\FloorPlan;
use Illuminate\Support\Facades\Mail;
use App\Location;
use App\ProjectAmenities;
use App\KeyInformation;
use App\ProjectSpecification_category;
use Illuminate\Support\Facades\Storage;
use DB;
use Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Front_Project_controller extends Controller
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
    public function view($id)
    {

        if($id){
			$project_type=ProjectType::get();
			$project = Project::where('id',$id)->get();

			if($project){
				$location = Location::get();

				$projectAmenities = ProjectAmenities::where('project_id',$id)->orderBy('priority', 'asc')->get();
				$projectGallery = ProjectGallery::where('project_id',$id)->orderBy('priority', 'asc')->get();
				$projectSpecification_category = ProjectSpecification_category::where('project_id',$id)->orderBy('priority', 'asc')->get();
				for($i=0;$i<count($projectSpecification_category);$i++)
				{
				  $projectSpecification_category[$i]->specification=ProjectSpecification::where('specification_category_id',$projectSpecification_category[$i]->id)->orderBy('priority', 'asc')->get();
				}
				$floorPlan = FloorPlan::where('project_id',$id)->orderBy('priority', 'asc')->get();
				
				$keyInformation = KeyInformation::where('project_id',$id)->orderBy('priority', 'asc')->get();
			
				
				// return $projectSpecification_category;
				
                return view('front_end.projects-details',compact('project','location','project_type','projectAmenities','projectGallery','projectSpecification_category','floorPlan','keyInformation'));
			}
            return redirect('/projects')->withSuccess('invaild!!');
		}
        return redirect('/projects')->withSuccess('invalid!!');
  
    }
    public function index()
    {
        // return "dvffd";
        $projects = Project::whereActive(true)->with('type')->with('location')->orderBy('priority','asc')->get();
		// return $projects;
		return view('front_end.projects',compact('projects'));
  
	}
	public function project_gallary($id)
	{ 
		// return $id;
		$projectGallery = ProjectGallery::where('project_id',$id)->get();
		if($projectGallery)
		{
			
			return view('front_end.project_gallary',compact('projectGallery'));
		}

	}
	public function getProjects($type)
	{
		// return $type;
		if($type)
		{
			$projects = Project::where('status',"$type")->get();
			// return $projects;
			return view('front_end.projects',compact('projects'));
		}

	}

}
