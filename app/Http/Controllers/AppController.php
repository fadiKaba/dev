<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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
}
