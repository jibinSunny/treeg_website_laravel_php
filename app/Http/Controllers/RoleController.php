<?php

namespace App\Http\Controllers;

use jeremykenedy\LaravelRoles\Models\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(20);
        $permissions = Permission::all();
        return view('admin.roles.index',compact('roles','permissions'));
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
            'level' => 'required|numeric',
            'permission_ids'=> 'required'
        ]);
        $inputs = $request->only(['name','description','level']);
        $inputs['slug'] = str_slug($request->name, '-');

        $role = Role::create($inputs);
        if($role)
        {
            if($role->syncPermissions($request->permission_ids)){
                return redirect('/admin/roles')->withSuccess('Role created successfully!!');
            }
            else{
                return redirect('admin/roles')->withError('Oops Something went wrong!!');
            }
        }
        return redirect('admin/roles')->withErrors('Oops Something went wrong!!');
    }



    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required|numeric',
            'permission_ids'=> 'required'
        ]);
        $inputs = $request->only(['name','description','level']);
        $inputs['slug'] = str_slug($request->name, '-');

        $role->update($inputs);
        if($role)
        {
            if($role->syncPermissions($request->permission_ids)){
                return redirect('/admin/roles')->withSuccess('Role created successfully!!');
            }
            else{
                return redirect('admin/roles')->withError('Oops Something went wrong!!');
            }
        }
        return redirect('admin/roles')->withErrors();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if($role->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
