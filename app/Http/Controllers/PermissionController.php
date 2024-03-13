<?php

namespace App\Http\Controllers;

use App\Permission;
use App\PermissionRole;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Permission::query();
        if($request->has('global_search'))
        {
            $value = $request->global_search;
            $query->when($value, function ($q, $value) {
                return $q->where('name', 'like', '%'.$value.'%')
                ->orWhere('slug','like','%'.$value.'%');
            });
        }

        $permissions =$query->paginate(20);
        
        return view('admin.permission.index',compact('permissions'));
    }

    public function getAttachPermissionsToRoles()
    {
        $permission_roles = PermissionRole::paginate(20);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.permission_role.index',compact('permission_roles','roles','permissions'));
    }

    // public function AttachPermissionsToRoles(Request $request)
    // {

    //     $role = Role::find($request->role_id);
    //     if($role->syncPermissions($request->permission_ids))
    //     {
    //         return redirect('admin/permission_roles')->withSuccess('Permission Created Successfully');
    //     }
    //     return redirect('admin/permission_roles')->withError('Oops Something went wrong!!');

    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for($i=0;$i<count($request->type);$i++)
        {
            $name = ucfirst($request->type[$i]).' '.$request->name;
           $perm =  Permission::create([
                'name' => $name,
                'slug' =>  str_slug($name, '.'),
                'description' => $request->description, // optional
            ]);
        }
        if($perm){
            return redirect('/admin/permission')->withSuccess('Permission Created Successfully');
        }
        return redirect('/admin/permission')->withError('Oops Something went wrong');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        if($permission->update([
            'name' => $request->name,
            'slug' =>  str_slug($request->slug, '.'),
            'description' => $request->description, // optional
        ])){
        return redirect('/admin/permission')->withSuccess('Permission Created Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if($permission->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
