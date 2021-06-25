<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserAuth_Controller extends Controller
{
  public function userRegistration(Request $request)
  {

    $data['first_name'] = $request->fname;
    $data['last_name'] = $request->lname;
    $data['email'] = $request->email;
    $data['password'] = base64_encode($request->password);
    $data['phone'] = $request->phone;
    $data['dob'] = $request->dob;
    $data['gender'] = $request->gender;
    $data['device_token'] = $request->device_token;
    $data['country'] = $request->country;
    $data['country_code']=$request->country_code;
    $data['userid']=$request->userid;

     if ($request->hasFile('image')) {
                $pfileimg = $request->image;
                $pextension = $pfileimg->getClientOriginalExtension();
                $pname = time() . rand(11111, 99999) . '.' . $pextension;
                $pfileimg->move('uploads/profile_pic', $pname);
                $profile_pic = $pname;
            } else {
                $profile_pic = "";
            }
   $usersCount = DB::table('tb_users')->where('email', $request->email)->count();
            if($usersCount==1){
    $users = DB::table('tb_users')->where('email', $request->email)->first();
    $emailveri=$users->email_verification ;
    if ($emailveri == 1) {

      $result['status'] = false;
      $result['message'] = 'You have already registered to this application. Try Login';
      //$result['user_details']=$users;

    }
    else if($emailveri==0){
       $date=date("Y-m-d", strtotime($data['dob']));
      $affected = DB::table('tb_users')
      ->where('email', $data['email'])
      ->update(['first_name' => $data['first_name'],'last_name'=>$data['last_name'],'email'=>$data['email'], 'password' => $data['password'],'phone'=>$data['phone'], 'dob' => $date,'gender'=>$data['gender'],'device_token' => $data['device_token'], 'country' => $data['country'],'country_code'=>$data['country_code'],'profile_pic'=>$profile_pic,'reg_status'=>1]);
      $userdata = DB::table('tb_users')->where('email', $request->email)->first();
      $details=array("id"=>(int)$userdata->id,
                           "first_name"=>($userdata->first_name==null) ? "" : $userdata->first_name,
                            "last_name"=>($userdata->last_name==null) ? "" : $userdata->last_name,
                            "email"=>($userdata->email==null) ? "" : $userdata->email,
                            "password"=>(base64_decode($userdata->password)==null) ? "" : base64_decode($userdata->password),
                            "phone"=>($userdata->phone==null) ? "" : $userdata->phone,
                             "dob"=>($userdata->dob==null) ? "" : $userdata->dob,
                             "gender"=>($userdata->gender==null) ? "" : $userdata->gender,
                             "profile_pic"=>($userdata->profile_pic==null)?"": 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdata->profile_pic,
                             "created_at"=>($userdata->created_at==null) ? "" : $userdata->created_at,
                             "updated_at"=>($userdata->updated_at==null) ? "" : $userdata->updated_at,
                             "device_token"=>($userdata->device_token==null) ? "" : $userdata->device_token ,
                              "country"=>($userdata->country==null) ? "" : $userdata->country,
                              "country_code"=>($userdata->country_code==null) ?"" : $userdata->country_code,
                              "phone_verification"=>(bool)$userdata->phone_verification,
                              "email_verification"=> (bool)$userdata->email_verification);


// print_r($details);die();
    $otp=rand ( 1000 , 9999 );
      $result['status'] = true;
      $result['message'] = 'Registration Successfull';
      $result['otp']=$otp;
      $result['user_details'] =$details;
       $email=$request->email;
 $data = array( 'content' => $otp);
            Mail::send('otp', $data, function ($message) use($email) {
                $message->to($email)->subject('Confirmation Code');
               // $message->from('varshag.srishti@gmail.com', 'The Stock');
            });
    }}
    // DB::table('users')->insert($data);
    else {
      if($request->userid!=""){
      $date=date("Y-m-d", strtotime($data['dob']));
      $affected = DB::table('tb_users')
      ->where('id', $request->userid)
      ->update(['first_name' => $data['first_name'],'last_name'=>$data['last_name'],'email'=>$data['email'], 'password' => $data['password'],'phone'=>$data['phone'], 'dob' => $date,'gender'=>$data['gender'],'device_token' => $data['device_token'], 'country' => $data['country'],'country_code'=>$data['country_code'],'profile_pic'=>$profile_pic,'reg_status'=>1]);


      $userdata = DB::table('tb_users')->where('id', $data['userid'])->first();

$details=array("id"=>(int)$userdata->id,
                           "first_name"=>($userdata->first_name==null) ? "" : $userdata->first_name,
                            "last_name"=>($userdata->last_name==null) ? "" : $userdata->last_name,
                            "email"=>($userdata->email==null) ? "" : $userdata->email,
                            "password"=>(base64_decode($userdata->password)==null) ? "" : base64_decode($userdata->password),
                            "phone"=>($userdata->phone==null) ? "" : $userdata->phone,
                             "dob"=>($userdata->dob==null) ? "" : $userdata->dob,
                             "gender"=>($userdata->gender==null) ? "" : $userdata->gender,
                             "profile_pic"=>($userdata->profile_pic==null)?"": 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdata->profile_pic,
                             "created_at"=>($userdata->created_at==null) ? "" : $userdata->created_at,
                             "updated_at"=>($userdata->updated_at==null) ? "" : $userdata->updated_at,
                             "device_token"=>($userdata->device_token==null) ? "" : $userdata->device_token ,
                              "country"=>($userdata->country==null) ? "" : $userdata->country,
                              "country_code"=>($userdata->country_code==null) ?"" : $userdata->country_code,
                              "phone_verification"=>(bool)$userdata->phone_verification,
                              "email_verification"=> (bool)$userdata->email_verification);


// print_r($details);die();
    $otp=rand ( 1000 , 9999 );
      $result['status'] = true;
      $result['message'] = 'Registration Successfull';
      $result['otp']=$otp;
      $result['user_details'] =$details;
       $email=$request->email;
 $data = array( 'content' => $otp);
            Mail::send('otp', $data, function ($message) use($email) {
                $message->to($email)->subject('Confirmation Code');
               // $message->from('varshag.srishti@gmail.com', 'The Stock');
            });
   }





else{



      $date=date("Y-m-d", strtotime($data['dob']));
      $id = DB::table('tb_users')->insertGetId(
        ['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'password' => $data['password'], 'phone' => $data['phone'], 'dob' => $date, 'gender' => $data['gender'], 'device_token' => $data['device_token'], 'country' => $data['country'],'country_code'=>$data['country_code'],'profile_pic'=>$profile_pic,"reg_status"=>1]
      );
      $userdata = DB::table('tb_users')->where('id', $id)->first();


$details=array("id"=>(int)$userdata->id,
                           "first_name"=>($userdata->first_name==null) ? "" : $userdata->first_name,
                            "last_name"=>($userdata->last_name==null) ? "" : $userdata->last_name,
                            "email"=>($userdata->email==null) ? "" : $userdata->email,
                            "password"=>(base64_decode($userdata->password)==null) ? "" : base64_decode($userdata->password),
                            "phone"=>($userdata->phone==null) ? "" : $userdata->phone,
                             "dob"=>($userdata->dob==null) ? "" : $userdata->dob,
                             "gender"=>($userdata->gender==null) ? "" : $userdata->gender,
                             "profile_pic"=>($userdata->profile_pic==null)?"": 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdata->profile_pic,
                             "created_at"=>($userdata->created_at==null) ? "" : $userdata->created_at,
                             "updated_at"=>($userdata->updated_at==null) ? "" : $userdata->updated_at,
                             "device_token"=>($userdata->device_token==null) ? "" : $userdata->device_token ,
                              "country"=>($userdata->country==null) ? "" : $userdata->country,
                              "country_code"=>($userdata->country_code==null) ?"" : $userdata->country_code,
                              "phone_verification"=>(bool)$userdata->phone_verification,
                              "email_verification"=> (bool)$userdata->email_verification);


// print_r($details);die();
    $otp=rand ( 1000 , 9999 );
      $result['status'] = true;
      $result['message'] = 'Registration Successfull';
      $result['otp']=$otp;
      $result['user_details'] =$details;
       $email=$request->email;
 $data = array( 'content' => $otp);
            Mail::send('otp', $data, function ($message) use($email) {
                $message->to($email)->subject('Confirmation Code');
               // $message->from('varshag.srishti@gmail.com', 'The Stock');
            });
   
      //calling email otp sending function

      //
          }
    }
    return json_encode($result);
  }


// public function sendOTP($email){

// $otp=rand ( 10000 , 99999 );
//   $data = array('name' => 'Athira', 'content' => $otp);
//             Mail::send('otp', $data, function ($message) use($email) {
//                 $message->to($email)->subject('Confirmation Code');
//                // $message->from('varshag.srishti@gmail.com', 'The Stock');
//             });
//             return $otp;
// }
  public function userLogin(Request $request)
  {
    $data['email'] = $request->email;
    $data['password'] = $request->password;
    $count = DB::table('tb_users')->where('email', $request->email)->where('password', base64_encode($request->password))->where('block_status',0)->count();
          $count1 = DB::table('tb_owner')->where('email', $request->email)->where('password', base64_encode($request->password))->where('block_status',0)->count();
      
         if ($count==1) {
             $userdetails1 = DB::table('tb_users')->where('email', $request->email)->where('password', base64_encode($request->password))->where('block_status',0)->first();
          $veri=$userdetails1->email_verification;
         // echo $veri;die();

if($veri==1){
            $token['device_token']=$request->device_token;
            $affected = DB::table('tb_users')
              ->where('email', $request->email)
              ->update(['device_token' => $request->device_token]);
               $userdetails = DB::table('tb_users')->where('email', $request->email)->where('password', base64_encode($request->password))->first();
              $details=array("id"=>(int)$userdetails->id,
                           "first_name"=>($userdetails->first_name==null) ? "" : $userdetails->first_name,
                            "last_name"=>($userdetails->last_name==null) ? "" : $userdetails->last_name,
                            "email"=>($userdetails->email==null) ? "" : $userdetails->email,
                            "password"=>(base64_decode($userdetails->password)==null) ? "" : base64_decode($userdetails->password),
                            "phone"=>($userdetails->phone==null) ? "" : $userdetails->phone,
                             "dob"=>($userdetails->dob==null) ? "" : $userdetails->dob,
                             "gender"=>($userdetails->gender==null) ? "" : $userdetails->gender,
                             "profile_pic"=>($userdetails->profile_pic==null)? "" : 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdetails->profile_pic,
                             "created_at"=>($userdetails->created_at==null) ? "" : $userdetails->created_at,
                             "updated_at"=>($userdetails->updated_at==null) ? "" : $userdetails->updated_at,
                             "device_token"=>($userdetails->device_token==null) ? "" : $userdetails->device_token ,
                              "country"=>($userdetails->country==null) ? "" : $userdetails->country,
                              "country_code"=>($userdetails->country_code==null) ? "" : $userdetails->country_code,
                              "userstatus"=>'user',
                              "email_verification"=>($userdetails->email_verification==null) ? "" :(bool)$userdetails->email_verification);
            
            $result['status']=true;
            $result['message']='Successfully Logged In';
          
            $result['user_details']=$details;
          }
          else{
              $result['status']=false;
            $result['message']='Invalid Credentails';
         
          $result['user_details']=$data;
          
         }
          }
          else if($count1==1){
              $token['device_token']=$request->device_token;
            $affected = DB::table('tb_owner')
              ->where('email', $request->email)
              ->update(['device_token' => $request->device_token]);
               $userdetails = DB::table('tb_owner')->where('email', $request->email)->where('password', base64_encode($request->password))->where('block_status',0)->first();
               $details=array("id"=>(int)$userdetails->id,
                           "first_name"=>($userdetails->first_name==null)? "" : $userdetails->first_name,
                            "last_name"=>($userdetails->last_name==null) ? "" : $userdetails->last_name,
                            "email"=>($userdetails->email==null) ? "" : $userdetails->email,
                            "password"=>($userdetails->password==null) ? "" :base64_decode($userdetails->password),
                             "phone"=>($userdetails->phone==null) ? "" : $userdetails->phone,
                             "gender"=>($userdetails->gender==null) ? "" : $userdetails->gender,
                             "profile_pic"=>($userdetails->profile_pic==null)? "" : 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdetails->profile_pic,
                              "country"=>($userdetails->country==null) ? "" : $userdetails->country,
                              "civil_id"=>($userdetails->civil_id==null) ? "" : $userdetails->civil_id,
                               "chalet_ownership"=>($userdetails->chalet_ownership==null) ? "" : $userdetails->chalet_ownership,
                               "agreement"=>($userdetails->agreement==null) ? "" : $userdetails->agreement,
                               "bank_holder_name"=>($userdetails->bank_holder_name==null) ? "" : $userdetails->bank_holder_name,
                               "bank_name"=>($userdetails->bank_name==null) ? "" : $userdetails->bank_name,
                               "iban_num"=>($userdetails->iban_num==null) ? "" : $userdetails->iban_num,

                             "created_at"=>($userdetails->created_at==null) ? "" : $userdetails->created_at,
                             "updated_at"=>($userdetails->updated_at == null) ? "" : $userdetails->updated_at,
                             "device_token"=>($userdetails->device_token==null) ? "" : $userdetails->device_token,
                             "userstatus"=>'owner',
                              "email_verification"=>false
                             
                           );
            
            $result['status']=true;
            $result['message']='Successfully Logged In';
            
            $result['user_details']=$details;

          }
          else {
            $result['status']=false;
            $result['message']='Invalid Credentails';
            
          $result['user_details']=$data;
          
         }
          return json_encode($result);
           
         }

public function guestUser(Request $request){
  $data['device_token']=$request->device_token;
  $data['userid']=$request->userid;
  $userdataCount = DB::table('tb_users')->where('id', $data['userid'])->count();
  
  if($userdataCount!=0){
    $affected = DB::table('tb_users')
    ->where('id', $data['userid'])
    ->update(['first_name' => '','last_name'=>'','email'=>'', 'password' => '','phone'=>'', 'dob' => '','gender'=>'','device_token' => $data['device_token'], 'country' => '','country_code'=>'','profile_pic'=>'']);
    $userdetails = DB::table('tb_users')->where('device_token', $data['device_token'])->first();



    $details=array("id"=>(int)$userdetails->id,
                           "first_name"=>($userdetails->first_name==null) ? "" : $userdetails->first_name,
                            "last_name"=>($userdetails->last_name==null) ? "" : $userdetails->last_name,
                            "email"=>($userdetails->email==null) ? "" : $userdetails->email,
                            "password"=>(base64_decode($userdetails->password)==null) ? "" : base64_decode($userdetails->password),
                            "phone"=>($userdetails->phone==null) ? "" : $userdetails->phone,
                             "dob"=>($userdetails->dob==null) ? "" : $userdetails->dob,
                             "gender"=>($userdetails->gender==null) ? "" : $userdetails->gender,
                             "profile_pic"=>($userdetails->profile_pic==null)? "" : '' ,
                             "created_at"=>($userdetails->created_at==null) ? "" : $userdetails->created_at,
                             "updated_at"=>($userdetails->updated_at==null) ? "" : $userdetails->updated_at,
                             "device_token"=>($userdetails->device_token==null) ? "" : $userdetails->device_token ,
                              "country"=>($userdetails->country==null) ? "" : $userdetails->country,
                              "country_code"=>($userdetails->country_code==null) ? "" : $userdetails->country_code,
                              "userstatus"=>'guest',
                              "email_verification"=>($userdetails->email_verification==null) ? "" :(bool)$userdetails->email_verification);
      
      
      // print_r($details);die();
        //  $otp=rand ( 1000 , 9999 );
            $result['status'] = true;
            $result['message'] = 'Registration Successfull';
           
            $result['user_details'] =$details;
  }
  else{
  $id = DB::table('tb_users')->insertGetId(
        ['first_name' => '', 'last_name' => '', 'email' => '', 'password' => '', 'phone' => '', 'dob' => '', 'gender' => '', 'device_token' => $data['device_token'], 'country' => '','country_code'=>'','profile_pic'=>'']
      );

     $userdetails = DB::table('tb_users')->where('id', $id)->first();


      $details=array("id"=>(int)$userdetails->id,
                           "first_name"=>($userdetails->first_name==null) ? "" : $userdetails->first_name,
                            "last_name"=>($userdetails->last_name==null) ? "" : $userdetails->last_name,
                            "email"=>($userdetails->email==null) ? "" : $userdetails->email,
                            "password"=>(base64_decode($userdetails->password)==null) ? "" : base64_decode($userdetails->password),
                            "phone"=>($userdetails->phone==null) ? "" : $userdetails->phone,
                             "dob"=>($userdetails->dob==null) ? "" : $userdetails->dob,
                             "gender"=>($userdetails->gender==null) ? "" : $userdetails->gender,
                             "profile_pic"=>($userdetails->profile_pic==null)? "" : '',
                             "created_at"=>($userdetails->created_at==null) ? "" : $userdetails->created_at,
                             "updated_at"=>($userdetails->updated_at==null) ? "" : $userdetails->updated_at,
                             "device_token"=>($userdetails->device_token==null) ? "" : $userdetails->device_token ,
                              "country"=>($userdetails->country==null) ? "" : $userdetails->country,
                              "country_code"=>($userdetails->country_code==null) ? "" : $userdetails->country_code,
                               "userstatus"=>'guest',
                              "email_verification"=>($userdetails->email_verification==null) ? "" :(bool)$userdetails->email_verification);
      
      
      // print_r($details);die();
        //  $otp=rand ( 1000 , 9999 );
            $result['status'] = true;
            $result['message'] = 'Registration Successfull';
           
            $result['user_details'] =$details;
    }
       
          
          return json_encode($result);

}







  public function resetPassword(Request $request){
  $data['email']=$request->email;
        $data['password']=base64_encode($request->new_password);
        $data['type']=$request->type;
        if($data['type']=='user')
        {
          $affected = DB::table('tb_users')
              ->where('email', $request->email)
              ->update(['password' => base64_encode($request->new_password)]);
              if(!$affected){
                $result['status']=false;
            $result['message']='This password is your old password.Please Enter new one.';
           // $result['user_details']=$data;
              }
              else{
        
//$this->sendEmail($request->email);
                $result['status']=true;
            $result['message']='Successfully Reset the password';
           // $result['user_details']=$data;
              }
            }
            else if($data['type']=='owner')
        {
           $affected = DB::table('tb_owner')
              ->where('email', $request->email)
              ->update(['password' => base64_encode($request->new_password)]);
              if(!$affected){
                $result['status']=false;
            $result['message']='This password is your old password.Please Enter new one.';
           // $result['user_details']=$data;
              }
              else{
        
//$this->sendEmail($request->email);
                $result['status']=true;
            $result['message']='Successfully Reset the password';
           // $result['user_details']=$data;
              }

        }
              return json_encode($result);


}
public function sendOtpEmail(Request $request){

 $data['email']=$request->email;
 $email=$request->email;
 $users = DB::table('tb_users')->where('email', $request->email)->first();
if($users!=""){
 $otp=rand ( 1000 , 9999 );
     $data = array('content' => $otp);
            Mail::send('mail', $data, function ($message) use($email)  {
                $message->to($email)->subject('Reset Password');
               // $message->from('varshag.srishti@gmail.com', 'The Stock');
            });
             $result['status']=true;
              $result['message']='Successfully Resend OTP';
              $result['otp']=$otp;
            }
            else{
              $result['status']=false;
              $result['message']='Failed';
              $result['otp']="";
            }

 return json_encode($result);




}
public function emailVerification(Request $request){
   $data['id']=$request->userid;
    $affected = DB::table('tb_users')
              ->where('id', $request->userid)
              ->update(['email_verification' => 1]);
              if(!$affected){
                $result['status']=false;
            $result['message']='Failed';
           // $result['user_details']=$data;
              }
              else{
//$this->sendEmail($request->email);
                $result['status']=true;
            $result['message']='Email Verification Success';
           // $result['user_details']=$data;
              }
              return json_encode($result);


}


public function editProfile(Request $request){
  $data['first_name']=$request->first_name;
  $data['last_name']=$request->last_name;
  $data['email']=$request->email;
  $data['phone'] =$request->phone;
  $data['gender']=$request->gender;
  $data['id']=$request->id;
  $data['country_code']=$request->country_code;
  $data['country']=$request->country;
$data['type']=$request->type;
if($data['type']=='user'){
   if ($request->hasFile('image')) {
                $pfileimg = $request->image;
                $pextension = $pfileimg->getClientOriginalExtension();
                //echo $pextension;
                $pname = time() . rand(11111, 99999) . '.' . $pextension;
                $pfileimg->move('uploads/profile_pic', $pname);
                $profile_pic = $pname;
                //echo $profile_pic;die();
            } else {

              $userdata = DB::table('tb_users')->where('id', $request->id)->first();
                $profile_pic = $userdata->profile_pic;
                //echo $profile_pic;die();
            }
   $affected = DB::table('tb_users')
              ->where('id', $request->id)
              ->update(['first_name' => $request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'phone'=>$request->phone,'gender'=>$request->gender,'country_code'=>$request->country_code,'profile_pic'=>$profile_pic,'country'=>$request->country]);
               $userdata = DB::table('tb_users')->where('id', $request->id)->first();
           $user=array("id"=>(int)$userdata->id,
                       "first_name"=>($userdata->first_name==null) ? "" : $userdata->first_name,
                        "last_name"=>($userdata->last_name==null) ? "" : $userdata->last_name,
                         "email"=>($userdata->email==null) ? "" : $userdata->email,
                          "password"=>($userdata->password==null) ? "" :base64_decode($userdata->password),
                           "phone"=>($userdata->phone==null) ? "" : $userdata->phone,
                            "dob"=>($userdata->dob==null) ?"" : $userdata->dob,
                            "gender"=>($userdata->gender==null) ? "" : $userdata->gender,
                            "profile_pic"=>($userdata->profile_pic==null)?"": 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdata->profile_pic,
                            "created_at"=>($userdata->created_at==null) ? "" : $userdata->created_at,
                            "updated_at"=>($userdata->updated_at==null) ? "" : $userdata->updated_at,
                            "device_token"=>($userdata->device_token==null) ? "" : $userdata->device_token,
                            "country"=>($userdata->country==null) ? "" : $userdata->country,
                            'country_code'=>($userdata->country_code==null) ? "" :$userdata->country_code,
                            "email_verification"=>($userdata->email_verification==null) ? "" : (bool)$userdata->email_verification);
         }
         else if($data['type']=='owner'){
          if ($request->hasFile('image')) {
                $pfileimg = $request->image;
                $pextension = $pfileimg->getClientOriginalExtension();
                $pname = time() . rand(11111, 99999) . '.' . $pextension;
                $pfileimg->move('uploads/profile_pic', $pname);
                $profile_pic = $pname;
            } else {

              $userdata = DB::table('tb_owner')->where('id', $request->id)->first();
                $profile_pic = $userdata->profile_pic;
            }
   $affected = DB::table('tb_owner')
              ->where('id', $request->id)
              ->update(['first_name' => $request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'phone'=>$request->phone,'gender'=>$request->gender,'profile_pic'=>$profile_pic,'country'=>$request->country]);
               $userdata = DB::table('tb_owner')->where('id', $request->id)->first();
               $user=array("id"=>(int)$userdata->id,
                           "first_name"=>($userdata->first_name==null)? "" : $userdata->first_name,
                            "last_name"=>($userdata->last_name==null) ? "" : $userdata->last_name,
                            "email"=>($userdata->email==null) ? "" : $userdata->email,
                            "password"=>($userdata->password==null) ? "" :base64_decode($userdata->password),
                             "phone"=>($userdata->phone==null) ? "" : $userdata->phone,
                             "gender"=>($userdata->gender==null) ? "" : $userdata->gender,
                             "profile_pic"=>($userdata->profile_pic==null)? "" : 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdata->profile_pic,
                              "country"=>($userdata->country==null) ? "" : $userdata->country,
                              'country_code'=>"",
                              "civil_id"=>($userdata->civil_id==null) ? "" : $userdata->civil_id,
                               "chalet_ownership"=>($userdata->chalet_ownership==null) ? "" : $userdata->chalet_ownership,
                               "agreement"=>($userdata->agreement==null) ? "" : $userdata->agreement,
                               "bank_holder_name"=>($userdata->bank_holder_name==null) ? "" : $userdata->bank_holder_name,
                               "bank_name"=>($userdata->bank_name==null) ? "" : $userdata->bank_name,
                               "iban_num"=>($userdata->iban_num==null) ? "" : $userdata->iban_num,

                             "created_at"=>($userdata->created_at==null) ? "" : $userdata->created_at,
                             "updated_at"=>($userdata->updated_at == null) ? "" : $userdata->updated_at,
                             "device_token"=>($userdata->device_token==null) ? "" : $userdata->device_token,
                           "userstatus"=>'owner');

         }
          // $otp=rand ( 10000 , 99999 );
    $result['status']=true;
            $result['message']='Profile Updated Successfully';
        
         $result['user_details']=$user;
            return json_encode($result);



}



public function adminmail(Request $request){
  // echo 'Hia';die();

  $data['phone']=$request->phone;
  $data['name']=$request->name;
  $data['message']=$request->message;
  $email="admin@6rb.net";
   $data = array('name' => $request->name,'phone'=>$request->phone,'message'=>$request->message);
            

  Mail::send('mailadmin', $data, function ($message) use($email) {
                $message->to($email)->subject('Message');
               // $message->from('varshag.srishti@gmail.com', 'The Stock');
            });
}






public function view_profile(Request $request){
  $data['userid']=$request->userid;
  $data['type']=$request->type;
  if($data['type']=='user'){

       $userdetails = DB::table('tb_users')->where('id', $request->userid)->first();
       $details=array("id"=>(int)$userdetails->id,
                           "first_name"=>($userdetails->first_name==null) ? "" : $userdetails->first_name,
                            "last_name"=>($userdetails->last_name==null) ? "" : $userdetails->last_name,
                            "email"=>($userdetails->email==null) ? "" : $userdetails->email,
                            "password"=>(base64_decode($userdetails->password)==null) ? "" : base64_decode($userdetails->password),
                            "phone"=>($userdetails->phone==null) ? "" : $userdetails->phone,
                             "dob"=>($userdetails->dob==null) ? "" : $userdetails->dob,
                             "gender"=>($userdetails->gender==null) ? "" : $userdetails->gender,
                             "profile_pic"=>($userdetails->profile_pic==null)? "" : 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdetails->profile_pic,
                             "country"=>($userdetails->country==null) ? "" : $userdetails->country,
                             "created_at"=>($userdetails->created_at==null) ? "" : $userdetails->created_at,
                             "updated_at"=>($userdetails->updated_at==null) ? "" : $userdetails->updated_at,
                             "device_token"=>($userdetails->device_token==null) ? "" : $userdetails->device_token ,
                              "country"=>($userdetails->country==null) ? "" : $userdetails->country,
                              "country_code"=>($userdetails->country_code==null) ? "" : $userdetails->country_code,
                              "email_verification"=>($userdetails->email_verification==null) ? "" : (bool)$userdetails->email_verification);
        $result['status']=true;
            $result['message']='User Details';
          
            $result['user_details']=$details;
          }
          else  if($data['type']=='owner'){
             $userdetails = DB::table('tb_owner')->where('id', $request->userid)->first();

            $details[]=array("id"=>(int)$userdetails->id,
                           "first_name"=>($userdetails->first_name==null)? "" : $userdetails->first_name,
                            "last_name"=>($userdetails->last_name==null) ? "" : $userdetails->last_name,
                            "email"=>($userdetails->email==null) ? "" : $userdetails->email,
                            "password"=>($userdetails->password==null) ? "" :base64_decode($userdetails->password),
                             "phone"=>($userdetails->phone==null) ? "" : $userdetails->phone,
                             "gender"=>($userdetails->gender==null) ? "" : $userdetails->gender,
                             "profile_pic"=>($userdetails->profile_pic==null)? "" : 'https://sicsapp.com/Aby_chalet/uploads/profile_pic/' . $userdetails->profile_pic,
                              "country"=>($userdetails->country==null) ? "" : $userdetails->country,
                              "civil_id"=>($userdetails->civil_id==null) ? "" : $userdetails->civil_id,
                               "chalet_ownership"=>($userdetails->chalet_ownership==null) ? "" : $userdetails->chalet_ownership,
                               "agreement"=>($userdetails->agreement==null) ? "" : $userdetails->agreement,
                               "bank_holder_name"=>($userdetails->bank_holder_name==null) ? "" : $userdetails->bank_holder_name,
                               "bank_name"=>($userdetails->bank_name==null) ? "" : $userdetails->bank_name,
                               "iban_num"=>($userdetails->iban_num==null) ? "" : $userdetails->iban_num,

                             "created_at"=>($userdetails->created_at==null) ? "" : $userdetails->created_at,
                             "updated_at"=>($userdetails->updated_at == null) ? "" : $userdetails->updated_at,
                             "device_token"=>($userdetails->device_token==null) ? "" : $userdetails->device_token,
                           "userstatus"=>'owner');
 $result['status']=true;
            $result['message']='Owner Details';
          
            $result['user_details']=$details;

          }


       return json_encode($result);
              


}

    }
?>
