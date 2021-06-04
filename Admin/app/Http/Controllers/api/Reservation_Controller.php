<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
//use App\Models\UserAuth;
use Illuminate\Support\Facades\DB;

class Reservation_Controller extends Controller
  {
    
public function booking(Request $request){
$re=0;
$remaining=0;
$last2 = DB::table('tb_reservation')->orderBy('id', 'DESC')->first('reservation_id');
if($last2!=""){
  $reserv= $last2->reservation_id;


        $value2 = substr($reserv, 3, 6);

       

    $value2 = (int) $value2 + 1;


    $value2 = "Inv" . sprintf('%06s', $value2);
 
   
    $reservation_id=$value2;
  }
  else{
      $value2 = "Inv000001";
       $reservation_id = $value2;
  }

  $data['userid']=$request->userid;
   $data['chaletid']=$request->chaletid;
    $data['selected_package']=$request->selected_package;
    $data['check_in']=$request->check_in;
    $data['check_out']=$request->check_out;
    
    $data['total_paid']=$request->total_paid;
    $data['reward_discount']=$request->reward_discount;
    $data['offer_discount']=$request->offer_discount;
    $data['deposit']=$request->deposit;
  
    $rent=$request->rent;
   // echo $rent;die();
$status="";
   //print_r( $data);die();

     $chalet1 = DB::table('tb_superadmin')->where('id', 1)->first();
     $check_in=$chalet1->check_in;
     $check_out=$chalet1->check_out;
     $every_spend=$chalet1->every_spend;
    $chalet = DB::table('tb_chalet')->where('id', $request->chaletid)->first();
     $ownerid=$chalet->ownerid;

  


      if($request->selected_package=='weekend'){
            // $data['selected_package']='weekend_rent';
      if($data['total_paid']==$rent){
        if($data['total_paid']>=$every_spend){
          $this->reward($request->userid);
         
$status="Paid";
        }
       
          $status="Paid";

      }
      else if($data['total_paid']<=$rent&&$data['total_paid']!=$rent&&$data['total_paid']!=""){
        $status="Remaining";
       $original=$request->reward_discount+$request->offer_discount+$data['total_paid'];
      
       if($original>$rent){
         $remaining=$original-$rent;
          if($remaining==0)
       {
        $status='Paid';
       }
       else{
          $status="Remaining";
       }
       }
       else{
         $remaining=$rent-$original;
          if($remaining==0)
       {
        $status='Paid';
       }
       else{
          $status="Remaining";
       }
       }
       

      }
      else if($data['total_paid']==null){
        $status="Unpaid";
      }
    }
    if($request->selected_package=='weekdays'){
        //$data['selected_package']='weekday_rent';
       if($data['total_paid']==$rent){
        if($data['total_paid']>=$every_spend){
          $this->reward($request->userid);
$status="Paid";
        }
        $status="Paid";
      }
      else if($data['total_paid']<=$rent&&$data['total_paid']!=$rent&&$data['total_paid']!=""){
        $status="Remaining";
        $original=$request->reward_discount+$request->offer_discount+$data['total_paid'];
        if($original>$rent){
         $remaining=$original-$rent;
          if($remaining==0)
       {
        $status='Paid';
       }
       else{
          $status="Remaining";
       }
       }
       else{
         $remaining=$rent-$original;
          if($remaining==0)
       {
        $status='Paid';
       }
       else{
          $status="Remaining";
       }
       }
        
      }
      else if($data['total_paid']==null){
        $status="Unpaid";
      }

    }
     if($request->selected_package=='weekA'||$request->selected_package=='weekB'){
       // $data['selected_package']='week_rent';
       if($data['total_paid']==$rent){
        if($data['total_paid']>=$every_spend){
          $this->reward($request->userid);
          $status="Paid";

        }
        $status="Paid";
      }
      else if($data['total_paid']<=$rent&&$data['total_paid']!=$rent&&$data['total_paid']!=null){
      

        $original=$request->reward_discount+$request->offer_discount+$data['total_paid'];
    
        if($original>$rent){
         $remaining=$original-$rent;
          if($remaining==0)
       {
        $status='Paid';
       }
       else{
          $status="Remaining";
       }
       }
       else{
         $remaining=$rent-$original;
          if($remaining==0)
       {
        $status='Paid';
       }
       else{
          $status="Remaining";
       }
       }

        
         
      }
      else if($data['total_paid']==null){
        $status="Unpaid";
      }

    }

$tb_chalet = DB::table('tb_chalet')->where('id', $request->chaletid)->first();
        $id = DB::table('tb_reservation')->insertGetId(
            ['userid'=>$data['userid'],'chaletid'=>$data['chaletid'],'selected_package' => $data['selected_package'], 'check_in' => $data['check_in'],'check_out' => $data['check_out'],'reservation_id'=>$reservation_id,'total_paid'=>$data['total_paid'],'reward_discount'=>$data['reward_discount'],'offer_discount'=>$data['offer_discount'],'deposit'=>$data['deposit'],'status'=>$status,"checkin_time"=>$check_in,"checkout_time"=>$check_out,"ownerid"=>$ownerid,"package_price"=>$rent]
    );


       
        $booking = DB::table('tb_reservation')->where('id', $id)->first();
      
           $result1 = DB::table('tb_chaletdetails')->where('chaletid',$data['chaletid'] )->get();
            $cha=array();
      // print_r($result1);die();
      foreach ($result1 as $chaletlist1) {
        $cha[] = array(
          'id' => ($chaletlist1->id==null) ? "" :$chaletlist1->id,
          'chalet_details' => ($chaletlist1->chalet_detail==null) ? "" : $chaletlist1->chalet_detail
        );
      }
      // print_r($cha);die();
      $result2 = DB::table('tb_chaletupload')->where('chaletid', $data['chaletid'])->get();
       $cha1=array();

      foreach ($result2 as $chaletlist2) {
        if ($chaletlist2->file_name == "") {
          $cha1[] = array(
            'id' => ($chaletlist2->id==null) ? "" : $chaletlist2->id,
            'chalet_id' => ($chaletlist2->chaletid==null) ? "" : $chaletlist2->chaletid,
            'file_name' => ''
          );
        } else {
          $cha1[] = array(
            'id' => ($chaletlist2->id==null) ? "" : $chaletlist2->id,
            'chalet_id' => ($chaletlist2->chaletid==null) ? "" : $chaletlist2->chaletid,
            'file_name' => 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
          );
        }
      }


$location= $tb_chalet->location;

       $loc=$this->getCoordinatesAttribute($location);
         $lat=$loc['latitude'];
       $long=$loc['longitude'];
    
      
     
           $booking_data=array("id"=>$booking->id,
                       "userid"=>$booking->userid,
                        "chaletid"=>$booking->chaletid,
                        "chalet_name"=>($tb_chalet->chalet_name==null) ? 0 : $tb_chalet->chalet_name,
                        "location"=>($tb_chalet->location==null) ? "" :$tb_chalet->location,
                        "latitude"=>($lat==null) ? 0 : (double)$lat,
                        "longitude"=>($long==null) ? 0 : (double)$long,
                         "selected_package"=>$booking->selected_package,
                          "check_in"=>$booking->check_in,
                           "check_out"=>$booking->check_out,
                           "checkin_time"=>$booking->checkin_time,
                           "checkout_time"=>$booking->checkout_time,
                          "reservation_id"=>$booking->reservation_id,
                        "total_paid"=>($booking->total_paid==null) ? 0 : $booking->total_paid,
                        "reward_discount"=>($booking->reward_discount==null)? 0 : $booking->reward_discount,
                        "reservation_id"=>($booking->reservation_id==null) ? 0 : $booking->reservation_id,
                        "deposit"=>($booking->deposit==null) ? 0 : $booking->deposit,
                       'rent'=>($rent==null) ? 0 : $rent,
                       "status"=>$status,
                       "remaining"=>$remaining,
                     "ownerid"=>$booking->ownerid,
                        "offer_discount"=>($booking->offer_discount==null)? 0 : $booking->offer_discount,
                        'chalet_details' => $cha,
        'chalet_upload' => $cha1,
                      );
            //$i++;
            
        
    $result['status']=true;
            $result['message']='Reservation Successfull';
         $result['booking_details']=$booking_data;
         return json_encode($result);

            
}




public function reward($userid){
  //echo $userid;die();

   $result = DB::table('tb_rewards')->where('userid', $userid)->count();


     $chalet1 = DB::table('tb_superadmin')->where('id', 1)->first();
     $reward=$chalet1->reward_earn;
     $every_spend=$chalet1->every_spend;
   if($result==0){

       $id = DB::table('tb_rewards')->insertGetId(
            ['userid'=>$userid,'rewarded_amt'=>$reward]);
   }
   else{
    $result1 = DB::table('tb_rewards')->where('userid', $userid)->first();
   $rew= $result1->rewarded_amt;
   

     $affected = DB::table('tb_rewards')
              ->where('userid', $userid)
              ->update(['rewarded_amt'=> $rew + $reward]);
   }



}







  function getCoordinatesAttribute($url) {
        // $url = "https://www.google.com.gh/maps/place/Niagara+Falls/@43.0828162,-79.0763516,17z/data=!4m15!1m9!4m8!1m0!1m6!1m2!1s0x89d34307412d7ae9:0x29be1d1e689ce35b!2sNiagara+Falls,+NY+14303,+United+States!2m2!1d-79.0741629!2d43.0828162!3m4!1s0x89d34307412d7ae9:0x29be1d1e689ce35b!8m2!3d43.0828162!4d-79.0741629";
        $url_coordinates_position = strpos($url, '@')+1;
        $coordinates = [];

        if ($url_coordinates_position != false) {
            $coordinates_string = substr($url, $url_coordinates_position);
            $coordinates_array = explode(',', $coordinates_string);

            if (count($coordinates_array) >= 2) {
                $longitude = $coordinates_array[0];
                $latitude = $coordinates_array[1];

                $coordinates = [
                    "longitude" => $longitude,
                    "latitude" => $latitude
                ];
            }
            else{
               $coordinates = [
                    "longitude" => 0,
                    "latitude" => 0
                ];
            }

            return $coordinates;
        }

        return $coordinates;
    }

     public function mybooking_list(Request $request){



   $data['userid']=$request->userid;
   $rentstatus='';
    $book = DB::table('tb_reservation')->where('userid', $request->userid)->get();
       $chalet1 = DB::table('tb_superadmin')->where('id', 1)->first();
    $reward_earn=$chalet1->reward_earn;
     $every_spend=$chalet1->every_spend;
     $checkin=($chalet1->check_in==null) ? "" : $chalet1->check_in;
     $checkout=($chalet1->check_out==null) ? "" : $chalet1->check_out;
        $reward1 = DB::table('tb_rewards')->where('userid', $request->userid)->count();
        if($reward1==1){


     $reward = DB::table('tb_rewards')->where('userid', $request->userid)->first();
     $rewarded_amt=$reward->rewarded_amt;


  }
  else{
     $rewarded_amt=0;
  }

    
    $reward_details[]=array("reward_earn"=>$reward_earn,
                           "every_spend"=>$every_spend,
                           "rewarded_amt"=>$rewarded_amt);
$mybook=array();
$chaletdetails=array();
    foreach ($book as  $booking) {
      $tb_chalet = DB::table('tb_owner')
      ->Join('tb_chalet', 'tb_owner.id', '=', 'tb_chalet.ownerid')
      ->where('tb_chalet.id','=',$booking->chaletid)
        ->get();
     $result1 = DB::table('tb_chaletdetails')->where('chaletid',$booking->chaletid)->where('ownerid',$booking->ownerid)->get();
      // print_r($result1);die();
     $cha=array();
      foreach ($result1 as $chaletlist1) {
        $cha[] = array(
          'id' => ($chaletlist1->id==null) ? "" :$chaletlist1->id,
          'chalet_details' => ($chaletlist1->chalet_detail==null) ? "" : $chaletlist1->chalet_detail
        );
      }
      // print_r($cha);die();
      $result2 = DB::table('tb_chaletupload')->where('chaletid', $booking->chaletid)->where('ownerid',$booking->ownerid)->get();
      $cha1=array();

      foreach ($result2 as $chaletlist2) {
        if ($chaletlist2->file_name == "") {
          $cha1[] = array(
            'id' => ($chaletlist2->id==null) ? "" : $chaletlist2->id,
            'chalet_id' => ($chaletlist2->chaletid==null) ? "" : $chaletlist2->chaletid,
            'file_name' => ''
          );
        } else {
          $cha1[] = array(
            'id' => ($chaletlist2->id==null) ? "" : $chaletlist2->id,
            'chalet_id' => ($chaletlist2->chaletid==null) ? "" : $chaletlist2->chaletid,
            'file_name' => 'https://web.sicsglobal.com/aby_chalet/uploads/chalet_uploads/chalet_images/' . $chaletlist2->file_name
          );
        }
      }
      $date=date('Y-m-d');
foreach($tb_chalet as $chaletlist){
  if($chaletlist->is_activestatus==1){
    $status='available';
  }
  else if($chaletlist->is_activestatus==0)
  {
    $status='not_available';

  }
  else if(($chaletlist->is_activestatus==1)&&($booking->check_out<=$date)){
    $status='not_available';
  }
  else if(($chaletlist->is_activestatus==1)&&($chaletlist->status=='Remaining')){
    $status='awaiting_payment';
  }
  else if(($chaletlist->is_activestatus==1)&&($chaletlist->status=='Paid')){
      $status='available';

  }
  if($booking->status=='Paid'&&$booking->check_out<date('Y-m-d')){
  $active_status='not_active';
}
else if($booking->status=='Paid'&&$booking->check_out>=date('Y-m-d')){
  $active_status='active';
}
else if($booking->status=='Remaining'&&$chaletlist->is_activestatus==1){
  $active_status='awaiting_payment';
}
else if($booking->status=='Remaining'&&$chaletlist->is_activestatus==0){
  $active_status='not_available';
}
else{
  $active_status='';
}



  $location= $chaletlist->location;

       $loc=$this->getCoordinatesAttribute($location);
         $lat=$loc['latitude'];
       $long=$loc['longitude'];
       $chaletdetails=array();

$chaletdetails[]=array(
          'chalet_id' => $chaletlist->id,
       'chalet_name'=>($chaletlist->chalet_name==null) ? "" : $chaletlist->chalet_name,
       "location"=>($chaletlist->location==null) ? "" :$chaletlist->location,
          "latitude"=>($lat==null) ? 0 : (double)$lat,
            "longitude"=>($long==null) ? 0 : (double)$long,
        'weekday_rent'=>($chaletlist->weekday_rent==null) ? "" :  $chaletlist->weekday_rent,
        'weekend_rent'=>($chaletlist->weekend_rent==null) ? "" : $chaletlist->weekend_rent,
        'week_rent'=>($chaletlist->week_rent== null) ? "" : $chaletlist->week_rent,
         'owner_id' => ($chaletlist->ownerid==null) ? "" : $chaletlist->ownerid,
        'firstname' => ($chaletlist->first_name==null) ? "" : $chaletlist->first_name,
        'lastname' => ($chaletlist->last_name==null) ? "" : $chaletlist->last_name,
        'email' => ($chaletlist->email==null) ? "" : $chaletlist->email,
        'password' => ($chaletlist->password==null) ? "" : $chaletlist->password,
        'country' => ($chaletlist->country==null) ? "" : $chaletlist->country,
        'phone' => ($chaletlist->phone==null) ? "" : $chaletlist->phone,
        'gender' => ($chaletlist->gender==null) ? "" : $chaletlist->gender,
        'profile_pic' => ($chaletlist->profile_pic==null) ? "" : "https://web.sicsglobal.com/aby_chalet/uploads/profile_pic/".$chaletlist->profile_pic,
        'civil_id' => ($chaletlist->civil_id==null)? "" : $chaletlist->civil_id,
        'chalet_ownership' => ($chaletlist->chalet_ownership==null) ? "" : $chaletlist->chalet_ownership,
        'bank_holder_name' => ($chaletlist->bank_holder_name==null) ? "" : $chaletlist->bank_holder_name,
        'bank_name' => ($chaletlist->bank_name==null) ? "" : $chaletlist->bank_name,
        'iban_num' => ($chaletlist->iban_num==null)? "" : $chaletlist->iban_num,
        'availablility_status'=> $status,
        'chalet_details' => $cha,
        'chalet_upload' => $cha1,
        
       
        'created_at' => ($chaletlist->created_at==null) ? "" : $chaletlist->created_at,
        'updated_at' => ($chaletlist->updated_at==null) ? "" : $chaletlist->updated_at
        );

}







     $mybook[]=array("id"=>$booking->id,
                       "userid"=>$booking->userid,
                        "chaletid"=>$booking->chaletid,
                         "selected_package"=>$booking->selected_package,
                          "check_in"=>$booking->check_in,
                           "check_out"=>$booking->check_out,
                           'admincheck_in'=>($booking->checkin_time==null) ? "" : $booking->checkin_time,
        'admincheck_out'=> ($booking->checkout_time==null) ? "" : $booking->checkout_time,
        'rent'=>($booking->package_price==null) ? 0 : $booking->package_price,
                          "reservation_id"=>$booking->reservation_id,
                        "total_paid"=>($booking->total_paid==null) ? 0 : $booking->total_paid,
                        "reward_discount"=>($booking->reward_discount==null)? 0 : $booking->reward_discount,
                        "reservation_id"=>($booking->reservation_id==null) ? 0 : $booking->reservation_id,
                        "deposit"=>($booking->deposit==null) ? 0 : $booking->deposit,
                        "status"=>$booking->status,
                        "active_status"=>$active_status,
                        "ownerid"=>$booking->ownerid,
                        "offer_discount"=>($booking->offer_discount==null)? 0 : $booking->offer_discount,
                         "chalet_details" => $chaletdetails
                        );
    }
      
          
            //$i++;
            
        
    $result['status']=true;
            $result['message']='Reservation List';
            $result["reward_details"]=$reward_details;
         $result['booking_details']=$mybook;
         return json_encode($result);

}









    }
