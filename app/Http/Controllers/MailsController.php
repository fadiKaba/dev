<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SupportMail;

class MailsController extends Controller
{
    public function send(Request $request){
       
        $request->validate([
            'name' => 'required|max:50',
            'subject' => 'required|max:200',
            'email' => 'required|email',
            'message' => 'required|max:1000'
        ]);

        $msg = [
            'name' => $request->name,
            'subject' => $request->subject,
            'email' => $request->email,
            'message' => $request->message,
        ];
        
        try{
           Mail::to('fadikaba9@gmail.com')->send(new SupportMail($msg));

            if(Mail::failures()) {
                return 'faild';
            }else{
                return 'succeed';
            } 
        }catch(Exception $err){
            return 'somthing went wrong';
        }

    }
}
