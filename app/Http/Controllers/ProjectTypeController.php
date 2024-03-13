<?php

namespace App\Http\Controllers;
use DB;
use App\ProjectType;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $types = ProjectType::all();
        // dd($types);
        return view('admin.project_categories.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $projectType= ProjectType::where('id',$id)->get();
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
        ]);
        $input = $request->only(['name','description']);
        $category = ProjectType::create($input);
        if($category)
        {
            return redirect('/admin/project_categories')->withSuccess('Project type Created Successfully');
        }
        return redirect('/admin/project_categories')->withError('Error While creating Project type');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectType= ProjectType::where('id',$id)->get();
        // return $projectType;
        if($projectType->each->delete())
        {
            return redirect('/admin/project_categories')->withSuccess('Project type Delete Successfully');
        }
        return redirect('/admin/project_categories')->withError('Error While Delete Project type');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $projectType= ProjectType::where('id',$id)->get();
        // return  $projectType;
        return view('admin.project_categories.edit',compact('projectType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectType $projectType)
    {
    //   return  $request;

                
        $request->validate([
            'name' => 'required',
        ]);
        if($request->name!=null)
        {
            $data=DB::table('project_type')
            ->where('id', '=', $request->id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
               
            ]);
            if($data)

            {
                return redirect('/admin/project_categories')->withSuccess('Project categories Updated Successfully!!');
            }
            return redirect('/admin/project_categories')->withError('Oops Something went wrong!!');
        }else
        {
            return redirect('/admin/project_categories')->withError('Oops Something went wrong!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectType $projectType)
    {
        return"destroy";
        if($projectType->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
