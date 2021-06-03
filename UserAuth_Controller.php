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

     if ($request->hasFile('image')) {
                $pfileimg = $request->image;
                $pextension = $pfileimg->getClientOriginalExtension();
                $pname = time() . rand(11111, 99999) . '.' . $pextension;
                $pfileimg->move('uploads/profile_pic', $pname);
                $profile_pic = $pname;
            } else {
                $profile_pic = "";
            }
    $users = DB::table('tb_users')->where('email', $request->email)->where('email_verification', '=','1')->first();
    if ($users != "") {

      $result['status'] = false;
      $result['message'] = 'You have already registered to this application. Try Login';
      //$result['user_details']=$users;

    }
    // DB::table('users')->insert($data);
    else {
      $date=date("Y-m-d", strtotime($data['dob']));
      $id = DB::table('tb_users')->insertGetId(
        ['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'password' => $data['password'], 'phone' => $data['phone'], 'dob' => $date, 'gender' => $data['gender'], 'device_token' => $data['device_token'], 'country' => $data['country'],'country_code'=>$data['country_code'],'profile_pic'=>$profile_pic]
      );
      $userdata = DB::table('tb_users')->where('id', $id)->first();


$details=array("id"=>$userdata->id,
                           "first_name"=>($userdata->first_name==null) ? "" : $userdata->first_name,
                            "last_name"=>($userdata->last_name==null) ? "" : $userdata->last_name,
                            "email"=>($userdata->email==null) ? "" : $userdata->email,
                            "password"=>(base64_decode($userdata->password)==null) ? "" : base64_decode($userdata->password),
                            "phone"=>($userdata->phone==null) ? "" : $userdata->phone,
                             "dob"=>($userdata->dob==null) ? "" : $userdata->dob,
                             "gender"=>($userdata->gender==null) ? "" : $userdata->gender,
                             "profile_pic"=>($userdata->profile_pic==null)?"": 'https://web.sicsglobal.com/aby_chalet/uploads/profile_pic/' . $userdata->profile_pic,
                             "created_at"=>($userdata->created_at==null) ? "" : $userdata->created_at,
                             "updated_at"=>($userdata->updated_at==null) ? "" : $userdata->updated_at,
                             "device_token"=>($userdata->device_token==null) ? "" : $userdata->device_token ,
                              "country"=>($userdata->country==null) ? "" : $userdata->country,
                              "country_code"=>($userdata->country_code==null) ?"" : $userdata->country_code,
                              "email_verification"=> $userdata->email_verification);


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
    $count = DB::table('tb_users')->where('email', $request->email)->where('password', base64_encode($request->password))->count();
          $count1 = DB::table('tb_owner')->where('email', $request->email)->where('password', base64_encode($request->password))->count();
      
         if ($count==1) {
             $userdetails1 = DB::table('tb_users')->where('email', $request->email)->where('password', base64_encode($request->password))->first();
          $veri=$userdetails1->email_verification;

if($veri==1){
            $token['device_token']=$request->device_token;
            $affected = DB::table('tb_users')
              ->where('email', $request->email)
              ->update(['device_token' => $request->device_token]);
               $userdetails = DB::table('tb_users')->where('email', $request->email)->where('password', base64_encode($request->password))->first();
              $details=array("id"=>$userdetails->id,
                           "first_name"=>($userdetails->first_name==null) ? "" : $userdetails->first_name,
                            "last_name"=>($userdetails->last_name==null) ? "" : $userdetails->last_name,
                            "email"=>($userdetails->email==null) ? "" : $userdetails->email,
                            "password"=>(base64_decode($userdetails->password)==null) ? "" : base64_decode($userdetails->password),
                            "phone"=>($userdetails->phone==null) ? "" : $userdetails->phone,
                             "dob"=>($userdetails->dob==null) ? "" : $userdetails->dob,
                             "gender"=>($userdetails->gender==null) ? "" : $userdetails->gender,
                             "profile_pic"=>($userdetails->profile_pic==null)? "" : 'https://web.sicsglobal.com/aby_chalet/uploads/profile_pic/' . $userdetails->profile_pic,
                             "created_at"=>($userdetails->created_at==null) ? "" : $userdetails->created_at,
                             "updated_at"=>($userdetails->updated_at==null) ? "" : $userdetails->updated_at,
                             "device_token"=>($userdetails->device_token==null) ? "" : $userdetails->device_token ,
                              "country"=>($userdetails->country==null) ? "" : $userdetails->country,
                              "country_code"=>($userdetails->country_code==null) ? "" : $userdetails->country_code,
                              "email_verification"=>($userdetails->email_verification==null) ? "" : $userdetails->email_verification);
            
            $result['status']=true;
            $result['message']='Successfully Logged In';
             $result['userstatus']='';
            $result['user_details']=$details;
          }
          else{
              $result['status']=false;
            $result['message']='Invalid Credentails';
            $result['userstatus']='';
          $result['user_details']=$data;
          
         }
          }
          else if($count1==1){
              $token['device_token']=$request->device_token;
            $affected = DB::table('tb_owner')
              ->where('email', $request->email)
              ->update(['device_token' => $request->device_token]);
               $userdetails = DB::table('tb_owner')->where('email', $request->email)->where('password', base64_encode($request->password))->first();
               $details=array("id"=>$userdetails->id,
                           "first_name"=>($userdetails->first_name==null)? "" : $userdetails->first_name,
                            "last_name"=>($userdetails->last_name==null) ? "" : $userdetails->last_name,
                            "email"=>($userdetails->email==null) ? "" : $userdetails->email,
                            "password"=>($userdetails->password==null) ? "" :base64_decode($userdetails->password),
                             "phone"=>($userdetails->phone==null) ? "" : $userdetails->phone,
                             "gender"=>($userdetails->gender==null) ? "" : $userdetails->gender,
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
                             "userstatus"=>'owner'
                             
                           );
            
            $result['status']=true;
            $result['message']='Successfully Logged In';
             $result['userstatus']='owner';
            $result['user_details']=$details;

          }
          else {
            $result['status']=false;
            $result['message']='Invalid Credentails';
            $result['userstatus']='';
          $result['user_details']=$data;
          
         }
          return json_encode($result);
           
         }
  public function resetPassword(Request $request){
  $data['email']=$request->email;
        $data['password']=base64_encode($request->new_password);
          $affected = DB::table('tb_users')
              ->where('email', $request->email)
              ->update(['password' => base64_encode($request->new_password)]);
              if(!$affected){
                $result['status']=false;
            $result['message']='Failed';
           // $result['user_details']=$data;
              }
              else{
//$this->sendEmail($request->email);
                $result['status']=true;
            $result['message']='Successfully Reset the password';
           // $result['user_details']=$data;
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

   if ($request->hasFile('image')) {
                $pfileimg = $request->image;
                $pextension = $pfileimg->getClientOriginalExtension();
                $pname = time() . rand(11111, 99999) . '.' . $pextension;
                $pfileimg->move('uploads/profile_pic', $pname);
                $profile_pic = $pname;
            } else {

              $userdata = DB::table('tb_users')->where('id', $request->id)->first();
                $profile_pic = $userdata->profile_pic;
            }
   $affected = DB::table('tb_users')
              ->where('id', $request->id)
              ->update(['first_name' => $request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'phone'=>$request->phone,'gender'=>$request->gender,'country_code'=>$request->country_code,'profile_pic'=>$profile_pic]);
               $userdata = DB::table('tb_users')->where('id', $request->id)->first();
           $user=array("id"=>$userdata->id,
                       "first_name"=>($userdata->first_name==null) ? "" : $userdata->first_name,
                        "last_name"=>($userdata->last_name==null) ? "" : $userdata->last_name,
                         "email"=>($userdata->email==null) ? "" : $userdata->email,
                          "password"=>($userdata->password==null) ? "" :base64_decode($userdata->password),
                           "phone"=>($userdata->phone==null) ? "" : $userdata->phone,
                            "dob"=>($userdata->dob==null) ?"" : $userdata->dob,
                            "gender"=>($userdata->gender==null) ? "" : $userdata->gender,
                            "profile_pic"=>($userdata->profile_pic==null)?"": 'https://web.sicsglobal.com/aby_chalet/uploads/profile_pic/' . $userdata->profile_pic,
                            "created_at"=>($userdata->created_at==null) ? "" : $userdata->created_at,
                            "updated_at"=>($userdata->updated_at==null) ? "" : $userdata->updated_at,
                            "device_token"=>($userdata->device_token==null) ? "" : $userdata->device_token,
                            "country"=>($userdata->country==null) ? "" : $userdata->country,
                            'country_code'=>($userdata->country_code==null) ? "" :$userdata->country_code,
                            "email_verification"=>($userdata->email_verification==null) ? "" : $userdata->email_verification);
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
  $email="athirasurendran.sics@gmail.com";
   $data = array('name' => $request->name,'phone'=>$request->phone,'message'=>$request->message);
            

  Mail::send('mailadmin', $data, function ($message) use($email) {
                $message->to($email)->subject('Message');
               // $message->from('varshag.srishti@gmail.com', 'The Stock');
            });
}



    }
?>
