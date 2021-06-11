<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Chalet;
use App\Models\Reservation;
use App\Models\HolidayAndEvents;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{

    public function calendarlist(Request $request)
    {

        $month = $request->month;
        $year = $request->year;
        $package = $request->package;
        $holidays = HolidayAndEvents::whereYear('check_in', '=', $year)->whereMonth('check_in', '=', $month)->get();

        // start with empty results
        $resultDate = "";
        $resultDays = "";
        // determine the number of days in the month
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($i = 1; $i <= $daysInMonth; $i++) {
            // create a cell for the day and for the date
            // $resultDate .= "<td>".sprintf('%02d', $i)."</td>";
            // $resultDays .= "<td>".date("l", mktime(0, 0, 0, $month, $i, $year))."</td>";
            $resultDate = sprintf('%02d', $i);
            $resultDays = date("l", mktime(0, 0, 0, $month, $i, $year));
            if ($package == "weekdays") {
                if (($resultDays == 'Sunday') || ($resultDays == "Monday") || ($resultDays == "Tuesday") || ($resultDays == "Wednesday")) {
                    $date_result[] = array(
                        'date' => $year . '-' . $month . '-' . $resultDate,
                        'day' => $resultDays
                    );
                }
            } else if ($package == "weekend") {
                if (($resultDays == 'Thursday') || ($resultDays == "Friday") || ($resultDays == "Saturday")) {
                    $date_result[] = array(
                        'date' => $year . '-' . $month . '-' . $resultDate,
                        'day' => $resultDays
                    );
                }
            } else if ($package == "weekA") {
                if (($resultDays == 'Sunday') || ($resultDays == "Monday") || ($resultDays == "Tuesday") || ($resultDays == "Wednesday") || ($resultDays == 'Thursday') || ($resultDays == "Friday") || ($resultDays == "Saturday")) {
                    $date_result[] = array(
                        'date' => $year . '-' . $month . '-' . $resultDate,
                        'day' => $resultDays
                    );
                }
            } else if ($package == "weekB") {
                if (($resultDays == 'Thursday') || ($resultDays == "Friday") || ($resultDays == "Saturday") ||  ($resultDays == 'Sunday') || ($resultDays == "Monday") || ($resultDays == "Tuesday") || ($resultDays == "Wednesday")) {
                    $date_result[] = array(
                        'date' => $year . '-' . $month . '-' . $resultDate,
                        'day' => $resultDays
                    );
                }
            }
        }
        // return the result wrapped in a table

        // return $date_result;
        if ($package != "holidays") {
            foreach ($date_result as $date) {
                if ($package == "weekdays") {
                    if ($date['day'] == 'Sunday') {
                        $startdate[] = $date['date'];
                    }
                    if ($date['day'] == 'Wednesday') {
                        $enddate[] = $date['date'];
                    }
                }
                if ($package == "weekend") {
                    if ($date['day'] == 'Thursday') {
                        $startdate[] = $date['date'];
                    }
                    if ($date['day'] == 'Saturday') {
                        $enddate[] = $date['date'];
                    }
                }
                if ($package == "weekA") {
                    if ($date['day'] == 'Sunday') {
                        $sdate = $date['date'];
                        $startdate[] = $date['date'];
                        $sdate = strtotime($sdate);
                        $enddate[] = date("Y-m-d", strtotime("+6 day", $sdate));
                    }
                }
                if ($package == "weekB") {
                    if ($date['day'] == 'Thursday') {
                        $sdate = $date['date'];
                        $startdate[] = $date['date'];
                        $sdate = strtotime($sdate);
                        $enddate[] = date("Y-m-d", strtotime("+6 day", $sdate));
                    }
                }
            }
        }
        if ($package == "holidays") {

            foreach ($holidays as $h) {
                $key = date('Y-m-d', strtotime($h['check_in']));
                $value = date('Y-m-d', strtotime($h['check_out']));
                $startdate[] = $key;
                $enddate[] = $value;
            }
        }
        // print_r($startdate);
        // print_r($enddate);
        // die();
        if ((sizeof($startdate)) > (sizeof($enddate))) {
            // echo "greater";
            $length = sizeof($enddate);
            $startdate = array_slice($startdate, 0, $length);
            $timeperiod = array_combine($startdate, $enddate);
        } else if ((sizeof($startdate)) == (sizeof($enddate))) {
            // echo "equal";
            $timeperiod = array_combine($startdate, $enddate);
        } else if ((sizeof($enddate)) > (sizeof($startdate))) {

            $length = sizeof($startdate);
            $enddate = array_slice($enddate, 1);
            $timeperiod = array_combine($startdate, $enddate);
        }
        // print_r($enddate);
        // print_r($timeperiod);die();
        foreach ($timeperiod as $key => $value) {
            $start_date = $key;
            $end_date = $value;
            // echo $start_date. '==>'.$end_date.'</br>  ';
            $chaletlist = Chalet::select('id')->get();
            $chaletcount = Chalet::select('*')->count();
            // print_r($chaletcount);die();
            $result_count = 0;
            foreach ($chaletlist as $c) {
                $cid = $c['id'];
                // echo $cid.'=>';
                //search code
                $resultcount = Reservation::where('check_in', $start_date)->where('check_out', $end_date)->where('chaletid', $cid)->count();
                // print_r($resultcount);echo ',';
                $result_count = $resultcount + $result_count;
                //
            }
            // print_r($result_count);die();
            if ($chaletcount == $result_count) {
                //    echo "no chalets available";
                $resultdates[] = array(
                    'start_date'=>$start_date,
                    'end_date'=>$end_date,
                    'package_period' => $start_date . ' to ' . $end_date,
                    'available_status' => true
                );
            } else {
                // echo "chalets available";
                $resultdates[] = array(
                    'start_date'=>$start_date,
                    'end_date'=>$end_date,
                    'package_period' => $start_date . ' to ' . $end_date,
                    'available_status' => false
                );
            }
            //    die();
        }
        // print_r($resultdates);die();
        $post = array(
            'status'  => true,
            'message' => 'success',
            'data' => $resultdates
        );
        return json_encode($post);
    }
}
