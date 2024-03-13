<?php

namespace App\Http\Controllers;

use App\PhotoAlbum;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PhotoAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photoAlbums = PhotoAlbum::whereActive(true)->whereParentId(0)->orderBy('priority', 'asc')->paginate(20);
        return view('admin.photoalbum.index',compact('photoAlbums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photoalbum.create');
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
            // 'caption' => 'required',
            'parent_id' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png'
        ]);


        $inputs = $request->only(['parent_id','priority','caption','caption']);
        if($request->has('image'))
        {
            // $file = $request->file('image');
            // $resize = Image::make($file);
            // $resize->resize(1000, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->encode('jpg');
            // $hash = pathinfo($request->thumb, PATHINFO_FILENAME);
            // $path = "public/image_gallery/{$hash}.jpg";
            // Storage::put($path, $resize->__toString());

            // //Storage::putFile('public/newsandevents', $img);
            // //$path = $request->image->storeAs('public/newsandevents', $filename);
            // $inputs['image'] = $path;
            // $inputs['thumb'] = 'thumbs/'.$request->thumb;

            $file = $request->file('image');
            $resize = Image::make($file);
            $resize->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "public/image_gallery/{$hash}.jpg";
            Storage::put($path, $resize->__toString());
            $inputs['image'] = $path;
            $inputs['thumb'] = 'thumbs/'.$request->thumb;



        }
        if(PhotoAlbum::create($inputs))
        {
            if($request->parent_id!=0)
            {
                return redirect('/admin/photo/'.$request->parent_id)->withSuccess('Image Created Successfully!!');
            }
            return redirect('/admin/photo/')->withSuccess('Image Created Successfully!!');
        }
        return redirect('/admin/photo/')->withError('Oops Something went wrong!!');
    }

    public function edit(PhotoAlbum $photo)
    {
        return view('admin.photoalbum.edit',compact('photo'));
    }



    public function update(Request $request,PhotoAlbum $photo)
    {

         $request->validate([
            // 'caption' => 'required',
            'parent_id' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png'
        ]);


        $inputs = $request->only(['parent_id','caption','caption','priority']);
        if($request->has('image'))
        {
            \File::delete($photo->image);
            // $file = $request->file('image');
            // $resize = Image::make($file);
            // $resize->resize(1000, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->encode('jpg');
            // $hash = pathinfo($request->thumb, PATHINFO_FILENAME);
            // $path = "public/image_gallery/{$hash}.jpg";
            // Storage::put($path, $resize->__toString());

            // //Storage::putFile('public/newsandevents', $img);
            // //$path = $request->image->storeAs('public/newsandevents', $filename);
            // $inputs['image'] = $path;
            // $inputs['thumb'] = 'thumbs/'.$request->thumb;




            $file = $request->file('image');
            $resize = Image::make($file);
            $resize->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "public/image_gallery/{$hash}.jpg";
            Storage::put($path, $resize->__toString());
            $inputs['image'] = $path;
            $inputs['thumb'] = 'thumbs/'.$request->thumb;

        }
        if($photo->update($inputs))
        {
            if($request->parent_id!=0)
            {
                return redirect('/admin/photo/'.$request->parent_id)->withSuccess('Image Created Successfully!!');
            }
            return redirect('/admin/photo/')->withSuccess('Image Created Successfully!!');
        }
        return redirect('/admin/photo/')->withError('Oops Something went wrong!!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\PhotoAlbum  $photoAlbum
     * @return \Illuminate\Http\Response
     */
    public function show(PhotoAlbum $photo)
    {
        $photoAlbums = PhotoAlbum::whereActive(true)->whereParentId($photo->id)->paginate(20);
        return view('admin.photoalbum.show',compact('photo','photoAlbums'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhotoAlbum  $photoAlbum
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhotoAlbum  $photoAlbum
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhotoAlbum $photo)
    {
        if($photo->delete())
            return response()->json('true');
        else
            return response()->json('false');
    }
}
