@extends('superadmin.layouts.sa_layout')
@section('title', 'Rejected List')
@section('content')
<!-- Dashboard-->
<div>
    <div class="x_panel">
        <div class="x_content">
            <div>
                <div class="x_title">
                    <h1>Rejected List</h1>
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
                            @foreach($rejectlist as $rdetails)
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
                                    <i class="fa fa-times-circle"></i>
                                    @if($rdetails->canceled_by==0)
                                    <b>Reject By Admin</b>
                                    @elseif($rdetails->canceled_by==1)
                                    <b>Reject By Owner</b>
                                    @endif
                                    <br>
                                    <?php  
                                   echo date('Y/m/d - H:i:s A', strtotime($rdetails->rejected_at))
                                   ?>
                                    <hr>
                                    <b>Refund Money :</b>
                                    <br>
                                    @if($rdetails->refund_status==0)
                                    <b style="color: #FF9933">Processing </b>
                                    @elseif($rdetails->refund_status==1)
                                    <b style="color: limegreen">{{$rdetails->total_paid}} KD </b> ( Book )
                                    @if(!empty($rdetails->reward_discount))
                                    <br>
                                    <b style="color: limegreen">{{$rdetails->reward_discount}} KD </b> ( Rewards )
                                    @endif
                                    <br> 
                                   <?php  
                                   echo date('Y/m/d', strtotime($rdetails->refund_date)).' - '.date('H:i:s A', strtotime($rdetails->refund_time));
                                   ?>
                                    @endif
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
        <!-- Dashboard-->
    </div>
    <!-- /User Blocked -->
</div>
@endsection