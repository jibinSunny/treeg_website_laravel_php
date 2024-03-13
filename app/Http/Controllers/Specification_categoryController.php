<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectSpecification;
use App\ProjectSpecification_category;
class Specification_categoryController extends Controller
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
            'title' => 'required'
        ]);
        if($request->title!=null || $request->content!=null)
        {
            $inputs = $request->only(['project_id','title','priority']);
            if(ProjectSpecification_category::create($inputs))
            {
                return redirect('/admin/projects/'.$request->project_id)->withSuccess('Specification Category Created Successfully!!');
            }
            return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
        }else
        {
            return redirect('/admin/project/'.$request->project_id)->withError('Oops Something went wrong!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specs = ProjectSpecification::where('specification_category_id',$id)->orderBy('priority', 'asc')->paginate(100);
        $project_spec_category = ProjectSpecification_category::where('id', $id)->get();
        return view('admin.projects.specification_category_show',compact('project_spec_category','specs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project_spec_category = ProjectSpecification_category::where('id', $id)->get();
        return view('admin.projects.specification_category_edit',compact('project_spec_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        // dd("dbgf");
        $request->validate([
            'title' => 'required',
          
        ]);
        $inputs = $request->only(['title', 'priority']);

        if (ProjectSpecification_category::where('id',$id)->update($inputs))
        {
           
            return redirect('/admin/projects/'.$request->project_id)->withSuccess('Specification Category Update Successfully!!');
           
        }
        return redirect('/admin/projects/'.$request->project_id)->withSuccess('Oops Something went wrong!!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (ProjectSpecification_category::find($id)->delete()) {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
