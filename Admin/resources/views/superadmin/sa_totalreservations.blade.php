@extends('superadmin.layouts.sa_layout')
@section('title', "Total Reservations of Chalet")
@section('content')

<!-- bootstrap-wysiwyg -->
<!-- <link href="{{url('vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet"> -->
<!-- Select2 -->
<!-- <link href="{{url('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet"> -->
<!-- Switchery -->
<link href="{{url('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
<!-- starrr -->
<!-- <link href="{{url('vendors/starrr/dist/starrr.css')}}" rel="stylesheet"> -->
<!-- bootstrap-daterangepicker -->
<!-- <link href="{{url('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"> -->
<!-- page content -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .lds-hourglass {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        /* position: absolute;
    margin-left:627px;
    margin-top:290px;*/
    }

    .lds-hourglass:after {
        content: " ";
        display: block;
        border-radius: 50%;
        width: 0;
        height: 0;
        margin: 8px;
        box-sizing: border-box;
        border: 32px solid #fff;
        border-color: #2A3F54 transparent #2A3F54 transparent;
        animation: lds-hourglass 1.2s infinite;
        margin-left: 457px;
    }

    @keyframes lds-hourglass {
        0% {
            transform: rotate(0);
            animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
        }

        50% {
            transform: rotate(900deg);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        100% {
            transform: rotate(1800deg);
        }
    }

    table.dataTable thead .sorting_asc:after {
        content: "\e155";
        display: none;
    }
</style>
<div>
    <!-- /User Blocked -->
    <div class="x_panel">
        <div class="x_title">
            <h1>Total Reservations of Chalet</h1>
        </div>
        <div class="x_content">
            <div class="col-md-6 col-sm-12 col-xs-6">
                <h3>Chalet Details</h3>
                <address>
                    <b>Chalet Name</b>
                    <br>Owner:{{$ownerdetails->first_name}}&nbsp;{{$ownerdetails->last_name}}
                    <br>{{$ownerdetails->gender}}
                    <br>{{$ownerdetails->country}}
                    <br>Email: {{$ownerdetails->email}}
                    <br>Mobile: {{$ownerdetails->country_code}}{{$ownerdetails->phone}}
                    <br>Commission: <b style="color: orangered">-10%</b>
                </address>
            </div><!-- /.col -->
            <div class="col-md-6 col-sm-12 col-xs-6">
                <h3>Reservations information</h3>
                <address>
                    Total Reservations : <button class="btn btn-info btn-xs" onclick="window.location.href='Total-Reservations.php';">6</button>
                    <br>Total <b style="color: limegreen">PAID </b>: <button class="btn btn-success btn-xs" onclick="window.location.href='Chalet-Invoices-PAID.php';">4</button>
                    <br>Total <b style="color: orangered">UnPaid </b>: <button class="btn btn-danger btn-xs" onclick="window.location.href='Chalet-Invoices-UnPaid.php';">1</button>
                    <br>Total <b style="color: #FF9933">Remaining </b>: <button class="btn btn-warning btn-xs" onclick="window.location.href='Chalet-Invoices-Remaining.php';">1</button>
                    <br>Total Amount : <strong>3.000</strong> KD
                    <br>Total Commission : <strong>300</strong> KD
                    <br>Total Amount after Commission : <strong>1.700</strong> KD
                    <br>Total amounts to be Transferred : <button class="btn btn-danger btn-xs" onclick="window.location.href='Chalet-List.php';">500 KD</button>
                </address>
            </div>
<div>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="1%">No.</th>
                            <th width="30%">Chalet Name</th>
                            <th width="30%">Booking Details</th>
                            <th width="30%">Price</th>
                            <th width="5%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
<tbody>
@foreach($reservationlist as $rdetails)
<?php $userdetails = (new \App\Helper)->get_user_details($rdetails->userid);?>
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
                                <strong> @if($rdetails->selected_package == 'week_rent')
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
                                <b style="color: red">Check-Out</b>:{{$rdetails->check_out}}
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
                                            : <b style="color: orangered">{{$rdetails->package_price-$rdetails->total_paid}} KD </b><br>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                            <?php $id = base64_encode($rdetails->rid); ?>
                                @if($rdetails->status=='Remaining')
                                <a class="btn btn-warning btn-xs" href="{{ url('/Invoice') }}/<?php echo $id; ?>">Paid ( Remaining )</a
                                @endif
                                @if($rdetails->status=='Paid')
                                <a class="btn btn-success btn-xs" href="{{ url('/Invoice') }}/<?php echo $id; ?>">Paid</a>
                                @endif
                                @if(empty($rdetails->status))
                                <a class="btn btn-danger btn-xs" href="{{ url('/Invoice') }}/<?php echo $id; ?>">UnPaid</a>
                                @endif
                            </td>
                            <td>
                            <?php $userid = base64_encode($userdetails->id); ?>
                            <?php $id = base64_encode($rdetails->cid); $page = base64_encode('totalreservation');?>
                            <a class="btn btn-primary btn-xs" href="{{ url('/Chalet-edit') }}/<?php echo $id; ?>/<?php echo $page; ?>" >Edit Chalet</a>
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
<script type="text/javascript">
    function myFunction($cid, $field) {
        // alert($cid)
        $tid = "#" + $field;
        if ($($tid).prop('checked') == true) {
            $($tid).prop('checked', true);
            // alert("now checked");
            var check = 1;
        } else {
            // alert("now un-checked");
            $($tid).prop('checked', false);
            var check = 0;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert(check);
        var status = check;
        var chaletid = $cid;
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_chaletstatus') }}",
            data: {
                is_activestatus: status,
                chaletid: chaletid
            },
            beforeSend: function() {
                // Show image container
                $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);

            },
            complete: function(data) {
                // Hide image container
                $("#loader1").hide();
            }
        });

        // });
    }

    function mybookingFunction($cid, $field) {
        // alert($cid)
        $tid = "#" + $field;
        if ($($tid).prop('checked') == true) {
            $($tid).prop('checked', true);
            // alert("now checked");
            var check = 1;
        } else {
            // alert("now un-checked");
            $($tid).prop('checked', false);
            var check = 0;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert(check);
        var status = check;
        var chaletid = $cid;
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_bookingstatus') }}",
            data: {
                bookingstatus: status,
                chaletid: chaletid
            },
            beforeSend: function() {
                // Show image container
                $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);

            },
            complete: function(data) {
                // Hide image container
                $("#loader1").hide();
            }
        });

        // });
    }
