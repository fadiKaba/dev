<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use File;
use App\Post;
use App\User;

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
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:50000',
            'category1' => 'required',
            'category2' => ''
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
            'category1' => $request->category1, 
            'category2' => $request->category2 == '' ? null : $request->category2
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
        $request->validate([
            'title' => 'required|max:300',
            'body' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:50000'
        ]);

        $post = Post::findOrFail($id);
        
        if($request->image != ''){
            if(File::exists('posts-images/'.$post->src)){
                File::delete('posts-images/'.$post->src);
            }
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
            $post->update([
                'src' =>  $imgName,
            ]);
        }
        
        $post->update([
            'title' => $request->title,
            'body' => $request->body, 
        ]);

        return $post;
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

        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        return $posts;
    }

    public function getSinglePost($postId){
        
        $post = Post::where('id', $postId)->with('comment')->get();
        return $post;
    }

    public function searchPost($val){

        $results = Post::where('title', 'LIKE', "%$val%")->get();
        return $results;
    }

    public function searchCat($val){

        $result = Post::where('category1', $val)->get();
        return $result;
    }

    public function like($postId){
        
        $post = Post::findOrFail($postId);
 
           if($post->likes == null || $post->likes == ''){
               $likes = [];
           }else{
              $likes = explode(',', $post->likes); 
           }          
 
           if(!in_array(strval(Auth::id()), $likes)){
               array_push($likes,strval(Auth::id()) );
               $likesR = implode(',', $likes);
               $post->update([
                'likes' => $likesR
               ]);
               return 'like';
           }else{
                $index = array_search(Auth::id(), $likes);
                unset($likes[$index]);               
                $likesR = implode(',', $likes);
                $post->update([
                    'likes' => $likesR
                ]);
                return 'unlike';
           }                  
    }

    public function getLikedUsers($val){
      $arr = explode(',', $val);
      $users = User::whereIn('id', $arr)->get();
      return $users;
    }

    public function commentsLength($postId){

      $post = Post::where('id', $postId)->with('comment')->get();

     return count($post[0]['comment']) ;

    }
}
