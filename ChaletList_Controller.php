<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class ChaletList_Controller extends Controller
{

  public function chalet_list(Request $request)
  {
    $chalet = DB::table('tb_owner')
      ->Join('tb_chalet', 'tb_owner.id', '=', 'tb_chalet.ownerid')
       ->where('tb_chalet.is_activestatus','=',1)
      ->get();
    //print_r($chalet);
    $cha = array();
    foreach ($chalet as $chaletlist) {
      $result1 = DB::table('tb_chaletdetails')->where('chaletid', $chaletlist->id)->where('ownerid', $chaletlist->ownerid)->get();
      // print_r($result1);die();
      $cha = array();
      foreach ($result1 as $chaletlist1) {
        $cha[] = array(
          'id' => ($chaletlist1->id == null) ? 0 : (int)$chaletlist1->id,
          'chalet_details' => ($chaletlist1->chalet_detail == null) ? "" : $chaletlist1->chalet_detail
        );
      }
      $cha1 = array();
      // print_r($cha);die();
      $result2 = DB::table('tb_chaletupload')->where('chaletid', $chaletlist->id)->where('ownerid', $chaletlist->ownerid)->get();

      foreach ($result2 as $chaletlist2) {
        if ($chaletlist2->file_name == "") {
          $cha1[] = array(
            'id' => ($chaletlist2->id == null) ? 0 : (int)$chaletlist2->id,
            'chalet_id' => ($chaletlist2->chaletid == null) ? 0 : (int)$chaletlist2->chaletid,
            'file_name' => ''
          );
        } else {
          $cha1[] = array(
            'id' => ($chaletlist2->id == null) ? 0 : (int)$chaletlist2->id,
            'chalet_id' => ($chaletlist2->chaletid == null) ? 0 : (int)$chaletlist2->chaletid,
            'file_name' => 'https://sicsapp.com/Aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
          );
        }
      }
      // print_r($cha1);die();
      $chalet1 = DB::table('tb_superadmin')->where('id', 1)->first();
      $min_deposit = ($chalet1->deposit == null) ? "" : $chalet1->deposit;
      $available_deposit = ($chalet1->deposit_available == null) ? "" : $chalet1->deposit_available;
      $remaining_amt_pay = ($chalet1->remaining_amt_pay == null) ? "" : $chalet1->remaining_amt_pay;
      $offer_expiry = ($chalet1->offer_expiry == null) ? "" : $chalet1->offer_expiry;



      $result[] = array(
        'chalet_id' => ($chaletlist->id == null) ? 0 : (int)$chaletlist->id,
        'owner_id' => ($chaletlist->ownerid == null) ? 0 : (int)$chaletlist->ownerid,
        'firstname' => ($chaletlist->first_name == null) ? "" : $chaletlist->first_name,
        'lastname' => ($chaletlist->last_name == null) ? "" : $chaletlist->last_name,
        'email' => ($chaletlist->email == null) ? "" : $chaletlist->email,
        'password' => ($chaletlist->password == null) ? "" : $chaletlist->password,
        'country' => ($chaletlist->country == null) ? "" : $chaletlist->country,
        'phone' => ($chaletlist->phone == null) ? "" : $chaletlist->phone,
        'gender' => ($chaletlist->gender == null) ? "" : $chaletlist->gender,
        'profile_pic' => ($chaletlist->profile_pic == null) ? "" : "https://sicsapp.com/Aby_chalet/uploads/profile_pic/" . $chaletlist->profile_pic,
        'civil_id' => ($chaletlist->civil_id == null) ? "" : $chaletlist->civil_id,
        'chalet_ownership' => ($chaletlist->chalet_ownership == null) ? "" : $chaletlist->chalet_ownership,
        'bank_holder_name' => ($chaletlist->bank_holder_name == null) ? "" : $chaletlist->bank_holder_name,
        'bank_name' => ($chaletlist->bank_name == null) ? "" : $chaletlist->bank_name,
        'iban_num' => ($chaletlist->iban_num == null) ? "" : $chaletlist->iban_num,
        'min_deposit' => $min_deposit,
        'available_deposit' => $available_deposit,
        'remaining_amt_pay' => $remaining_amt_pay,
        'offer_expiry' => $offer_expiry,
        'chalet_details' => $cha,
        'chalet_upload' => $cha1,
        'created_at' => ($chaletlist->created_at == null) ? "" : $chaletlist->created_at,
        'updated_at' => ($chaletlist->updated_at == null) ? "" : $chaletlist->updated_at
      );
    }
    $post = array(
      'status' => true,
      'message' => 'Chalet List', 'user_details' => $result
    );
    return json_encode($post);
  }


 public function searchChaletList(Request $request)
  {
    $data['from_date'] = $request->from_date;
    $data['to_date'] = $request->to_date;
    $data['package'] = $request->package;
     $data['userid']=$request->userid;

    $chaid = "";
    $result=array();
  //date_default_timezone_set('Asia/Kolkata');
$fromYear=date("Y", strtotime($request->from_date));

$fromdate1=date("d/m", strtotime($request->from_date));

$todate1=date("d/m", strtotime($request->to_date));
$currentYear= date('Y');





    // print_r($chalet2);die();
    $cha = array();
    $cha1 = array();

    
$reward_amt=0;
    $rewardcount= DB::table('tb_rewards')->where('userid', $request->userid)->count();
    if($rewardcount!=0){
   $reward= DB::table('tb_rewards')->where('userid', $request->userid)->first();
$reward_amt=$reward->rewarded_amt;
if($reward_amt==""){
  $reward_amt=0;
}
else{
  $reward_amt=$reward_amt;
}
    }
$chaletCount=DB::table('tb_owner')
      ->Join('tb_chalet', 'tb_owner.id', '=', 'tb_chalet.ownerid')
      
      ->where('tb_chalet.is_activestatus','=',1)
      ->count();
      if($chaletCount!=0){

    $chalet = DB::table('tb_owner')
      ->Join('tb_chalet', 'tb_owner.id', '=', 'tb_chalet.ownerid')
      
      ->where('tb_chalet.is_activestatus','=',1)
      ->get();
    //print_r($chalet);die();

    $chalet1 = DB::table('tb_superadmin')->where('id', 1)->first();
    $check_in = ($chalet1->check_in == null) ? "" : $chalet1->check_in;
    $check_out = ($chalet1->check_out == null) ? "" : $chalet1->check_out;
    $min_deposit = ($chalet1->deposit == null) ? "" : $chalet1->deposit;
    $available_deposit = ($chalet1->deposit_available == null) ? "" : $chalet1->deposit_available;
    $remaining_amt_pay = ($chalet1->remaining_amt_pay == null) ? "" : $chalet1->remaining_amt_pay;
    $offer_expiry = ($chalet1->offer_expiry == null) ? "" : $chalet1->offer_expiry;
    $i = 1;
    //print_r($chalet);

    foreach ($chalet as $chaletlist) {
      $id = $chaletlist->id;

      $owner = $chaletlist->ownerid;
      $season_status=$chaletlist->season_status;


$season1 = DB::table('tb_seasondates')->count();
if($fromYear==$currentYear){
if($season1>0){
$season = DB::table('tb_seasondates')->first();
$season_start=$season->season_start;
$season_end=$season->season_end;



$date=$season_start.'/'.$currentYear;

$orderdate = explode('/', $date);
 $month  = $orderdate[1];
 $day= $orderdate[0];
$year  = $orderdate[2];
$date1=$season_end.'/'.$currentYear;

$orderdate1 = explode('/', $date1);
 $month1  = $orderdate1[1];
 $day1= $orderdate1[0];
$year1  = $orderdate1[2];


$start=date("Y/m/d", strtotime($year.'/'.$month.'/'.$day));
//echo $start;

$from=date("Y/m/d", strtotime($request->from_date));
$end=date("Y/m/d", strtotime($year1.'/'.$month1.'/'.$day1));
$to=date("Y/m/d", strtotime($request->to_date));


if(($start <=$from)&&($end>=$to)&&($season_status==1)){
  if ($data['package'] == 'weekdays') {
     
if($chaletlist->weekdays_seasonprice == null) {
$rent = 'weekday_rent';
}
else{
   $rent = 'weekdays_seasonprice';
}

    } else if ($data['package'] == 'weekend') {
      if($chaletlist->weekend_seasonprice == null) {
$rent = 'weekend_rent';
}
else{
   $rent = 'weekend_seasonprice';
}


     
    } else if ($data['package'] == 'weekA' || $data['package'] == 'weekB') {

       if($chaletlist->week_seasonprice == null) {
$rent = 'week_rent';
}
else{
   $rent = 'week_seasonprice';
}
     
    }

}
else{

    if ($data['package'] == 'weekdays') {
      $rent = 'weekday_rent';
    } else if ($data['package'] == 'weekend') {
      $rent = 'weekend_rent';
    } else if ($data['package'] == 'weekA' || $data['package'] == 'weekB') {
      $rent = 'week_rent';
    }
  }

}
else{

    if ($data['package'] == 'weekdays') {
      $rent = 'weekday_rent';
    } else if ($data['package'] == 'weekend') {
      $rent = 'weekend_rent';
    } else if ($data['package'] == 'weekA' || $data['package'] == 'weekB') {
      $rent = 'week_rent';
    }
  }
}

else{

    if ($data['package'] == 'weekdays') {
      $rent = 'weekday_rent';
    } else if ($data['package'] == 'weekend') {
      $rent = 'weekend_rent';
    } else if ($data['package'] == 'weekA' || $data['package'] == 'weekB') {
      $rent = 'week_rent';
    }
  }




      

      $result1 = DB::table('tb_chaletdetails')->where('chaletid', $id)->where('ownerid', $chaletlist->ownerid)->get();
      $cha = array();
      // print_r($result1);die();
      foreach ($result1 as $chaletlist1) {
        $cha[] = array(
          'id' => (int)$chaletlist1->id,
          'chalet_details' => $chaletlist1->chalet_detail
        );
      }
      // print_r($cha);die();
      $cha1 = array();
      $result2 = DB::table('tb_chaletupload')->where('chaletid', $id)->where('ownerid', $chaletlist->ownerid)->get();

      foreach ($result2 as $chaletlist2) {
        if ($chaletlist2->file_name == "") {
          $cha1[] = array(
            'id' => (int)$chaletlist2->id,
            'file_name' => ''
          );
        } else {
          $cha1[] = array(
            'id' => (int)$chaletlist2->id,
            'chalet_id' => (int)$chaletlist2->chaletid,
            'file_name' => 'https://sicsapp.com/Aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
          );
        }
      }

// echo "chaletid=>".$chaletlist->id;
      $result3 = DB::table('tb_chaletupload')->where('chaletid', $chaletlist->id)->where('file_type', 'image')->orderBy('id', 'ASC')->first();


      $cover = $result3->file_name;
      
      // echo "coverphoto=>".$result3->file_name;
      $cover_photo = 'https://sicsapp.com/Aby_chalet/uploads/chalet_uploads/chalet_images/' . $cover;
     

$chalet2Count = DB::table('tb_reservation')->where('check_in', $request->from_date)->where('check_out', $request->to_date)->where('chaletid',$chaletlist->id)->count();

if($chalet2Count==0){

   //echo 'Hai';

      $result[] = array(
        'slno' => $i++,
        'chalet_id' => (int)$chaletlist->id,
        'chalet_name' => ($chaletlist->chalet_name == null) ? "" : $chaletlist->chalet_name,
        'cover_photo' => $cover_photo,
        'check_in' => $request->from_date,
        'check_out' => $request->to_date,
        'rent' => ($chaletlist->$rent == null) ? "" : $chaletlist->$rent,
        'admincheck_in' => $check_in,
        'admincheck_out' => $check_out,
        'owner_id' => ($chaletlist->ownerid == null) ? "" : (int)$chaletlist->ownerid,
        'firstname' => ($chaletlist->first_name == null) ? "" : $chaletlist->first_name,
        'lastname' => ($chaletlist->last_name == null) ? "" : $chaletlist->last_name,
        'email' => ($chaletlist->email == null) ? "" : $chaletlist->email,
        'password' => ($chaletlist->password == null) ? "" : $chaletlist->password,
        'country' => ($chaletlist->country == null) ? "" : $chaletlist->country,
        'phone' => ($chaletlist->phone == null) ? "" : $chaletlist->phone,
        'gender' => ($chaletlist->gender == null) ? "" : $chaletlist->gender,
        'profile_pic' => ($chaletlist->profile_pic == null) ? "" : "https://web.sicsglobal.com/aby_chalet/uploads/profile_pic/" . $chaletlist->profile_pic,
        'civil_id' => ($chaletlist->civil_id == null) ? "" : $chaletlist->civil_id,
        'chalet_ownership' => ($chaletlist->chalet_ownership == null) ? "" : $chaletlist->chalet_ownership,
        'bank_holder_name' => ($chaletlist->bank_holder_name == null) ? "" : $chaletlist->bank_holder_name,
        'bank_name' => ($chaletlist->bank_name == null) ? "" : $chaletlist->bank_name,
        'iban_num' => ($chaletlist->iban_num == null) ? "" : $chaletlist->iban_num,
        'min_deposit' => $min_deposit,
        'available_deposit' => $available_deposit,
        'remaining_amt_pay' => $remaining_amt_pay,
        'offer_expiry' => $offer_expiry,
        'rewarded_amt'=>(int)$reward_amt,
        'chalet_details' => $cha,
        'chalet_upload' => $cha1,
        'created_at' => ($chaletlist->created_at == null) ? "" : $chaletlist->created_at,
        'updated_at' => ($chaletlist->updated_at == null) ? "" : $chaletlist->updated_at

      );
    
  

}



    
  }
  $post = array(
      'status' => true,
      'message' => 'Chalet List', 'user_details' => $result
    );
}
  
    
    return json_encode($post);
  }



  public function searchHolidays(Request $request)
  {

$result1Count = DB::table('tb_holidayandevents')

      ->leftJoin('tb_chaletevents', 'tb_holidayandevents.id', '=', 'tb_chaletevents.event_id')

      ->select('*','tb_holidayandevents.id as hid')

      ->where('tb_holidayandevents.holiday_status', 1)

     ->groupBy('tb_holidayandevents.event_name')

      ->count();
      if($result1Count!=0){

    $result1 = DB::table('tb_holidayandevents')
      ->leftJoin('tb_chaletevents', 'tb_holidayandevents.id', '=', 'tb_chaletevents.event_id')
      ->select('*','tb_holidayandevents.id as hid')
      ->where('tb_holidayandevents.holiday_status', 1)
     ->groupBy('tb_holidayandevents.event_name')
      ->get();

      //print_r($result1);

        $chalet1 = DB::table('tb_superadmin')->where('id', 1)->first();
        $check_in = ($chalet1->check_in == null) ? "" : $chalet1->check_in;
        $check_out = ($chalet1->check_out == null) ? "" : $chalet1->check_out;
        $min_deposit = ($chalet1->deposit == null) ? "" : $chalet1->deposit;
        $available_deposit = ($chalet1->deposit_available == null) ? "" : $chalet1->deposit_available;
        $remaining_amt_pay = ($chalet1->remaining_amt_pay == null) ? "" : $chalet1->remaining_amt_pay;
        $offer_expiry = ($chalet1->offer_expiry == null) ? "" : $chalet1->offer_expiry;
       
$holi=array();
 //if($result1!=""){
  foreach ($result1 as $holiday) {
        
        $eventname=$holiday->event_name;
        //echo $eventname;
        $sqlholiday=DB::table('tb_holidayandevents')
      ->Join('tb_chaletevents', 'tb_holidayandevents.id', '=', 'tb_chaletevents.event_id')
      ->where('tb_holidayandevents.event_name','=',$eventname)
      ->where('tb_chaletevents.chaletevent_status', 1)
      ->where('tb_holidayandevents.holiday_status', 1)
      ->get();
       $chalet_list=array();
     
       
         foreach ($sqlholiday as $holidayresult) {
          $chaletid = $holidayresult->chalet_id;
          $eventrent=$holidayresult->rent;

           $chalet = DB::table('tb_owner')
          ->Join('tb_chalet', 'tb_owner.id', '=', 'tb_chalet.ownerid')
          ->where('tb_chalet.id', '=', $chaletid)
          ->where('tb_chalet.is_activestatus','=',1)
          ->get();
          foreach ($chalet as $chaletlist) {


          $result1 = DB::table('tb_chaletdetails')->where('chaletid', $chaletlist->id)->where('ownerid', $chaletlist->ownerid)->get();
          // print_r($result1);die();
          $cha = array();
          foreach ($result1 as $chaletlist1) {
            $cha[] = array(
              'id' => (int)$chaletlist1->id,
              'chalet_details' => $chaletlist1->chalet_detail
            );
          }
          // print_r($cha);die();
          $result2 = DB::table('tb_chaletupload')->where('chaletid', $chaletlist->id)->where('ownerid', $chaletlist->ownerid)->get();
          $cha1 = array();
          foreach ($result2 as $chaletlist2) {
            if ($chaletlist2->file_name == "") {
              $cha1[] = array(
                'id' => (int)$chaletlist2->id,
                'file_name' => ''
              );
            } else {
              $cha1[] = array(
                'id' => (int)$chaletlist2->id,
                'chalet_id' => (int)$chaletlist2->chaletid,
                'file_name' => 'https://sicsapp.com/Aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
              );
            }
          }
          // 'weekday_rent'=>($chaletlist->weekday_rent==null) ? "" :  $chaletlist->weekday_rent,
          //  'weekend_rent'=>($chaletlist->weekend_rent==null) ? "" : $chaletlist->weekend_rent,
          //  'week_rent'=>($chaletlist->week_rent== null) ? "" : $chaletlist->week_rent,

          $result3 = DB::table('tb_chaletupload')->where('chaletid', $chaletlist->id)->where('file_type', 'image')->orderBy('id', 'ASC')->first();

          $cover = $result3->file_name;
          $cover_photo = 'https://sicsapp.com/Aby_chalet/uploads/chalet_uploads/chalet_images/' . $cover;

           $chalet_list[] = array(
            'chalet_id' => (int)$chaletlist->id,
            'chalet_name' => ($chaletlist->chalet_name == null) ? "" : $chaletlist->chalet_name,
            'cover_photo' => $cover_photo,
            'check_in' => ($holiday->check_in == null) ? "" : date("Y-m-d", strtotime($holiday->check_in)),
            'check_out' => ($holiday->check_out == null) ? "" : date("Y-m-d", strtotime($holiday->check_out)),

            'rent' => ($eventrent == null) ?  $chaletlist->weekday_rent :  $eventrent,
            'admincheck_in' => $check_in,
            'admincheck_out' => $check_out,
            'owner_id' => ($chaletlist->ownerid == null) ? "" :  (int)$chaletlist->ownerid,
            'firstname' => ($chaletlist->first_name == null) ? "" : $chaletlist->first_name,
            'lastname' => ($chaletlist->last_name == null) ? "" : $chaletlist->last_name,
            'email' => ($chaletlist->email == null) ? "" : $chaletlist->email,
            'password' => ($chaletlist->password == null) ? "" : $chaletlist->password,
            'country' => ($chaletlist->country == null) ? "" : $chaletlist->country,
            'phone' => ($chaletlist->phone == null) ? "" : $chaletlist->phone,
            'gender' => ($chaletlist->gender == null) ? "" : $chaletlist->gender,
            'profile_pic' => ($chaletlist->profile_pic == null) ? "" : "https://sicsapp.com/Aby_chalet/uploads/profile_pic/" . $chaletlist->profile_pic,
            'civil_id' => ($chaletlist->civil_id == null) ? "" : $chaletlist->civil_id,
            'chalet_ownership' => ($chaletlist->chalet_ownership == null) ? "" : $chaletlist->chalet_ownership,
            'bank_holder_name' => ($chaletlist->bank_holder_name == null) ? "" : $chaletlist->bank_holder_name,
            'bank_name' => ($chaletlist->bank_name == null) ? "" : $chaletlist->bank_name,
            'iban_num' => ($chaletlist->iban_num == null) ? "" : $chaletlist->iban_num,
            'chalet_details' => $cha,
            'chalet_upload' => $cha1,
            'min_deposit' => $min_deposit,
            'available_deposit' => $available_deposit,
            'remaining_amt_pay' => $remaining_amt_pay,
            'offer_expiry' => $offer_expiry,
            'created_at' => ($chaletlist->created_at == null) ? "" : $chaletlist->created_at,
            'updated_at' => ($chaletlist->updated_at == null) ? "" : $chaletlist->updated_at
          );
         }
       }
         // $holi=array();
            $holi[] = array(
            'id' => (int)$holiday->hid,
            'event_name' => ($holiday->event_name == null) ? "" : $holiday->event_name,
            'events_checkin' => ($holiday->check_in == null) ? "" : date("Y-m-d", strtotime($holiday->check_in)),
            'events_checkout' => ($holiday->check_out == null) ? "" : date("Y-m-d", strtotime($holiday->check_out)
              ),
             'admin_check_in' => $check_in,
            'admin_check_out' => $check_out,
            'user_details' => $chalet_list

          );



      }
       $post = array(
          'status' => true,
          'message' => 'Holidays And Events Listed', 'chalet_list' =>  $holi
        );


        }
        else{
         
      $post = array(
        'status' => false,
        'message' => 'No Holidays and Events', 'chalet_list' =>  $holi
      );
        
      }
      

    return json_encode($post);
  }



  public function offers(Request $request)
  {
    $result = DB::table('tb_offers')->groupBy('offer_checkin', 'offer_checkout')->get(); //getting all offers
    // print_r($result);
    $admin_result = DB::table('tb_superadmin')->first();
    $check_in = ($admin_result->check_in == null) ? "" : $admin_result->check_in;
    $check_out = ($admin_result->check_out == null) ? "" : $admin_result->check_out;
    $remaining_amt = ($admin_result->remaining_amt_pay == null) ? "" : $admin_result->remaining_amt_pay;
    $offer_expiry = ($admin_result->offer_expiry == null) ? "" : $admin_result->offer_expiry;
    $min_deposit = ($admin_result->deposit == null) ? "" : $admin_result->deposit;
    $available_deposit = ($admin_result->deposit_available == null) ? "" : $admin_result->deposit_available;
  
    // echo $offer_expiry;die();
    $admin = array(
      'remaining_amt' => $remaining_amt,
      'offer_expiry' => $offer_expiry
    );
    date_default_timezone_set('Asia/Kolkata');
    $current_date    = date('Y-m-d H:i:s');
    $chalet_list = array();
    foreach ($result as $offers) {
      //checking if the offer is expired
      $startdate = $offers->offer_checkin;
      $datetime = date("Y-m-d H:i:s", strtotime($startdate));
      $timestamp = strtotime($datetime);
      $time = $timestamp - ($offer_expiry * 60 * 60);
      $enddate = date("Y-m-d H:i:s", $time);
      //end
      if ($enddate >= $current_date) {
        // echo "not expired";
        $sql_chalets = DB::table('tb_offers')->where('offer_checkin', $offers->offer_checkin)->where('offer_checkout', $offers->offer_checkout)->get();
        // print_r($sql_chalets);die();
       
        
        $chalet_array = array();
        foreach ($sql_chalets as $chalets) {
        // print_r($chalets->chaletid);die();
          $chaletid = $chalets->chaletid;
         //echo $chaletid;die();
          $chalet = DB::table('tb_owner')
          ->select('*','tb_chalet.id as cid')
            ->Join('tb_chalet', 'tb_owner.id', '=', 'tb_chalet.ownerid')
            ->where('tb_chalet.id', '=', $chaletid)
           

            ->first();
          // print_r($chalet);die();
          $checkin = strtotime($offers->offer_checkin);
          $checkout = strtotime($offers->offer_checkout);
          $diff = abs($checkout - $checkin);

          $years = floor($diff / (365 * 60 * 60 * 24));
          $months = floor(($diff - $years * 365 * 60 * 60 * 24)
            / (30 * 60 * 60 * 24));
          $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
            $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

//echo $days;die();
          if ($days == 3) {
            $re = (int)$chalet->weekday_rent;
            //echo $chalet->weekday_rent;die();
            $rent = $chalet->weekday_rent - $offers->discount_amt;
          }
          else if ($days == 2) {
            $re = $chalet->weekend_rent;
//echo $chalet->weekend_rent.' '.$offers->discount_amt;
            $rent = (int)$chalet->weekend_rent - $offers->discount_amt;
          }

         else if ($days == 6) {
            $re = (int)$chalet->week_rent;
            $rent = (int)$chalet->week_rent - $offers->discount_amt;
          } 

          else {
            $re = 0;
            $rent = 0;
          }
          $result1 = DB::table('tb_chaletdetails')->where('chaletid',$chaletid)->get();
          // print_r($result1);die();
          $cha = array();
          foreach ($result1 as $chaletlist1) {
            $cha[] = array(
              'id' => (int)$chaletlist1->id,
              'chalet_details' => $chaletlist1->chalet_detail
            );
          }
          // print_r($cha);die();
          $result2 = DB::table('tb_chaletupload')->where('chaletid', $chaletid)->get();
          $cha1 = array();
          foreach ($result2 as $chaletlist2) {
            if ($chaletlist2->file_name == "") {
              $cha1[] = array(
                'id' => (int)$chaletlist2->id,
                'file_name' => ''
              );
            } else {
              $cha1[] = array(
                'id' => (int)$chaletlist2->id,
                'chalet_id' => (int)$chaletlist2->chaletid,
                'file_name' => 'https://sicsapp.com/Aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
              );
            }
          }
          // print_r($cha1);die();
           $orgDate = $chalets->offer_checkin;  
    $checkdate = date("d-m-Y", strtotime($orgDate));
     $orgdate = $chalets->offer_checkout;  
    $check_out_date = date("d-m-Y", strtotime($orgdate));



    $result3 = DB::table('tb_chaletupload')->where('chaletid', $chaletid)->where('file_type', 'image')->orderBy('id', 'ASC')->first();


      $cover = $result3->file_name;
      
       //echo $chalet->id.$result3->file_name;
      $cover_photo = 'https://sicsapp.com/Aby_chalet/uploads/chalet_uploads/chalet_images/' . $cover;
       //$cover_photo="";

          $chalet_array[] = array(
            'chalet_id' => (int)$chalet->id,
            'chalet_name' => ($chalet->chalet_name == null) ? "" : $chalet->chalet_name,
            'cover_photo' => $cover_photo,
            'admincheck_in' => $check_in,
            'admincheck_out' => $check_out,
            'check_in'=>($chalets->offer_checkin==null)? "" : $checkdate,
            'check_out'=>($chalets->offer_checkout==null) ? ""  : $check_out_date,
            'owner_id' => ($chalet->ownerid == null) ? "" : (int)$chalet->ownerid,
            'firstname' => ($chalet->first_name == null) ? "" : $chalet->first_name,
            'lastname' => ($chalet->last_name == null) ? "" : $chalet->last_name,
            'email' => ($chalet->email == null) ? "" : $chalet->email,
            'password' => ($chalet->password == null) ? "" : $chalet->password,
            'country' => ($chalet->country == null) ? "" : $chalet->country,
            'phone' => ($chalet->phone == null) ? "" : $chalet->phone,
            'gender' => ($chalet->gender == null) ? "" : $chalet->gender,
            'profile_pic' => ($chalet->profile_pic == null) ? "" : "https://sicsapp.com/Aby_chalet/uploads/profile_pic/" . $chalet->profile_pic,
            'civil_id' => ($chalet->civil_id == null) ? "" : $chalet->civil_id,
            'chalet_ownership' => ($chalet->chalet_ownership == null) ? "" : $chalet->chalet_ownership,
            'bank_holder_name' => ($chalet->bank_holder_name == null) ? "" : $chalet->bank_holder_name,
            'bank_name' => ($chalet->bank_name == null) ? "" : $chalet->bank_name,
            'iban_num' => ($chalet->iban_num == null) ? "" : $chalet->iban_num,
            'original_price' => ($re==null)? 0 : (int)$re,
            'rent' => $rent,
            'discount_amt' => ($offers->discount_amt == null) ? 0 : (int)$offers->discount_amt,
            'min_deposit' => $min_deposit,
        'available_deposit' => $available_deposit,
        'remaining_amt_pay' => $remaining_amt,
        'offer_expiry' => $offer_expiry,
            'chalet_details' => $cha,
            'chalet_upload' => $cha1,
            'created_at' => ($chalet->created_at == null) ? "" : $chalet->created_at,
            'updated_at' => ($chalet->updated_at == null) ? "" : $chalet->updated_at
          );
          // print_r($chalet_array);die();
         
          // print_r($chalet_list);die();
        }


         $orgDate1 = $offers->offer_checkin;  
    $checkdate1 = date("Y-m-d", strtotime($orgDate1));
     $orgdate1 = $offers->offer_checkout;  
    $check_out_date1 = date("Y-m-d", strtotime($orgdate1));
        $revCount=DB::table('tb_reservation')->where('check_in', $checkdate1)->where('check_out', $check_out_date1)->count();
        //echo $revCount;
          if($revCount==0){
        $chalet_list[] = array(
            'offer_id' => (int)$chalets->id,
            'created_at'=>$chalets->created_at,
            'offer_checkin' => $chalets->offer_checkin,
            'offer_checkout' => $chalets->offer_checkout,
            'user_details' => $chalet_array
          ); 
      }
      }
      // else {
      //   echo "expired=>";
      // }
    }
    // print_r($chalet_list);die();
    $post = array(
      'status' => true,
      'message' => 'Offers',
      'admin' => $admin,
      'chalet_list' =>  $chalet_list
    );
    return json_encode($post);
  }





  public function view_contact(Request $request){
  $resultCount = DB::table('tb_contacts')->count();
  if($resultCount!=0){
  $result = DB::table('tb_contacts')->get();
  foreach($result as $resultVal){
    $contactArray[]=array("id"=>(int)$resultVal->id,
                          "name"=>($resultVal->name==null)? "" :$resultVal->name,
                          "phone"=>($resultVal->phone==null)?"":$resultVal->phone,
                          "profile_pic"=>($resultVal->profile_pic==null)? "" : "https://sicsapp.com/Aby_chalet/uploads/contacts/" . $resultVal->profile_pic,
                          "created_at"=>($resultVal->created_at==null)?"" : $resultVal->created_at,
                          "updated_at"=>($resultVal->updated_at==null)? "" :$resultVal->updated_at);

  }
 
  $post = array( 'status' => true,
  'message' => 'Contats',
  'contact_list' =>  $contactArray
);
  }
  else{
    $post = array( 'status' => false,
  'message' => 'No Contact',
  'contact_list' =>  $contactArray
);
  }
  return json_encode($post);

}
}
