<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.CreateOrUpdate');
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
            'title' => 'required|unique:posts',
            'content' => 'required',
            'photos' => 'required'
        ]);
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        $post->save();

        foreach ($request->photos as $key => $file) {
            $photo = new Photo;
            $photo->attachment = time().$key.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/storage/attachments'), $photo->attachment);
            $photo->post_id = $post->id;
            $photo->save();
        }

        return redirect()->route('posts.index')->with('success', 'Post Added');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.CreateOrUpdate')->with('post_edit', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title,'.$post->id,
            'content' => 'required',
        ]);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        $post->save();

        if (isset($request->photos)) {

            foreach ($post->photos as $photo) {
                $destinationPath = public_path().'/storage/attachments';
                File::delete($destinationPath.'/'.$photo->attachment);
                $photo->delete();
            }

            foreach ($request->photos as $key => $file) {
                $photo = new Photo;
                $photo->attachment = time().$key.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('/storage/attachments'), $photo->attachment);
                $photo->post_id = $post->id;
                $photo->save();
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->delete())
            return redirect()->route('posts.index')->with('success', 'Post Deleted');
    }
}
