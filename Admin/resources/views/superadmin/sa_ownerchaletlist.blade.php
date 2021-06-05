@extends('superadmin.layouts.sa_layout')
@section('title', "Owner chalets list")
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
            <h1>Owner chalets list</h1>
        </div>
        <!-- Image loader -->
        <div id='loader1' class="lds-hourglass" style="display:none;"></div>
        <!-- Image loader -->
        <div class="x_content">
            <div class="col-md-6 col-sm-12 col-xs-6">
                <h3>Owner Details</h3>
                <address>
                    <b>{{$ownerdetails->first_name}}&nbsp;{{$ownerdetails->last_name}}</b>
                    <br>{{$ownerdetails->gender}}
                    <br>{{$ownerdetails->country}}
                    <br>Email:{{$ownerdetails->email}}
                    <br>Mobile: {{$ownerdetails->country_code}}{{$ownerdetails->phone}}
                    <br>
                    <?php $id = base64_encode($ownerdetails->id); ?>
                    <a class="btn btn-success btn-xs" href="{{ url('/Owner-profile') }}/<?php echo $id; ?>">Profile</a>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-md-6 col-sm-12 col-xs-6">
                <h3>Reservations information</h3>
                <address>
                    Total Reservations :<a class="btn btn-info  btn-xs" href="{{ url('/Total-Reservations') }}/<?php echo $id; ?>">{{(new \App\Helper)->get_count_chaletreservation($ownerdetails->id) }}</a>
                    <br>Total <b style="color: limegreen">PAID </b>:
                    <a class="btn btn-success  btn-xs" href="{{ url('/Owner-Invoices-Total-PAID') }}/<?php echo $id; ?>">{{(new \App\Helper)->get_count_paidchaletreservation($ownerdetails->id) }}</a>
                    <br>Total <b style="color: orangered">UnPaid </b>:
                    <a class="btn btn-danger  btn-xs" href="{{ url('/Owner-Invoices-Total-UnPaid') }}/<?php echo $id; ?>">{{(new \App\Helper)->get_count_unpaidchaletreservation($ownerdetails->id) }}</a>
                    <br>Total <b style="color: #FF9933">Deposits </b>:
                    <a class="btn btn-warning  btn-xs" href="{{ url('/Owner-Invoices-Total-Remaining') }}/<?php echo $id; ?>">{{(new \App\Helper)->get_count_unpaidchaletreservation($ownerdetails->id) }}</a>

                    <br>Total Amount : <strong> {{(new \App\Helper)->get_owner_totalpaid($ownerdetails->id) }}</strong> KD

                    <br>Total Commission : <strong> {{(new \App\Helper)->get_owner_commission($ownerdetails->id) }}</strong> KD

                    <br>Total Amount after Commission : <strong>
                        @if((new \App\Helper)->get_owner_totalpaid($ownerdetails->id) >(new \App\Helper)->get_owner_commission($ownerdetails->id))
                        {{(new \App\Helper)->get_owner_totalpaid($ownerdetails->id)-(new \App\Helper)->get_owner_commission($ownerdetails->id)}}
                        @else{
                        {{(new \App\Helper)->get_owner_commission($ownerdetails->id)-(new \App\Helper)->get_owner_totalpaid($ownerdetails->id)}}
                        }
                        @endif
                    </strong> KD

                    <br>Total Amounts to be Transferred :
                    <?php $wid = base64_encode($ownerdetails->id); ?>
                    <a class="btn btn-danger  btn-xs" href="{{ url('/Chalet-List') }}/<?php echo $wid; ?>">{{(new \App\Helper)->get_remaining($ownerdetails->id) }} KD</a>


                </address>

                </address>

            </div>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="1%">No.</th>
                        <th width="20%">Chalet Details</th>
                        <th width="20%">Reservations</th>
                        <th width="10%">Total Amount</th>
                        <th width="10%">Commission</th>
                        <th width="10%">Balance</th>
                        <th width="10%">Auto Accept</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chaletlist as $cdetails)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <strong>{{$cdetails->chalet_name}}</strong></br></br>
                            Weekdays : <strong>{{$cdetails->weekday_rent}}</strong> KD</br>
                            Weekend : <strong>{{$cdetails->weekend_rent}}</strong> KD</br>
                            Week : <strong>{{$cdetails->week_rent}}</strong> KD
                        </td>
                        <td>
                            <?php $cid = base64_encode($cdetails->cid); ?>
                            <?php if (((new \App\Helper)->get_count_ownerchaletreservation($cdetails->cid)) != 0) { ?>
                                <a class="btn btn-info  btn-xs" href="{{ url('/TotalReservations') }}/<?php echo $cid; ?>/<?php echo $id; ?>">{{(new \App\Helper)->get_count_ownerchaletreservation($cdetails->id) }}</a>
                            <?php } else {
                                echo  "none";
                            } ?>
                        </td>
                        <td>
                            <button> {{(new \App\Helper)->get_chalet_totalpaid($cdetails->cid) }} KD</button>
                        </td>
                        <td>
                            <button>{{$cdetails->commision}}%</button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-xs">{{(new \App\Helper)->get_chalet_totalpaidremaining($cdetails->cid)}} KD</button>
                        </td>
                        <td align="center">
                            @if($cdetails->auto_acceptbooking==0)
                            <label><input type="checkbox" id="booking<?php echo $loop->iteration; ?>" class="js-switch" name="booking_status" onclick="mybookingFunction('<?php echo $cdetails->cid; ?>','booking<?php echo $loop->iteration; ?>')"></label>
                            @endif
                            @if($cdetails->auto_acceptbooking==1)
                            <label><input type="checkbox" name="booking_status" id="booking<?php echo $loop->iteration; ?>" class="js-switch" checked onclick="mybookingFunction('<?php echo $cdetails->cid; ?>','booking<?php echo $loop->iteration; ?>')"></label>
                            @endif
                        </td>
                        <td align="center">
                            @if($cdetails->is_activestatus==1)
                            <label><input type="checkbox" id="myCheck<?php echo $loop->iteration; ?>" onclick="myFunction('<?php echo $cdetails->cid; ?>','myCheck<?php echo $loop->iteration; ?>')" class="js-switch" name="chalet_status" checked> </label>
                            @endif
                            @if($cdetails->is_activestatus==0)
                            <label><input type="checkbox" id="myCheck<?php echo $loop->iteration; ?>" onclick="myFunction('<?php echo $cdetails->cid; ?>','myCheck<?php echo $loop->iteration; ?>')" class="js-switch" name="chalet_status"> </label>
                            @endif
                        </td>
                        <td align="center">
                            <?php $id = base64_encode($cdetails->cid);
                            $page = base64_encode('list'); ?>
                            <a class="btn btn-primary btn-xs" href="{{ url('/Chalet-edit') }}/<?php echo $id; ?>/<?php echo $page; ?>">Edit</a>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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