</script>
<!-- /User Blocked -->
<!-- bootstrap-progressbar -->
<!-- <script src="{{url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script> -->
<!-- iCheck -->
<script src="{{url('vendors/iCheck/icheck.min.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{url('vendors/moment/min/moment.min.js')}}"></script>
<!-- <script src="{{url('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script> -->
<!-- bootstrap-wysiwyg -->
<!-- <script src="{{url('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script> -->
<!-- <script src="{{url('vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script> -->
<!-- <script src="{{url('vendors/google-code-prettify/src/prettify.js')}}"></script> -->
<!-- jQuery Tags Input -->
<!-- <script src="{{url('vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script> -->
<!-- Switchery -->
<script src="{{url('vendors/switchery/dist/switchery.min.js')}}"></script>
<!-- Select2 -->
<!-- <script src="{{url('vendors/select2/dist/js/select2.full.min.js')}}"></script> -->
<!-- Parsley -->
<!-- <script src="{{url('vendors/parsleyjs/dist/parsley.min.js')}}"></script> -->
<!-- Autosize -->
<!-- <script src="{{url('vendors/autosize/dist/autosize.min.js')}}"></script> -->
<!-- jQuery autocomplete -->
<!-- <script src="{{url('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script> -->
<!-- starrr -->
<!-- <script src="{{url('vendors/starrr/dist/starrr.js')}}"></script> -->

@endsection