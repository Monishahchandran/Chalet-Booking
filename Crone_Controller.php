<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
//use App\Models\UserAuth;
use Illuminate\Support\Facades\DB;

class Crone_Controller extends Controller
  {
public function remaining_status(Request $request){
  $reservation=DB::table('tb_reservation')->get();
  $admin=DB::table('tb_superadmin')->where('id',1)->first();
  $checkout=$admin->remaining_amt_pay;

   
   date_default_timezone_set('Asia/Kolkata');
    $current_date= date('Y-m-d h:i A');
    
   //cho  $current_date;
   // echo '<br>';
     // echo  $current_time;

    foreach ($reservation as  $reserv) {
      $check_out =$reserv->check_out;
      
      $checkout_time=$reserv->checkout_time;
      $cdate=$check_out.' '.$checkout_time;
     
      $date = date('Y-m-d h:i A',strtotime('-'.$checkout.' hour',strtotime($cdate))); 

      

      $status=$reserv->status;
      if($current_date>=$date&& $status=='Remaining' ){

      //echo $current_date.'$current_date';
      //echo '<br>';

$affected = DB::table('tb_reservation')
        ->where('check_out',$check_out)
        ->where('checkout_time',$checkout_time)
          ->update(['booking_status' => 1]);
//               echo 'hai';
        
      }
      else{
        
      }
    
    }
   

}



public function check_reward(Request $request){

	$reward=DB::table('tb_rewards')->get();
	 date_default_timezone_set('Asia/Kolkata');
    $current_year= date('Y');
    //echo $current_year;
	foreach ($reward as $reward_list) {
		$created_at=$reward_list->created_at;

    $created_year = date("Y", strtotime($created_at));  
    //echo $created_year;
if($current_year!=$created_year){
	
$affected = DB::table('tb_rewards')->where('created_at', $created_at)->delete();
}


	}


}

  }

  ?>