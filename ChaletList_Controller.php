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
      ->get();
    //print_r($chalet);
    $cha = array();
    foreach ($chalet as $chaletlist) {
      $result1 = DB::table('tb_chaletdetails')->where('chaletid', $chaletlist->id)->where('ownerid', $chaletlist->ownerid)->get();
      // print_r($result1);die();
      $cha = array();
      foreach ($result1 as $chaletlist1) {
        $cha[] = array(
          'id' => ($chaletlist1->id == null) ? "" : $chaletlist1->id,
          'chalet_details' => ($chaletlist1->chalet_detail == null) ? "" : $chaletlist1->chalet_detail
        );
      }
      $cha1 = array();
      // print_r($cha);die();
      $result2 = DB::table('tb_chaletupload')->where('chaletid', $chaletlist->id)->where('ownerid', $chaletlist->ownerid)->get();

      foreach ($result2 as $chaletlist2) {
        if ($chaletlist2->file_name == "") {
          $cha1[] = array(
            'id' => ($chaletlist2->id == null) ? "" : $chaletlist2->id,
            'chalet_id' => ($chaletlist2->chaletid == null) ? "" : $chaletlist2->chaletid,
            'file_name' => ''
          );
        } else {
          $cha1[] = array(
            'id' => ($chaletlist2->id == null) ? "" : $chaletlist2->id,
            'chalet_id' => ($chaletlist2->chaletid == null) ? "" : $chaletlist2->chaletid,
            'file_name' => 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
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
        'chalet_id' => ($chaletlist->id == null) ? "" : $chaletlist->id,
        'owner_id' => ($chaletlist->ownerid == null) ? "" : $chaletlist->ownerid,
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

    $chaid = "";
   $season = DB::table('tb_seasondates')->where('season_start','<=', $request->from_date)->where('season_end','>=', $request->to_date)->count();
if($season>0){
  if ($data['package'] == 'weekdays') {
      $rent = 'weekdays_seasonprice';
    } else if ($data['package'] == 'weekend') {
      $rent = 'weekend_seasonprice';
    } else if ($data['package'] == 'weekA' || $data['package'] == 'weekB') {
      $rent = 'week_seasonprice';
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


    $chalet2 = DB::table('tb_reservation')->where('check_in', $request->from_date)->where('check_out', $request->to_date)->get();
    // print_r($chalet2);die();
    $cha = array();
    $cha1 = array();

    foreach ($chalet2 as $value) {
      $chaid = $value->chaletid;
    }
    $chalet = DB::table('tb_owner')
      ->Join('tb_chalet', 'tb_owner.id', '=', 'tb_chalet.ownerid')
      ->where('tb_chalet.id', '!=', $chaid)
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

      $result1 = DB::table('tb_chaletdetails')->where('chaletid', $id)->where('ownerid', $chaletlist->ownerid)->get();
      $cha = array();
      // print_r($result1);die();
      foreach ($result1 as $chaletlist1) {
        $cha[] = array(
          'id' => $chaletlist1->id,
          'chalet_details' => $chaletlist1->chalet_detail
        );
      }
      // print_r($cha);die();
      $cha1 = array();
      $result2 = DB::table('tb_chaletupload')->where('chaletid', $id)->where('ownerid', $chaletlist->ownerid)->get();

      foreach ($result2 as $chaletlist2) {
        if ($chaletlist2->file_name == "") {
          $cha1[] = array(
            'id' => $chaletlist2->id,
            'file_name' => ''
          );
        } else {
          $cha1[] = array(
            'id' => $chaletlist2->id,
            'chalet_id' => $chaletlist2->chaletid,
            'file_name' => 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
          );
        }
      }

// echo "chaletid=>".$chaletlist->id;
      $result3 = DB::table('tb_chaletupload')->where('chaletid', $chaletlist->id)->where('file_type', 'image')->orderBy('id', 'ASC')->first();


      $cover = $result3->file_name;
      
      // echo "coverphoto=>".$result3->file_name;
      $cover_photo = 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $cover;
     



      $result[] = array(
        'slno' => $i++,
        'chalet_id' => $chaletlist->id,
        'chalet_name' => ($chaletlist->chalet_name == null) ? "" : $chaletlist->chalet_name,
        'cover_photo' => $cover_photo,
        'check_in' => $request->from_date,
        'check_out' => $request->to_date,
        'rent' => ($chaletlist->$rent == null) ? "" : $chaletlist->$rent,
        'admincheck_in' => $check_in,
        'admincheck_out' => $check_out,
        'owner_id' => ($chaletlist->ownerid == null) ? "" : $chaletlist->ownerid,
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






  public function searchHolidays(Request $request)
  {


    $result1 = DB::table('tb_holidayandevents')
      ->Join('tb_chaletevents', 'tb_holidayandevents.id', '=', 'tb_chaletevents.event_id')
      ->where('tb_chaletevents.chaletevent_status', 1)
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
 if($result1!=""){
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
              'id' => $chaletlist1->id,
              'chalet_details' => $chaletlist1->chalet_detail
            );
          }
          // print_r($cha);die();
          $result2 = DB::table('tb_chaletupload')->where('chaletid', $chaletlist->id)->where('ownerid', $chaletlist->ownerid)->get();
          $cha1 = array();
          foreach ($result2 as $chaletlist2) {
            if ($chaletlist2->file_name == "") {
              $cha1[] = array(
                'id' => $chaletlist2->id,
                'file_name' => ''
              );
            } else {
              $cha1[] = array(
                'id' => $chaletlist2->id,
                'chalet_id' => $chaletlist2->chaletid,
                'file_name' => 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
              );
            }
          }
          // 'weekday_rent'=>($chaletlist->weekday_rent==null) ? "" :  $chaletlist->weekday_rent,
          //  'weekend_rent'=>($chaletlist->weekend_rent==null) ? "" : $chaletlist->weekend_rent,
          //  'week_rent'=>($chaletlist->week_rent== null) ? "" : $chaletlist->week_rent,

          $result3 = DB::table('tb_chaletupload')->where('chaletid', $chaletlist->id)->where('file_type', 'image')->orderBy('id', 'ASC')->first();

          $cover = $result3->file_name;
          $cover_photo = 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $cover;

           $chalet_list[] = array(
            'chalet_id' => $chaletlist->id,
            'chalet_name' => ($chaletlist->chalet_name == null) ? "" : $chaletlist->chalet_name,
            'cover_photo' => $cover_photo,
            'check_in' => ($holiday->check_in == null) ? "" : date("Y-m-d", strtotime($holiday->check_in)),
            'check_out' => ($holiday->check_out == null) ? "" : date("Y-m-d", strtotime($holiday->check_out)),

            'rent' => ($chaletlist->weekday_rent == null) ? "" :  $chaletlist->weekday_rent,
            'admincheck_in' => $check_in,
            'admincheck_out' => $check_out,
            'owner_id' => ($chaletlist->ownerid == null) ? "" : $chaletlist->ownerid,
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
            'id' => $holidayresult->id,
            'event_name' => ($holidayresult->event_name == null) ? "" : $holidayresult->event_name,
            'events_checkin' => ($holidayresult->check_in == null) ? "" : date("Y-m-d", strtotime($holidayresult->check_in)),
            'events_checkout' => ($holidayresult->check_out == null) ? "" : date("Y-m-d", strtotime($holidayresult->check_out)),
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
          $chaletid = $chalets->chaletid;
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


          if ($days == 3) {
            $re = (int)$chalet->weekday_rent;
            $rent = $chalet->weekday_rent - $offers->discount_amt;
          }
          if ($days == 2) {
            $re = (int)$chalet->weekend_rent;
            $rent = (int)$chalet->weekend_rent - $offers->discount_amt;
          }
         if ($days == 6) {
            $re = (int)$chalet->week_rent;
            $rent = (int)$chalet->week_rent - $offers->discount_amt;
          } else {
            $re = 0;
            $rent = 0;
          }
          $result1 = DB::table('tb_chaletdetails')->where('chaletid',$chaletid)->get();
          // print_r($result1);die();
          $cha = array();
          foreach ($result1 as $chaletlist1) {
            $cha[] = array(
              'id' => $chaletlist1->id,
              'chalet_details' => $chaletlist1->chalet_detail
            );
          }
          // print_r($cha);die();
          $result2 = DB::table('tb_chaletupload')->where('chaletid', $chalets->id)->get();
          $cha1 = array();
          foreach ($result2 as $chaletlist2) {
            if ($chaletlist2->file_name == "") {
              $cha1[] = array(
                'id' => $chaletlist2->id,
                'file_name' => ''
              );
            } else {
              $cha1[] = array(
                'id' => $chaletlist2->id,
                'chalet_id' => $chaletlist2->chaletid,
                'file_name' => 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
              );
            }
          }
          // print_r($cha1);die();
           $orgDate = $chalets->offer_checkin;  
    $checkdate = date("d-m-Y", strtotime($orgDate));
     $orgdate = $chalets->offer_checkout;  
    $check_out_date = date("d-m-Y", strtotime($orgdate));



    $result3 = DB::table('tb_chaletupload')->where('chaletid', $chalets->id)->where('file_type', 'image')->orderBy('id', 'ASC')->first();


      $cover = $result3->file_name;
      
      // echo "coverphoto=>".$result3->file_name;
      $cover_photo = 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $cover;

          $chalet_array[] = array(
            'chalet_id' => $chalet->id,
            'chalet_name' => ($chalet->chalet_name == null) ? "" : $chalet->chalet_name,
            'cover_photo' => $cover_photo,
            'admincheck_in' => $check_in,
            'admincheck_out' => $check_out,
            'check_in'=>($chalets->offer_checkin==null)? "" : $checkdate,
            'check_out'=>($chalets->offer_checkout==null) ? ""  : $check_out_date,
            'owner_id' => ($chalet->ownerid == null) ? "" : $chalet->ownerid,
            'firstname' => ($chalet->first_name == null) ? "" : $chalet->first_name,
            'lastname' => ($chalet->last_name == null) ? "" : $chalet->last_name,
            'email' => ($chalet->email == null) ? "" : $chalet->email,
            'password' => ($chalet->password == null) ? "" : $chalet->password,
            'country' => ($chalet->country == null) ? "" : $chalet->country,
            'phone' => ($chalet->phone == null) ? "" : $chalet->phone,
            'gender' => ($chalet->gender == null) ? "" : $chalet->gender,
            'profile_pic' => ($chalet->profile_pic == null) ? "" : "https://web.sicsglobal.com/aby_chalet/uploads/profile_pic/" . $chalet->profile_pic,
            'civil_id' => ($chalet->civil_id == null) ? "" : $chalet->civil_id,
            'chalet_ownership' => ($chalet->chalet_ownership == null) ? "" : $chalet->chalet_ownership,
            'bank_holder_name' => ($chalet->bank_holder_name == null) ? "" : $chalet->bank_holder_name,
            'bank_name' => ($chalet->bank_name == null) ? "" : $chalet->bank_name,
            'iban_num' => ($chalet->iban_num == null) ? "" : $chalet->iban_num,
            'original_price' => ($re==null)? 0 : $re,
            'rent' => $rent,
            'discount_amt' => ($offers->discount_amt == null) ? 0 : $offers->discount_amt,
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
        $chalet_list[] = array(
            'offer_id' => $chalets->id,
            'created_at'=>$chalets->created_at,
            'offer_checkin' => $chalets->offer_checkin,
            'offer_checkout' => $chalets->offer_checkout,
            'user_details' => $chalet_array
          ); 
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
}
