@extends('superadmin.layouts.sa_layout')
@section('title', "All Remaining of Chalet's")
@section('content')
<!-- page content -->
<div class="x_panel">
    <div class="alert alert-danger" role="alert" align="center">
        The reservation was canceled, and the amount of (KD 200) and Refund to khalifa Yousef ALqenaei
        <br>
        For Chalet ( Chalet Name )
        <!-- Please hide note -->
        <hr>
        <i>Note:</i> 1 - Return the money manually by contacting the customer by phone
        <br>
        2 - The amount cannot be refunded yet Check-Out Date
        <!-- Please hide note -->
    </div>
</div>
<div>
    <!-- /User Blocked -->
    <div class="x_panel">
        <div class="x_title">
            <h1>All <b style="color: #FF9933">Deposits</b> of Chalet's </h1>
        </div>
        <?php $total_paid = (new \App\Helper)->get_totalpaid();
        $total_unpaid = (new \App\Helper)->get_totalunpaid();
        $total_deposit = (new \App\Helper)->get_totaldeposit();
        $total_reward = (new \App\Helper)->get_totalreward();
        $total_offer = (new \App\Helper)->get_totaloffer();
        // echo $total_paid;die();
        ?>
        <div class="x_content">
            <!-- /.col -->
            <div class="col-md-6 col-sm-12 col-xs-6">
                <h3>Reservations information</h3>
                <address>
                    <br>Total Amount of <b style="color: limegreen">PAID </b>: <button>{{$total_paid}}</button> KD
                    <br>Total Amount of <b style="color: orangered">UnPaid </b>: <button>{{$total_unpaid}}</button> KD
                    <br>Total Amount of <b style="color: #FF9933">Deposits </b>: <button>{{$total_deposit }}</button> KD
                    <br>Total Amount of <b>Reward </b>: <button>{{$total_reward}}</button> KD
                    <br>Total Amount of <b>Offers </b>: <button>{{$total_offer}}</button> KD
                    <br>
                    <br>
                    <br>
                </address>
            </div>
            <div>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="1%">No.</th>
                            <th width="30%">User Details</th>
                            <th width="30%">Booking Details</th>
                            <th width="30%">Price</th>
                            <th width="5%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reservationlist as $rdetails)
                        <?php $userdetails = (new \App\Helper)->get_user_details($rdetails->userid);
                        // print_r($package_price); die(); 
                        // echo $userdetail[first_name];
                        ?>
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
                                <strong>
                                    @if($rdetails->selected_package == 'week_rent')
                                    Week
                                    @elseif($rdetails->selected_package == 'weekend_rent')
                                    Weekend
                                    @else
                                    Weekday
                                    @endif
                                </strong>
                                <br>
                                <b style="color: limegreen">Check-in</b>: {{$rdetails->check_in}}
                                <br>
                                <b style="color: red">Check-Out</b>: {{$rdetails->check_out}}
                            </td>
                            <td>
                                <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td width="0">
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
                            <button class="btn btn-warning btn-xs" onclick="window.location.href='Invoic-Paid-Remaining.php';">Paid ( Remaining )</button>
                            <?php $id = base64_encode($rdetails->rid); ?>
                                <a class="btn btn-success btn-xs" href="{{ url('/Invoice') }}/<?php echo $id; ?>">Paid</a>
                            </td>
                            <td>
                                <?php $userid = base64_encode($userdetails->id); ?>
                                <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>
                                <br><a class="btn btn-primary btn-xs" href="{{ url('/user-profile') }}/<?php echo $userid; ?>">User Profile</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
    </div>
</div>
<!-- /User Blocked -->
@endsection