<?php

namespace App;

use App\Models\Chalet;
use App\Models\Reservation;
use App\Models\ChaletUpload;
use App\Models\HolidayAndEvents;
use App\Models\ChaletEvent;
use App\Models\Offers;
use App\Models\Users;

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
        $result = Reservation::select('*')->where('status', '=', 'Paid')->sum('owner_commission');
        return $result;
    }
    public static function total_deposittobedone()
    {
        $totalp = Reservation::select('*')->where('owner_moneydeposit','=','0')->where('status', '=', 'Paid')->sum('total_paid');
        $totalcommission = Reservation::select('*')->where('owner_moneydeposit','=','0')->where('status', '=', 'Paid')->sum('owner_commission');
        $result=$totalp-$totalcommission;
        return $result;
    }
}
