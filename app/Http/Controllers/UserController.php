<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index',compact('users','roles'));
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6:max:20|confirmed',
            'role_id' => 'required'
        ]);
        $inputs = $request->only(['name','email','phone']);
        if($request->has('profile_pic'))
        {

        }else{
            $inputs['profile_pic']='img/avatar.jpg';
        }
        $inputs['password'] = bcrypt($request->password);
        $user= User::create($inputs);
         if($user->attachRole($request->role_id))
        {
            return redirect('admin/users')->withSuccess('User Created successfully');
        }
        return redirect('admin/users')->withSuccess('User Created Faild');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6:max:20|confirmed',
            'role_id' => 'required'
        ]);
        $inputs = $request->only(['name','email','phone']);
        if($request->has('profile_pic'))
        {

        }else{
            $inputs['profile_pic']='img/avatar.jpg';
        }
        $inputs['password'] = bcrypt($request->password);
        $user= User::find($id);
        $user->update($inputs);
        if($user->attachRole($request->role_id))
        {
            return redirect('/admin/users')->withSuccess('User Updated successfully');
        }
        return redirect('/admin/users')->withErrors('User Updated Faild');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
