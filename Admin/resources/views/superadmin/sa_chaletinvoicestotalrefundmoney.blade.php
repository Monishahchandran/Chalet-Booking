@extends('superadmin.layouts.sa_layout')
@section('title', "Refund Money")
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
            <h1>Cancel Reservation And Refund <b style="color: orangered">Money</b> of User's </h1>
        </div>
        <div class="x_content">
            <div>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th width="1%">No.</th>

                            <th width="30%">User Details</th>

                            <th width="30%">Booking Details</th>

                            <th width="30%">Price</th>

                            <th width="5%">Status</th>

                            <th width="10%">Refund Money</th>
                            <th width="5%">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reservationlist as $rdetails)
                    <?php $userdetails = (new \App\Helper)->get_user_details($rdetails->userid); ?>
                        <tr>
                        <td>{{$rdetails->reservation_id}}</td>
                            <td>
                                <b>{{$userdetails->first_name}}&nbsp;{{$userdetails->last_name}}LoLo Ali</b>
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
                                <b style="color: limegreen">Check-in</b>:  {{$rdetails->check_in}}
                                <br>
                                <b style="color: red">Check-Out</b>: {{$rdetails->check_out}}
                            </td>
                            <td>
                                <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td width="0">
                                            <ul>
                                                <li>Rental price</li>
                                                <li>Total Paid</li>
                                                <li>Totol Refund:</li>
                                            </ul>
                                        </td>
                                        <td width="100%" valign="top">
                                            : <strong>{{$rdetails->package_price}} KD </strong><br>
                                            : <b style="color: limegreen">{{$rdetails->total_paid}}  KD </b><br>
                                            : <b style="color: orangered">{{$rdetails->total_paid}}  KD </b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                            <?php $id = base64_encode($rdetails->rid); ?>
                            @if($rdetails->status=='Remaining')
                                <a class="btn btn-warning btn-xs" href="{{ url('/Invoice') }}/<?php echo $id; ?>">Paid ( Remaining )</a>
                                @endif @if($rdetails->status=='Paid')
                                <a class="btn btn-success btn-xs" href="{{ url('/Invoice') }}/<?php echo $id; ?>">Paid</a>
                                @endif
                            </td>
                            <td>
                                <b>{{$rdetails->total_paid}}KD</b>
                                <br>
                                <div id="result_message">
                                @if(empty($rdetails->refund_date))
                                <input type="date" id="refund_date<?php echo $loop->iteration;?>" id="refund_date" onchange="updaterefund('<?php echo $rdetails->rid;?>','refund_date<?php echo $loop->iteration;?>');" >
                                @else
                                {{$rdetails->refund_date}}
                                @endif
                                </div>
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
        </div>
    </div>
</div>
<!-- /User Blocked -->
<script>
 function updaterefund($rid,$field) {
    $tid = "#" + $field;
		$refund_date = $($tid).val();
        // alert($season_start)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_refunddate') }}",
            data: {
                reserv_id: $rid,
                refund_date: $refund_date
            },
            beforeSend: function() {
                // Show image container
                $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);
                $('#result_message').html($refund_date);
            },
            complete: function(data) {
                // Hide image container
                $("#loader1").hide();
            }
        });
    }
</script>
@endsection