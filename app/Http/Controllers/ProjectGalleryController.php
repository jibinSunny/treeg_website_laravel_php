<?php

namespace App\Http\Controllers;

use App\ProjectGallery;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProjectGalleryController extends Controller
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
        // dd($request->all());
        $request->validate([
            'project_id' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png'
        ]);


        $inputs = $request->only(['project_id','priority']);
        if($request->has('image'))
        {


            $file = $request->file('image');
            $ext = $request->image->extension();
            $filename = time().'.'.$ext;
            $path = $request->image->storeAs('public/project_gallery', $filename);
            // $inputs['image'] = 'amenities/'.$filename;
            $inputs['image'] = 'project_gallery/'.$filename;


        //     $file = $request->file('image');
        //     $resize = Image::make($file);
        //     $resize->resize(800, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->encode('jpg');
        //     $hash = md5($resize->__toString());
        //     $path = "public/gallery/{$hash}.jpg";
        //     Storage::put($path, $resize->__toString());
        //     $inputs['image'] = $path;
        //     //make a thumb image
        //     $img = Image::make($file);
        //     $img->fit(360, 228);
        //    $filename = "/{$hash}.jpg";
        //     $destination_path = 'thumbs';
        //     $thumb=$img->save(public_path($destination_path), $filename);
        //     $inputs['thumb'] = 'thumbs/'.$filename;
        }
        if(ProjectGallery::create($inputs))
        {
            return redirect('/admin/projects/'.$request->project_id)->withSuccess('Image Created Successfully!!');
        }
        return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectGallery  $projectGallery
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectGallery $projectGallery)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectGallery  $projectGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectGallery $projectGallery)
    {
        //   dd($projectGallery);
          return view('admin.projects.projectGallery_edit',compact('projectGallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectGallery  $projectGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectGallery $projectGallery)
    {
        // dd($request->all());
         $request->validate([
            'project_id' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png'
        ]);


        $inputs = $request->only(['project_id','priority']);
        if($request->has('image'))
        {
            $file = $request->file('image');
            $ext = $request->image->extension();
            $filename = time().'.'.$ext;
            $path = $request->image->storeAs('public/project_gallery', $filename);
            $inputs['image'] = 'project_gallery/'.$filename;


        //    $file = $request->file('image');
        //     $resize = Image::make($file);
        //     $resize->resize(800, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->encode('jpg');
        //     $hash = md5($resize->__toString());
        //     $path = "public/gallery/{$hash}.jpg";
        //     Storage::put($path, $resize->__toString());
        //     $inputs['image'] = $path;
        //     //make a thumb image
        //     $img = Image::make($file);
        //     $img->fit(360, 228);
        //    $filename = "/{$hash}.jpg";
        //     $destination_path = 'thumbs';
        //     $thumb=$img->save(public_path($destination_path), $filename);
        //     $inputs['thumb'] = 'thumbs/'.$filename;
        }
        if($projectGallery->update($inputs))
        {
            return redirect('/admin/projects/'.$request->project_id)->withSuccess('Image Created Successfully!!');
        }
        return redirect('/admin/projects/'.$request->project_id)->withError('Oops Something went wrong!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectGallery  $projectGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectGallery $projectGallery)
    {
        if($projectGallery->delete())
        {
            \File::delete($projectGallery->image);
            \File::delete($projectGallery->thumb);
            return response()->json('true');
        }
        return response()->json('false');
    }
}
