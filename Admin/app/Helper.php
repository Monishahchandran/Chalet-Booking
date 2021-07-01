<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Str;
use App\Models\Chalet;
use App\Models\Reservation;
use App\Models\ChaletUpload;
use App\Models\HolidayAndEvents;
use App\Models\ChaletEvent;
use App\Models\Offers;
use App\Models\Owner;
use App\Models\Users;
use App\Models\Rewards;

class Helper
{

    public static function get_count_chalet($id)
    {
        $count = Chalet::select('*')->where('ownerid', $id)->count();
        return $count;
    }
    public static function get_count_chaletreservation($id)
    {
        $count = Reservation::select('*')->where('ownerid', $id)->count();
        return $count;
    }
    public static function get_count_paidchaletreservation($id)
    {
        $count = Reservation::select('*')->where('ownerid', $id)->where('status', '=', 'Paid')->count();
        return $count;
    }
    public static function get_count_unpaidchaletreservation($id)
    {
        $count = Reservation::select('*')->where('ownerid', $id)->where('status', '=', 'Remaining')->count();
        return $count;
    }
     public static function get_owner_totalpaid($id)
    {
        $count = Reservation::select('*')->where('ownerid', $id)->sum('total_paid');
        return $count;
    }
    public static function get_owner_commission($id)
    {
        $count = Reservation::select('*')->where('ownerid', $id)->sum('owner_commission');
        return $count;
    }
    public static function get_count_ownerchaletreservation($id)
    {
        $count = Reservation::select('*')->where('chaletid', $id)->count();
        return $count;
    }
    public static function get_count_paidownerchaletreservation($id)
    {
        $count = Reservation::select('*')->where('chaletid', $id)->where('status', '=', 'Paid')->count();
        return $count;
    }
    public static function get_count_unpaidownerchaletreservation($id)
    {
        $count = Reservation::select('*')->where('chaletid', $id)->where('status', '=', 'Remaining')->count();
        return $count;
    }
    public static function get_chalet_totalpaid($id)
    {
        $count = Reservation::select('*')->where('chaletid', $id)->sum('total_paid');
        return $count;
    }
    public static function get_chalet_commission($id)
    {
        $count = Reservation::select('*')->where('chaletid', $id)->sum('owner_commission');
        return $count;
    }
    public static function get_chalet_image($id)
    {
        $imagefile = ChaletUpload::select('*')->where('chaletid', $id)->where('file_type', 'image')->orderBy('id', 'ASC')->value('file_name');
        // return $imagefile->file_name;
        return $imagefile;
    }
    public static function get_events()
    {
        $result = HolidayAndEvents::get();
        return $result;
    }
    public static function get_chalet_event($cid, $eid)
    {
        $result = ChaletEvent::select('*')->where('chalet_id', $cid)->where('event_id', $eid)->first();
        return $result;
    }
    public static function get_offer_count($id)
    {
        $count = Offers::select('*')->where('chaletid', $id)->count();
        return $count;
    }
    public static function get_user_details($id)
    {
        $result = Users::select('*')->where('id', $id)->first();
        return $result;
    }
    public static function get_owner_details($id)
    {
        $result = Owner::select('*')->where('id', $id)->first();
        return $result;
    }
    public static function get_totalpaid()
    {
        $result = Reservation::select('*')->where('status', '=', 'Paid')->sum('total_paid');
        return $result;
    }
    public static function get_totalunpaid()
    {
        $result = Reservation::select('*')->where('status', '=', 'Remaining')->get();
        $s = 0;
        foreach ($result as $sum) {
            $total_paid = $sum->total_paid;
            // echo $total_paid.',';
            $package_price = $sum->package_price;
            // echo $package_price.'=';
            if ($package_price > $total_paid) {
                $remaining_amt = $package_price - $total_paid;
            } else {
                $remaining_amt = $total_paid - $package_price;
            }
            // echo $remaining_amt.';';
            $s=$s + $remaining_amt;
            
        }
        return  $s;
    }
    public static function get_totaldeposit()
    {
        $result = Reservation::select('*')->sum('deposit');
        return $result;
    }
    public static function get_totalreward()
    {
        $result = Reservation::select('*')->sum('reward_discount');
        return $result;
    }
    public static function get_totaloffer()
    {
        $result = Reservation::select('*')->sum('offer_discount');
        return $result;
    }
    public static function get_activechalets($id)
    {
        $count = Chalet::select('*')->where('ownerid', $id)->where('is_activestatus', '1')->count();
        return $count;
    }
    public static function get_remaining($id)
    {
        $result = Reservation::select('*')->where('ownerid', $id)->where('status', '=', 'Remaining')->get();
        $s = 0;
        foreach ($result as $sum) {
            $total_paid = $sum->total_paid;
            // echo $total_paid.',';
            $package_price = $sum->package_price;
            // echo $package_price.'=';
            if ($package_price > $total_paid) {
                $remaining_amt = $package_price - $total_paid;
            } else {
                $remaining_amt = $total_paid - $package_price;
            }
            // echo $remaining_amt.';';
            $s=$s + $remaining_amt;
            
        }
        return  $s;
    }
    public static function get_chalet_totalpaidremaining($id)
    {
        $result = Reservation::select('*')->where('chaletid', $id)->where('status', '=', 'Remaining')->get();
        $s = 0;
        foreach ($result as $sum) {
            $total_paid = $sum->total_paid;
            // echo $total_paid.',';
            $package_price = $sum->package_price;
            // echo $package_price.'=';
            if ($package_price > $total_paid) {
                $remaining_amt = $package_price - $total_paid;
            } else {
                $remaining_amt = $total_paid - $package_price;
            }
            // echo $remaining_amt.';';
            $s=$s + $remaining_amt;
            
        }
        return  $s;
    }
    public static function get_totalcommission()
    {
        $result = Reservation::select('*')->where('status', '=', 'Paid')->get();
        $sum = 0;
        foreach($result as $rdetails)
        {
            $commission=($rdetails->package_price * ($rdetails->comission_percentage/100) );
            // echo  $commission;
            $sum=$sum + $commission;

        }
        return $sum;
    }
    public static function total_depositdone()
    {
        // $totalp = Reservation::select('*')->where('owner_moneydeposit','=','0')->where('status', '=', 'Paid')->sum('total_paid');
        $totalcommission = Reservation::select('*')->where('owner_moneydeposit','=','1')->where('status', '=', 'Paid')->sum('owner_commission');
        $result=$totalcommission;
        return $result;
    }
    public static function total_deposittobedone()
    {
        // $totalp = Reservation::select('*')->where('owner_moneydeposit','=','0')->where('status', '=', 'Paid')->sum('total_paid');
        $totalcommission = Reservation::select('*')->where('owner_moneydeposit','=','0')->where('status', '=', 'Paid')->sum('owner_commission');
        $result=$totalcommission;
        return $result;
    }
    public static function get_count_userchaletreservation($id)
    {
        $count = Reservation::select('*')->where('userid', $id)->count();
        return $count;
    }
    public static function get_usertotalpaid($id)
    {
        $result = Reservation::select('*')->where('status', '=', 'Paid')->where('userid', $id)->count();
        return $result;
    }
    public static function get_usertotalunpaid($id)
    {
        $result = Reservation::select('*')->where('status', '=', 'Remaining')->where('userid', $id)->count();
        return $result;
    }
    public static function get_usertotalamount($id)
    {
        $result = Reservation::select('*')->where('status', '=', 'Paid')->where('userid', $id)->sum('total_paid');
        return $result;
    }
    public static function get_rewards($id)
    {
        $result = Rewards::select('*')->where('id', $id)->sum('rewarded_amt');
        return $result;
    }
    public static function total_regi_users()
    {
        $count = Users::select('*')->where('reg_status','1')->count();
        return $count;
    }
    public static function total_visitors()
    {
        $count = Users::select('*')->where('reg_status','0')->count();
        return $count;
    }
    public static function total_reservation()
    {
        $count = Reservation::select('*')->count();
        return $count;
    }
    public static function total_regi_users_month()
    {
        // $currentMonth = date('m');
        $currentMonth =  date('m', strtotime(date('Y-m')." -1 month"));
        // echo $currentMonth;
        $count = Users::select('*')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('reg_status','1')->count();
        return $count;
    }
    public static function total_regi_users_3month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')." -3 month"));
        $query =Users::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('reg_status',1); 
        $sql = Str::replaceArray('?', $query->getBindings(), $query->toSql());
        //  dd($sql);
        // $count = Users::select('*')->whereBetween('created_at', [$lastMonth,$currentMonth])->get();
         $count= Users::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('reg_status',1)->count();
        // print_r($count);
        return $count;
        
    }
    public static function total_regi_users_6month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')."-6 month"));
        // echo $currentMonth;
        $count= Users::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('reg_status',1)->count();
        // print_r($count);
        return $count;
    }
    public static function total_regi_users_year()
    {
        $currentYear = date('Y');
        $count = Users::select('*')->whereRaw('Year(created_at) = ?',[$currentYear])->where('reg_status','1')->count();
        return $count;
    }
    public static function total_regi_users_week()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);
        $count =   Users::whereBetween('created_at', [$start_week, $end_week])->where('reg_status','1')->count();
        return $count;
    }
    public static function total_visitors_month()
    {
        // $currentMonth = date('m');
        $currentMonth =  date('m', strtotime(date('Y-m')." -1 month"));
        // echo $currentMonth;
        $count = Users::select('*')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('reg_status','0')->count();
        return $count;
    }
    public static function total_visitors_3month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')." -3 month"));
         $count= Users::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('reg_status',0)->count();
        // print_r($count);
        return $count;
    }
    public static function total_visitors_6month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')."-6 month"));
        // echo $currentMonth;
        $count= Users::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('reg_status',0)->count();
        // print_r($count);
        return $count;
    }
    public static function total_visitors_year()
    {
        $currentYear = date('Y');
        $count = Users::select('*')->whereRaw('Year(created_at) = ?',[$currentYear])->where('reg_status','0')->count();
        return $count;
    }
    public static function total_visitors_week()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);
        $count =   Users::whereBetween('created_at', [$start_week, $end_week])->where('reg_status','0')->count();
        return $count;
    }
    public static function total_reservation_month()
    {
        // $currentMonth = date('m');
        $currentMonth =  date('m', strtotime(date('Y-m')." -1 month"));
        // echo $currentMonth;
        $count = Reservation::select('*')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->count();
        return $count;
    }
    public static function total_reservation_3month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')." -3 month"));
         $count= Reservation::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->count();
        // print_r($count);
        return $count;
    }
    public static function total_reservation_6month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')."-6 month"));
        // echo $currentMonth;
        $count= Reservation::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->count();
        // print_r($count);
        return $count;
    }
    public static function total_reservation_year()
    {
        $currentYear = date('Y');
        $count = Reservation::select('*')->whereRaw('Year(created_at) = ?',[$currentYear])->count();
        return $count;
    }
    public static function total_reservation_week()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);
        $count =   Reservation::whereBetween('created_at', [$start_week, $end_week])->count();
        return $count;
    }
    public static function get_totalpaidweek()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);
        $result = Reservation::select('*')->whereBetween('created_at', [$start_week, $end_week])->where('status', '=', 'Paid')->sum('total_paid');
        return $result;
    }
    public static function get_totalpaidmonth()
    {
        $currentMonth =  date('m', strtotime(date('Y-m')." -1 month"));
        $result = Reservation::select('*')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('status', '=', 'Paid')->sum('total_paid');
        return $result;
    }
    public static function get_totalpaid3month()
    { 
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')." -3 month"));
        $result = Reservation::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('status', '=', 'Paid')->sum('total_paid');
        return $result;
    }
    public static function get_totalpaid6month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')." -6 month"));
        $result = Reservation::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('status', '=', 'Paid')->sum('total_paid');
        return $result;
    }
    public static function get_totalpaidyear()
    {
        $currentYear = date('Y');
        $result = Reservation::select('*')->whereRaw('Year(created_at) = ?',[$currentYear])->where('status', '=', 'Paid')->sum('total_paid');
        return $result;
    }
    public static function get_totalcommissionmonth()
    {
        $currentMonth =  date('m', strtotime(date('Y-m')." -1 month"));
        $result = Reservation::select('*')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('status', '=', 'Paid')->get();
        $sum = 0;
        foreach($result as $rdetails)
        {
            $commission=($rdetails->package_price * ($rdetails->comission_percentage/100) );
            // echo  $commission;
            $sum=$sum + $commission;

        }
        return $sum;
    }
    public static function get_totalcommissionweek()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);
        $result = Reservation::select('*')->whereBetween('created_at', [$start_week, $end_week])->where('status', '=', 'Paid')->get();
        $sum = 0;
        foreach($result as $rdetails)
        {
            $commission=($rdetails->package_price * ($rdetails->comission_percentage/100) );
            // echo  $commission;
            $sum=$sum + $commission;

        }
        return $sum;
    }
    public static function get_totalcommission3month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')." -3 month"));
        $result = Reservation::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('status', '=', 'Paid')->get();
        $sum = 0;
        foreach($result as $rdetails)
        {
            $commission=($rdetails->package_price * ($rdetails->comission_percentage/100) );
            // echo  $commission;
            $sum=$sum + $commission;

        }
        return $sum;
    }
    public static function get_totalcommission6month()
    {
        $currentMonth = date('Y-m-d');
        $lastMonth =  date('Y-m-d', strtotime(date('Y-m-d')." -6 month"));
        $result = Reservation::select('*')->whereBetween('created_at', array($lastMonth, $currentMonth))->where('status', '=', 'Paid')->get();
        $sum = 0;
        foreach($result as $rdetails)
        {
            $commission=($rdetails->package_price * ($rdetails->comission_percentage/100) );
            // echo  $commission;
            $sum=$sum + $commission;

        }
        return $sum;
    }
    public static function get_totalcommissionyear()
    {
        $currentYear = date('Y');
        $result = Reservation::select('*')->whereRaw('Year(created_at) = ?',[$currentYear])->where('status', '=', 'Paid')->get();
        $sum = 0;
        foreach($result as $rdetails)
        {
            $commission=($rdetails->package_price * ($rdetails->comission_percentage/100) );
            // echo  $commission;
            $sum=$sum + $commission;

        }
        return $sum;
    }
}
