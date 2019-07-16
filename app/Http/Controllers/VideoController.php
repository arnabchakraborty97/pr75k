<?php

namespace App\Http\Controllers;

use App\Video;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();

        return view('videos.index')->with('videos', $videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        $context = [
            'categories' => $categories,
        ];

        return view('videos.CreateOrUpdate')->with($context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'url' => 'required|unique:videos'
        ]);

        $video = new Video;
        $video->category_id = $request->input('category_id');
        $video->url = $request->input('url');
        $video->user_id = Auth::user()->id;
        $video->save();

        return redirect()->route('videos.index')->with('success', 'Video Updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $categories = Category::all();

        $context = [
            'categories' => $categories,
            'video_edit' => $video
        ];

        return view('videos.CreateOrUpdate')->with($context);
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
        $this->validate($request, [
            'category_id' => 'required',
            'url' => 'required|unique:videos,url,'.$video->id
        ]);

        $video->category_id = $request->input('category_id');
        $video->url = $request->input('url');
        $video->user_id = Auth::user()->id;
        $video->save();

        return redirect()->route('videos.index')->with('success', 'Video Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        try {
            $video->delete();
            return redirect()->back()->with('success', 'Video Deleted');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000")
                return redirect()->back()->with('error', 'Cannot be deleted. Check constraints.');
        }
    }
}
