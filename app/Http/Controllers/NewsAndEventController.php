<?php

namespace App\Http\Controllers;

use App\NewsAndEvent;
use App\NewsImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class NewsAndEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsandEvents = NewsAndEvent::whereActive(true)->orderBy('created_at', 'dsc')->paginate(20);
        // return $newsandEvents;
        return view('admin.news_and_events.index',compact('newsandEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news_and_events.create');
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
            'title' => 'required|max:100',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $inputs = $request->only(['title','description','date']);
        $inputs['user_id']  =Auth::id();
        if($request->has('image'))
        {
            
            $file = $request->file('image');
            $resize = Image::make($file);
            $resize->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "public/newsandevents/{$hash}.jpg";
            Storage::put($path, $resize->__toString());
            $inputs['image'] = $path;
            $inputs['thumb'] = 'thumbs/'.$request->thumb;
        }

        if(NewsAndEvent::create($inputs))
        {
            return redirect('/admin/newsandevents')->withSuccess('NewsandEvents Created Successfully!!');
        }
        return redirect('/admin/newsandevents')->withError('Oops Something went wrong!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsAndEvent  $newsAndEvent
     * @return \Illuminate\Http\Response
     */
    public function show(NewsAndEvent $newsandevent)
    {
        $newsimages = NewsImage::whereNewsId($newsandevent->id)->get();
        return view('admin.news_and_events.show',compact('newsandevent','newsimages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsAndEvent  $newsAndEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsAndEvent $newsandevent)
    {
        return view('admin.news_and_events.edit',compact('newsandevent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsAndEvent  $newsAndEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsAndEvent $newsandevent)
    {
        $request->validate([
            'title' => 'required|max:100',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $inputs = $request->only(['title','description']);
        $inputs['user_id']  =Auth::id();
        if($request->has('image'))
        {
            Storage::delete($newsandevent->image);
            $file = $request->file('image');
            $resize = Image::make($file);
            $resize->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "public/newsandevents/{$hash}.jpg";
            Storage::put($path, $resize->__toString());
            $inputs['image'] = $path;
            $inputs['thumb'] = 'thumbs/'.$request->thumb;
        }

        if($newsandevent->update($inputs))
        {
            return redirect('/admin/newsandevents')->withSuccess('NewsandEvents Updated Successfully!!');
        }
        return redirect('/admin/newsandevents')->withError('Oops Something went wrong!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsAndEvent  $newsAndEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsAndEvent $newsandevent)
    {
        if($newsandevent->delete())
        {
            return response()->json('true');
        }
        return response()->json('false');
    }
}
