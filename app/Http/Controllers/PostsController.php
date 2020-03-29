<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use File;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create';
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
            'title' => 'required|max:300',
            'body' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:50000'
        ]);
        if($request->image != ''){
            $img = $request->file('image');
            $imgName ='pos' . Auth::id() . time() . '.' . $img->extension(); 
            $destination = 'posts-images';
            if(!File::isDirectory($destination)){
                File::makeDirectory($destination, 0777, true, true);   
            }
            $imgM = Image::make($img->path());
            $imgM->orientate()->fit(1200, 700, function($constrain){
                $constrain->aspectRatio();
            })->save($destination. '/'. $imgName);           
        }
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
            'src' => $request->image != '' ? ($imgName) : '',
        ]);
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'edit';
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
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $post = Post::findOrFail($id);
        if(File::exists('posts-images/'.$post->src)){
            File::delete('posts-images/'.$post->src);
        }
        $post->delete();
        return $post;
    }

    public function getPosts(){

        $posts = Post::All();
        return $posts;
    }
}
