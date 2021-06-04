<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hash;
use Alert;
use Illuminate\Support\Facades\File;
use Validator, Redirect, Response;
use Image;
use App\Photo;
use Intervention\Image\Exception\NotReadableException;
use App\Helper;
use Illuminate\Support\Facades\Mail;

class Mail_Controller extends Controller
{
    public function sendmail(Request $request)
    {
      $data['phone']=$request->phone;
      $data['name']=$request->name;
      $data['message']=$request->message;
    
      $email="athirasurendran.sics@gmail.com";
       $data = array('name' => $request->name,'phone'=>$request->phone,'msg'=>$request->message);
        //   print_r($data);die();        
    
      Mail::send('mailadmin', $data, function ($message) use($email) {
    
                    $message->to($email)->subject('Message');
                   // $message->from('varshag.srishti@gmail.com', 'The Stock');
                });
                if (Mail::failures()) {
                  // return response showing failed emails
                  // echo "failed";
                  return response()->json(['success' => 'Failed.']);
              }else{
                // echo "mail send";
                // return redirect()->route('login')->with('success', 'Successfully Send');
                return response()->json(['success' => 'Successfully Send.']);
              }
      //         // return redirect()->route('login')->with('success', 'Successfully Send');
      // return redirect()->route('login')->with('success', 'Successfully Send');
    }
   
}
