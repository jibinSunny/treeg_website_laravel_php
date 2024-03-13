<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::whereActive(true)->paginate(20);
        return view('admin.videoalbum.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 

        $videos = Video::whereActive(true)->get();
        return view('admin.videoalbum.create',compact('videos'));
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
            'youtube_video_id' => 'required',
        ]);

        $your_url=$request->youtube_video_id;
        function get_youtube_id_from_url($url)
        {
            if (stristr($url,'youtu.be/'))
                {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
            else 
                {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
        }
        
         $final_video_id=get_youtube_id_from_url($your_url);
         $request->youtube_video_id = 'https://www.youtube.com/embed/'.$final_video_id;
        // return  $request->youtube_video_id;
        $inputs = $request->only(['caption','youtube_video_id']);
        $inputs['youtube_video_id']=  $request->youtube_video_id;
        if($request->has('video_thumb'))
        {
            $file = $request->file('video_thumb');
            $ext = $request->video_thumb->extension();
            $filename = time().'.'.$ext;

            //make a thumb image
            $img = Image::make($file);
            $img->resize(370, 233, function ($constraint) {
                $constraint->aspectRatio();
            });
            //$request->image->storeAs('public/projects', $filename);
            $thumb = $img->save('thumbs/'.$filename);
            $inputs['video_thumb'] = 'thumbs/'.$filename;
        }
        if(Video::create($inputs))
            return redirect('/admin/video')->withSuccess('Video Created Successfully');
        else
            return redirect('/admin/video')->withError('Oops Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return $video;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.videoalbum.edit',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'youtube_video_id' => 'required',
        ]);
        $your_url=$request->youtube_video_id;
        function get_youtube_id_final_url($url)
        {
            if (stristr($url,'youtu.be/'))
                {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
            else 
                {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
        }
        
         $final_video_id=get_youtube_id_final_url($your_url);
         $request->youtube_video_id = 'https://www.youtube.com/embed/'.$final_video_id;
          $inputs = $request->only(['caption','parent_id']);
          $inputs['youtube_video_id']=  $request->youtube_video_id;
        if($video->update($inputs))
            return redirect('/admin/video')->withSuccess('Video Updated Successfully');
        else
            return redirect('/admin/video')->withError('Oops Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        if($video->delete()){
            return response()->json('true');
        }
        return response()->json('true');
    }
}
