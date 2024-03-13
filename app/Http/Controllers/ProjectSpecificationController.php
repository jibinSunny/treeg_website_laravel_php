<?php

namespace App\Http\Controllers;
use App\ProjectSpecification_category;
use App\ProjectSpecification;
use Illuminate\Http\Request;

class ProjectSpecificationController extends Controller
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
            'specification_category_id' => 'required|numeric',
            'content' => 'required'
        ]);
        if($request->title!=null || $request->content!=null)
        {
            $inputs = $request->only(['specification_category_id','project_id','content','priority']);
            if(ProjectSpecification::create($inputs))
            {
                return redirect('/admin/projects/'.$request->project_id)->withSuccess('Specification Created Successfully!!');
            }
            return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
        }else
        {
            return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectSpecification  $projectSpecification
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectSpecification $project_spec)
    {
        // dd($project_spec->id);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectSpecification  $projectSpecification
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectSpecification $project_spec)
    {
        // dd($project_spec->project_id);
        $specs = ProjectSpecification_category::whereProjectId($project_spec->project_id)->orderBy('priority', 'asc')->paginate(100);
        return view('admin.projects.specification_edit',compact('project_spec','specs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectSpecification  $projectSpecification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectSpecification $project_spec)
    {
        //
        // dd($project_spec->id);
        $request->validate([
            'content' => 'required',
            'specification_category_id' => 'required',
          
        ]);
        $inputs = $request->only(['content', 'priority','specification_category_id']);
        if (ProjectSpecification::where('id',$project_spec->id)->update($inputs))
        {
           
            return redirect('/admin/projects/'.$request->project_id)->withSuccess('Specification Category Update Successfully!!');
           
        }
        return redirect('/admin/projects/'.$request->project_id)->withSuccess('Oops Something went wrong!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectSpecification  $projectSpecification
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectSpecification $project_spec)
    {
        //
        
        if($project_spec->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
