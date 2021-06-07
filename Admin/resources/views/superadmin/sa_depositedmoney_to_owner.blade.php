@extends('superadmin.layouts.sa_layout')
@section('title', "Deposited Money To Owner")
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
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
</style>
<div>
    <!-- /User Blocked -->
    <div class="x_panel">
        <!-- Image loader -->
        <div id='loader1' class="lds-hourglass" style="display:none;"></div>
        <!-- Image loader -->
        <div class="x_title">
            <h1>Deposited <b style="color: limegreen">Money</b> To Owner </h1>
        </div>
        <div class="x_content">
            <!-- /.col -->
            <div class="col-md-6 col-sm-12 col-xs-6">
                <h3>Reservations information</h3>
                <?php $total_paid = (new \App\Helper)->get_totalpaid();
        $total_commission= (new \App\Helper)->get_totalcommission();
        $total_deposittobedone = (new \App\Helper)->total_deposittobedone();
        ?>
                <br>Total Amount of <b>Reservation </b>: <button>{{$total_paid }}</button> KD
                <br>Total Amount of <b>Commission </b>: <button>{{$total_commission}}</button> KD
                <br>Total Amount after <b>Commission</b> : <button>{{$total_paid-$total_commission }}</button> KD

                <br>Total amounts to be <b>Deposited</b> : <button>{{$total_deposittobedone}}</button> KD
                <br>
            </div>
            <div>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th width="1%">No.</th>

                            <th width="30%">Owner Details</th>

                            <th width="30%">Booking Details</th>

                            <th width="30%">Price</th>

                            <th width="5%">Status</th>

                            <th width="5%">Action</th>

                        </tr>

                    </thead>
                    <tbody>
                        @foreach($reservationlist as $rdetails)
                        <?php $userdetails = (new \App\Helper)->get_user_details($rdetails->userid); ?>
                        <tr>
                            <td>{{$rdetails->reservation_id}}</td>
                            <td>
                                <b>{{$userdetails->first_name}}&nbsp;{{$userdetails->last_name}}</b>
                                <br>{{$userdetails->gender}}
                                <br>{{$userdetails->country}}
                                <br>Email:{{$userdetails->email}}
                                <br>Mobile:{{$userdetails->country_code}}{{$userdetails->phone}}
                            </td>
                            <td>
                                <strong>{{$rdetails->chalet_name}}</strong>
                                <br><br>
                                @if($rdetails->selected_package == 'week_rent')
                                Week
                                @elseif($rdetails->selected_package == 'weekend_rent')
                                Weekend
                                @else
                                Weekday
                                @endif
                                <br>
                                <b style="color: limegreen">Check-in</b>: {{$rdetails->check_in}}
                                <br>
                                <b style="color: red">Check-Out</b>: {{$rdetails->check_out}}
                            </td>
                            <td>
                                <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td width="40%">
                                            <ul>
                                                <li>Rental price</li>
                                                <li>Commission</li><br>
                                                <li>Total Deposited</li>
                                            </ul>
                                        </td>
                                        <td width="60%" valign="top">
                                            : <strong>{{$rdetails->package_price}} KD </strong><br>
                                            : <b style="color: #FF9933">( {{$rdetails->commision}}% ) -{{$rdetails->owner_commission}} KD</b><br><br>
                                            : <b style="color: limegreen">{{$rdetails->package_price-$rdetails->commision}} KD</b><br>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td align="center">
                                <div id="deposit">
                                    @if($rdetails->owner_moneydeposit==0)
                                    <button class="btn btn-warning btn-xs" id="deposit_status<?php echo $loop->iteration; ?>" onclick="changestatus('<?php echo $rdetails->rid ?>');">Processing</button>
                                    @else
                                    <button class="btn btn-success btn-xs">Deposited</button>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <?php $id = base64_encode($rdetails->rid);
                                $userid = base64_encode($userdetails->id); ?>
                                <a class="btn btn-success btn-xs" href="{{ url('/Invoice') }}/<?php echo $id; ?>">Invoic</a><br>
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
<script>
    function changestatus($rid) {
        // alert($season_start)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('owner_deposit') }}",
            data: {
                reserv_id: $rid
            },
            beforeSend: function() {
                // Show image container
                $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);
                $('#deposit').html('<button class="btn btn-success btn-xs">Deposited</button>');
            },
            complete: function(data) {
                // Hide image container
                $("#loader1").hide();
            }
        });
    }
</script>
@endsection