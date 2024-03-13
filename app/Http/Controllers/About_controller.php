<?php

namespace App\Http\Controllers;
use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon;
class About_controller extends Controller
{
    public function create()
    {
        return view('admin.about.create');
    }
    public function index()
    {
        $about=DB::table('about')->get();
        // return $about;
        // return view('admin.about.create');
        return view('admin.about.index')
        ->with(['about' => $about]);
        
    }
    public function edit($id)
    {
        $about=DB::table('about')->where('id',$id)->get();
        // return $about;
        // return view('admin.about.create');
        return view('admin.about.edit')
        ->with(['about' => $about]);
        
    }
    public function delete($id)
    {
        $about=DB::table('about')->where('id',$id)->get();
        // return $about;

        if($about) {
            $about->each->delete();

            return response()->json('true');
        }
        else
            return response()->json('false');
        
    }


    public function edit_save(Request $request)
    {
       
        $request->validate([
            'description' => 'required',
            
        ]);
        // dd($request->all());
      
        $data=DB::table('about')
        ->where('id', '=', $request->id)
        ->update([
            'description' => $request->description,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        if($data)
        {
            return redirect('admin/about/list');
        }
        return view('admin.about.create');

    }

    public function save(Request $request)
    {
       
        $request->validate([
            'description' => 'required',
            
        ]);
        // $about = new About();
      
        $data=DB::table('about')->insert([
            'description' => $request->description,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        // dd($request->all());
        if($data)
        {
            return redirect('admin/about/list');
        }
        return view('admin.about.create');

    }
}
