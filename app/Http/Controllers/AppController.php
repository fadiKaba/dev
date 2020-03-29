<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AppController extends Controller
{
    public function getUser(){
        if(Auth::check()){
            return Auth::user();
        }
    }
}
