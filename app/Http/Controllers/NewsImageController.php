<?php

namespace App\Http\Controllers;

use App\NewsImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class NewsImageController extends Controller
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
            'news_id' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
        $NewsImage = new NewsImage();
        $NewsImage->news_id=$request->news_id;
        if($request->has('image'))
        {

            $file = $request->file('image');
            $resize = Image::make($file);
            $resize->resize(668, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "public/newsandevents/{$hash}.jpg";
            Storage::put($path, $resize->__toString());

            //Storage::putFile('public/newsandevents', $img);
            //$path = $request->image->storeAs('public/newsandevents', $filename);
            $NewsImage->image = $path;
            //make a thumb image
            // $img = Image::make($file);
            // $img->resize(369, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // //$request->image->storeAs('public/projects', $filename);
            // $filename = "{$hash}.jpg";
            // $thumb = $img->save(public_path('thumbs/'.$filename));
            // $NewsImage->thumb = 'thumbs/'.$filename;
        }
        if($NewsImage->save())
        {
            return redirect('/admin/newsandevents/'.$request->news_id)->withSuccess('NewsandEvents Created Successfully!!');
        }
        return redirect('/admin/newsandevents/'.$request->news_id)->withError('Oops Something went wrong!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsImage  $newsImage
     * @return \Illuminate\Http\Response
     */
    public function show(NewsImage $newsimage)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsImage  $newsImage
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsImage $newsimage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsImage  $newsImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsImage $newsImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsImage  $newsImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsImage $newsimage)
    {
        if($newsimage->delete())
        {
            return response()->json('true');
        }
        return response()->json('true');
    }
}
