@extends('superadmin.layouts.sa_layout')
@section('title', 'Dashboard')
@section('content')
<!-- Dashboard-->
<div>
    <div class="x_panel">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert" align="center">
            {{ $message }}
        </div>
        @endif
        <div class="x_title">
            <h1>Dashboard</h1>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="1%">Mark</th>
                            <th width="28%">informations</th>
                            <th width="12%">Week</th>
                            <th width="12%">1 Month</th>
                            <th width="12%">3 Months</th>
                            <th width="12%">6 Months</th>
                            <th width="12%">Year</th>
                            <th width="12%">All Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-user" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <?php  $total_regi_users = (new \App\Helper)->total_regi_users();
                              $total_regi_users_month = (new \App\Helper)->total_regi_users_month();
                            $total_regi_users_3month = (new \App\Helper)->total_regi_users_3month();
                            $total_regi_users_6month = (new \App\Helper)->total_regi_users_6month();
                            $total_regi_users_year = (new \App\Helper)->total_regi_users_year();
                            $total_regi_users_week= (new \App\Helper)->total_regi_users_week();
                            ?>
                            <td>
                                <h4>Registered users</h4>
                            </td>
                            <td>
                                <h4>{{$total_regi_users_week}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_regi_users_month}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_regi_users_3month}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_regi_users_6month}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_regi_users_year}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_regi_users}}</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-users" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <?php  $total_visitors = (new \App\Helper)->total_visitors(); 
                             $total_visitors_month = (new \App\Helper)->total_visitors_month();
                             $total_visitors_3month = (new \App\Helper)->total_visitors_3month();
                             $total_visitors_6month = (new \App\Helper)->total_visitors_6month();
                             $total_visitors_year = (new \App\Helper)->total_visitors_year();
                             $total_visitors_week= (new \App\Helper)->total_visitors_week();
                            ?>
                            <td>
                                <h4>Total Visitors</h4>
                            </td>
                            <td>
                                <h4>{{$total_visitors_week}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_visitors_month}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_visitors_3month}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_visitors_6month}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_visitors_year}}</h4>
                            </td>
                            <td>
                                <h4>{{$total_visitors}}</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-users" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <?php  $total_reservation = (new \App\Helper)->total_reservation();
                             $total_reservation_month = (new \App\Helper)->total_reservation_month();
                             $total_reservation_3month = (new \App\Helper)->total_reservation_3month();
                             $total_reservation_6month = (new \App\Helper)->total_reservation_6month();
                             $total_reservation_year = (new \App\Helper)->total_reservation_year();
                             $total_reservation_week= (new \App\Helper)->total_reservation_week();
                            ?>
                            <td>
                                <h4>Total Reservations</h4>
                            </td>

                            <td>
                                <h4>{{$total_reservation_week}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_reservation_month}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_reservation_3month}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_reservation_6month}}</h4>
                            </td>

                            <td>
                                <h4>{{ $total_reservation_year}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_reservation}}</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="glyphicon glyphicon-shopping-cart" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <?php $total_paid = (new \App\Helper)->get_totalpaid(); 
                            $get_totalpaidweek = (new \App\Helper)->get_totalpaidweek(); 
                            $get_totalpaidmonth= (new \App\Helper)->get_totalpaidmonth(); 
                            $get_totalpaid3month= (new \App\Helper)->get_totalpaid3month(); 
                            $get_totalpaid6month= (new \App\Helper)->get_totalpaid6month();
                            $get_totalpaidyear= (new \App\Helper)->get_totalpaidyear();  
                            ?>
                            <td>
                                <h4>Total Amount Reservations ( KD )</h4>
                            </td>
                            <td>
                                <h4>{{$get_totalpaidweek}}</h4>
                            </td>
                            <td>
                                <h4>{{$get_totalpaidmonth}}</h4>
                            </td>

                            <td>
                                <h4>{{$get_totalpaid3month}}</h4>
                            </td>

                            <td>
                                <h4>{{$get_totalpaid6month}}</h4>
                            </td>

                            <td>
                                <h4>{{$get_totalpaidyear}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_paid}}</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-dollar" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <?php $total_commission= (new \App\Helper)->get_totalcommission(); 
                             $total_commissionmonth= (new \App\Helper)->get_totalcommissionmonth(); 
                             $total_commissionweek= (new \App\Helper)->get_totalcommissionweek(); 
                             $total_commission3month= (new \App\Helper)->get_totalcommission3month(); 
                             $total_commission6month= (new \App\Helper)->get_totalcommission6month(); 
                             $total_commissionyear= (new \App\Helper)->get_totalcommissionyear(); 
                            ?>
                            <td>
                                <h4>Total Commission income ( KD ) </h4>
                            </td>

                            <td>
                                <h4>{{$total_commissionweek}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_commissionmonth}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_commission3month}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_commission6month}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_commissionyear}}</h4>
                            </td>

                            <td>
                                <h4>{{$total_commission}}</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-dollar" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <td>
                                <h2>Total Amount after Commission ( KD ) </h2>
                            </td>
                            <td>
                            <h4>
                                @if($get_totalpaidweek>$total_commissionweek) 
                               {{$get_totalpaidweek-$total_commissionweek}}
                               @else
                               {{$total_commissionweek-$get_totalpaidweek}}
                               @endif
                                </h4>
                            </td>

                            <td>
                            <h4>
                                @if($get_totalpaidmonth>$total_commissionmonth) 
                               {{$get_totalpaidmonth-$total_commissionmonth}}
                               @else
                               {{$total_commissionmonth-$get_totalpaidmonth}}
                               @endif
                                </h4>
                            </td>

                            <td>
                                <h4>
                                @if($get_totalpaid3month>$total_commission3month) 
                               {{$get_totalpaid3month-$total_commission3month}}
                               @else
                               {{$total_commission3month-$get_totalpaid3month}}
                               @endif
                                </h4>
                            </td>

                            <td>
                                <h4>
                                @if($get_totalpaid6month>$total_commission6month) 
                               {{$get_totalpaid6month-$total_commission6month}}
                               @else
                               {{$total_commission6month-$get_totalpaid6month}}
                               @endif
                                </h4>
                            </td>

                            <td>
                                <h4>
                                @if($total_paid>$total_commissionyear) 
                               {{$total_paid-$total_commissionyear}}
                               @else
                               {{$total_commissionyear-$total_paid}}
                               @endif
                                </h4>
                            </td>

                            <td>
                                <h4>
                               @if($get_totalpaidyear>$total_commission) 
                               {{$get_totalpaidyear-$total_commission}}
                               @else
                               {{$total_commission-$get_totalpaidyear}}
                               @endif
                                </h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h3>
                                    <div align="center" class="icon"><i class="fa fa-dollar" style="padding-bottom: 10px"></i></div>
                                </h3>
                            </td>

                            <td colspan="7">
                            <?php  $total_deposittobedone = (new \App\Helper)->total_deposittobedone(); ?>
                                <h3>Total amounts to be Deposited To Owner ( KD ) : <a class="btn btn-danger btn" href="{{ url('/Deposited-Money-To-Owner') }}">{{$total_deposittobedone}} KD</a> </h3>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <br>
                <div class="x_title">
                    <h1 style="color: #B10622">Awaiting Acceptance of the owner</h1>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No.</th>
                                <th width="15%">User Details</th>
                                <th width="20%">Booking Details</th>
                                <th width="25%">Price</th>
                                <th width="15%">Owner Details</th>
                                <th width="15%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservationlist as $rdetails)
                            <?php $userdetails = (new \App\Helper)->get_user_details($rdetails->userid); ?>
                            <?php $ownerdetails = (new \App\Helper)->get_owner_details($rdetails->ownerid); ?>
                            <tr>
                                <td>{{$rdetails->reservation_id}}</td>
                                <td>
                                    <address>
                                        <b>{{$userdetails->first_name}}&nbsp;{{$userdetails->last_name}}</b>
                                        <br>{{$userdetails->gender}}
                                        <br>{{$userdetails->country}}
                                        <br>Email:{{$userdetails->email}}
                                        <br>Mobile:{{$userdetails->country_code}}{{$userdetails->phone}}
                                    </address>
                                </td>
                                <td>
                                    <strong>{{$rdetails->chalet_name}}</strong>
                                    <br><br>
                                    <b style="color: limegreen">Check-in</b>: {{$rdetails->check_in}}
                                    <br>
                                    <b style="color: red">Check-Out</b>: {{$rdetails->check_out}}
                                </td>
                                <td>
                                    <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td width="60%">
                                                <ul>
                                                    <li>Rental price</li>
                                                    <li>Deposit</li><br>
                                                    <li>Rewards ( Discount )</li>
                                                    <li>Offers ( Discount )</li><br>
                                                    <li>Total Paid</li>
                                                    <li>Remaining:</li>
                                                </ul>
                                            </td>
                                            <td width="100%" valign="top">
                                                : <strong>{{$rdetails->package_price}} KD </strong><br>
                                                : <b style="color: #FF9933">{{$rdetails->deposit}} KD </b><br><br>
                                                : -@if(!empty($rdetails->reward_discount)){{$rdetails->reward_discount}}@else {{0}} @endif KD<br>
                                                : -@if(!empty($rdetails->offer_discount)){{$rdetails->offer_discount}}@else {{0}} @endif KD<br><br>
                                                : <b style="color: limegreen">{{$rdetails->total_paid}} KD </b><br>
                                                <?php //echo $rdetails->package_price-$rdetails->total_paid; 
                                                ?>
                                                : <b style="color: orangered">{{$rdetails->package_price-$rdetails->total_paid}} KD </b><br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <address>
                                        <b>{{$ownerdetails->first_name}}&nbsp;{{$ownerdetails->last_name}}</b>
                                        <br>{{$ownerdetails->gender}}
                                        <br>{{$ownerdetails->country}}
                                        <br>Email:{{$ownerdetails->email}}
                                        <br>Mobile:{{$ownerdetails->country_code}}{{$ownerdetails->phone}}
                                    </address>
                                </td>
                                <td>
                                    <?php
                                    if ($rdetails->createdat > date('Y-m-d H:i:s')) {
                                        $seconds  =  strtotime($rdetails->createdat) - strtotime(date('Y-m-d H:i:s'));
                                    } else {
                                        $seconds  =  strtotime(date('Y-m-d H:i:s')) - strtotime($rdetails->createdat);
                                    }

                                    $months = floor($seconds / (3600 * 24 * 30));
                                    $day = floor($seconds / (3600 * 24));
                                    $hours = floor($seconds / 3600);
                                    $mins = floor(($seconds - ($hours * 3600)) / 60);
                                    $secs = floor($seconds % 60);

                                    if ($seconds < 60)
                                        $time = $secs . " seconds ago";
                                    else if ($seconds < 60 * 60)
                                        $time = $mins . " min ago";
                                    else if ($seconds < 24 * 60 * 60)
                                        $time = $hours . " hours ago";
                                    else if ($seconds < 24 * 60 * 60)
                                        $time = $day . " day ago";
                                    else
                                        $time = $months . " month ago";
                                    // echo $time;
                                    // echo $hours.'hr '.$mins.'m ';
                                    ?>
                                    <button style="width: 100%"><?php echo $hours . ':' . $mins . ' '; ?> Ago</button>
                                    <br><br>
                                    <?php $rid = base64_encode($rdetails->rid); ?>
                                    <!-- style= "width: 100px;font-size: 15px; height: 30px;" -->
                                    <!-- <button class="btn btn-success btn" onclick="window.location.href='#';" ><i class="fa fa-check-circle"></i> Accept</button> -->
                                    <a class="btn btn-success btn" href="{{ url('/accept_reject_booking') }}/<?php echo $rid; ?>/<?php echo '0'; ?>" style="width: 100%"><i class="fa fa-check-circle"></i> Accept</a>
                                    <br><br>
                                    <!-- <button class="btn btn-danger btn" onclick="window.location.href='#';" style="width: 100%"><i class="fa fa-times-circle"></i> Reject </button> -->
                                    <a class="btn btn-danger btn" href="{{ url('/accept_reject_booking') }}/<?php echo $rid; ?>/<?php echo '1'; ?>" style="width: 100%"><i class="fa fa-times-circle"></i> Reject</a>

                                </td>
                                <td align="center">
                                    <?php $userid = base64_encode($userdetails->id); ?>
                                    <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>
                                    <br><a class="btn btn-primary btn-xs" href="{{ url('/user-profile') }}/<?php echo $userid; ?>">User Profile</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="x_title">
                    <h1 style="color: #B10622">Remaining Amounts</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th width="15%">User Details</th>
                                    <th width="20%">Booking Details</th>
                                    <th width="25%">Price</th>
                                    <th width="15%">Time Expires</th>
                                    <th width="15%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($remaining_list as $rdetails)
                                <?php $userdetails = (new \App\Helper)->get_user_details($rdetails->userid); ?>
                                <tr>
                                    <td>{{$rdetails->reservation_id}}</td>
                                    <td>
                                        <address>
                                            <b>{{$userdetails->first_name}}&nbsp;{{$userdetails->last_name}}</b>
                                            <br>{{$userdetails->gender}}
                                            <br>{{$userdetails->country}}
                                            <br>Email:{{$userdetails->email}}
                                            <br>Mobile:{{$userdetails->country_code}}{{$userdetails->phone}}
                                        </address>
                                    </td>
                                    <td>
                                        <strong>{{$rdetails->chalet_name}}</strong>
                                        <br><br>
                                        <b style="color: limegreen">Check-in</b>: {{$rdetails->check_in}}
                                        <br>
                                        <b style="color: red">Check-Out</b>: {{$rdetails->check_out}}
                                    </td>
                                    <td>
                                        <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td width="60%">
                                                    <ul>
                                                        <li>Rental price</li>
                                                        <li>Deposit</li><br>
                                                        <li>Rewards ( Discount )</li>
                                                        <li>Offers ( Discount )</li><br>
                                                        <li>Total Paid</li>
                                                        <li>Remaining:</li>
                                                    </ul>
                                                </td>
                                                <td width="100%" valign="top">
                                                    : <strong>{{$rdetails->package_price}} KD </strong><br>
                                                    : <b style="color: #FF9933">{{$rdetails->deposit}} KD </b><br><br>
                                                    : -@if(!empty($rdetails->reward_discount)){{$rdetails->reward_discount}}@else {{0}} @endif KD<br>
                                                    : -@if(!empty($rdetails->offer_discount)){{$rdetails->offer_discount}}@else {{0}} @endif KD<br><br>
                                                    : <b style="color: limegreen">{{$rdetails->total_paid}} KD </b><br>
                                                    <?php //echo $rdetails->package_price-$rdetails->total_paid; 
                                                    ?>
                                                    : <b style="color: orangered">{{$rdetails->package_price-$rdetails->total_paid}} KD </b><br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="center">
                                        <?php
                                        // $datetime='2021-05-19 05:23:00';
                                        $expiry = $admindata->remaining_amt_pay;
                                        // echo  date('H:i:s', strtotime($rdetails->checkin_time));
                                        $date_time = date("Y-m-d H:i:s", strtotime($rdetails->check_in . ' ' . $rdetails->checkin_time));
                                        // echo $date_time;
                                        $timestamp = strtotime($date_time);
                                        $etime = $timestamp - ($expiry * 60 * 60);
                                        // echo date("Y-m-d H:i:s", $time);
                                        //Print it out in a human-readable format.
                                        // echo date("M d,Y H:i:s", $time);
                                        $end_date = date("Y/m/d - H:i:s", $etime);
                                        $enddate = date("Y-m-d H:i:s", $etime);
                                        // echo $enddate;
                                        // die();
                                        // $current_date= date('Y-m-d H:i:s');
                                        if ($enddate > date('Y-m-d H:i:s')) {
                                            $seconds  =  strtotime($enddate) - strtotime(date('Y-m-d H:i:s'));
                                        } else {
                                            $seconds  =  strtotime(date('Y-m-d H:i:s')) - strtotime($enddate);
                                        }

                                        $months = floor($seconds / (3600 * 24 * 30));
                                        $day = floor($seconds / (3600 * 24));
                                        $hours = floor($seconds / 3600);
                                        $mins = floor(($seconds - ($hours * 3600)) / 60);
                                        $secs = floor($seconds % 60);

                                        if ($seconds < 60)
                                            $time = $secs . " seconds ago";
                                        else if ($seconds < 60 * 60)
                                            $time = $mins . " min ago";
                                        else if ($seconds < 24 * 60 * 60)
                                            $time = $hours . " hours ago";
                                        else if ($seconds < 24 * 60 * 60)
                                            $time = $day . " day ago";
                                        else
                                            $time = $months . " month ago";
                                        // echo $hours;
                                        ?>
                                        @if($hours>5)
                                        <button style="width: 100%"><?php echo $end_date; ?></button>
                                        @else
                                        <button class="btn btn-danger btn" style="width: 100%"><?php echo $end_date; ?></button>

                                        @endif

                                        <br>
                                        <br>
                                        <?php $r_id = base64_encode($rdetails->reservation_id); 
                                        $cname = base64_encode($rdetails->chalet_name); 
                                        $edate=base64_encode($end_date);
                                        $uid=base64_encode($rdetails->userid);
                                        ?>
      <a class="btn btn-primary btn" href="{{ url('/send_reminder') }}/<?php echo $r_id; ?>/<?php echo $cname; ?>/<?php echo $edate; ?>/<?php echo $uid; ?>" style="width: 100%">Send Reminders</a>
                                    </td>
                                    <td>
                                        <?php $id = base64_encode($rdetails->rid); ?>
                                        <a class="btn btn-warning btn-xs" href="{{ url('/Invoice') }}/<?php echo $id; ?>">Paid ( Remaining )</a>
                                    </td>
                                    <td align="center">
                                        <?php $userid = base64_encode($userdetails->id); ?>
                                        <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>
                                        <br><a class="btn btn-primary btn-xs" href="{{ url('/user-profile') }}/<?php echo $userid; ?>">User Profile</a>
                                    </td>

                                </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard-->
    </div>
    <!-- /User Blocked -->
</div>
@endsection