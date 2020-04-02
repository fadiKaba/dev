<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Image;
use File;

class AppController extends Controller
{
    public function getUser(){
        if(Auth::check()){
            return Auth::user();
        }
    }
    public function getUserName($userId){
       $user = User::findOrFail($userId);
       return $user->name;
    }

    public function updateUser(Request $reques, $userId){
       
        if($reques->photo != ''){
            $reques->validate([
                'photo' => 'image|max:20000'
            ]);
            $user = Auth::user();
            if(File::exists('users-photos/'.$user->src)){
                File::delete('users-photos/'.$user->src);
            }

            $img = $reques->file('photo');
            $imgName = 'pho' . Auth::id() . time(). '.' .  $img->extension();
            $destination = 'users-photos';
            if(!File::isDirectory($destination)){
                File::makeDirectory($destination, 0777, true, true);   
            }
            $imgM = Image::make($img->path());
            $imgM->orientate()->fit(400, 400, function($constrain){
                $constrain->aspectRatio();
            })->save($destination. '/'. $imgName); 

            $user->update([
                'src' => $imgName
            ]);
            return $imgName;
        }

       return $reques->photo;
    }
}
