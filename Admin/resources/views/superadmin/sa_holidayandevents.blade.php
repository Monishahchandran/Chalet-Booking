@extends('superadmin.layouts.sa_layout')
@section('title', "Holidays and Events List")
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
</style>
<div>
    <!-- /User Blocked -->
    <div class="x_panel">
        <div class="x_title">
            <h1>Holidays and Events List</h1>
        </div>
        <!-- Image loader -->
        <div id='loader1' class="lds-hourglass" style="display:none;"></div>
        <!-- Image loader -->
        <div class="x_content">
        <div class="x_content">
            <h4><a href="{{ url('/Add-new-Holidays-and-Events') }}" class="btn btn-primary">+ Add new Holidays and Events</a></h4>
            <!-- /.col -->
        </div>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="1%">No.</th>

                    <th width="20%">Event Name</th>

                    <th width="40%">Date</th>

                    <th width="10%">Status</th>

                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($holidaylist as $holiday)
                <tr>
                    <td><strong>{{$loop->iteration}}</strong></td>
                    <td><strong>{{$holiday->event_name}}</strong></td>

                    <td>

                        <table border="0" width="100%" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="30%" valign="top">
                                    <ul>

                                        <li><b style="color: limegreen">Check-in</b></li>

                                        <li><b style="color: red">Check-Out</b></li>

                                    </ul>

                                </td>
                                <td width="70%" valign="top">
                                    <strong>: {{ date('Y-m-d h:i A', strtotime($holiday->check_in)) }}</strong><br>
                                    <strong>:{{ date('Y-m-d h:i A', strtotime($holiday->check_out)) }} </strong><br>
                                </td>
                            </tr>

                        </table>
                    </td>
                    <td align="center">
                        @if($holiday->holiday_status==1)
                            <label><input type="checkbox" id="myCheck<?php echo $holiday->id; ?>" onclick="myFunction('<?php echo $holiday->id; ?>','myCheck<?php echo $holiday->id; ?>')" class="js-switch" name="chalet_status" checked> </label>
                            @endif
                            @if($holiday->holiday_status==0)
                            <label><input type="checkbox" id="myCheck<?php echo $holiday->id; ?>" onclick="myFunction('<?php echo $holiday->id; ?>','myCheck<?php echo $holiday->id; ?>')" class="js-switch" name="chalet_status"> </label>
                            @endif
                    </td>
                    <td align="center">
                    <?php $id = base64_encode($holiday->id);?>
                        <a class="btn btn-success btn-xs" href="{{ url('/Update-new-Holidays-and-Events') }}/<?php echo $id; ?>" >Edit</a>
                        <a class="btn btn-danger btn-xs" href="{{ url('/deleteholidayandevent') }}/<?php echo $id; ?>"  >Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
    </div>
</div>
<script>
function myFunction($id,$tagid) {
        // alert($tagid);
        $tid = "#" + $tagid;
        if ($($tid).prop('checked')  == true) {
			// alert("now checked");
            $($tid).prop('checked', true);
			$check = 1;
		} 
        else {
			// alert("now un-checked");
            $($tid).prop('checked', false);
			$check = 0;
		}
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert($check);
        var status = $check;
        var holidayid = $id;
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_holidaystatus') }}",
            data: {
                holiday_status: status,
                holidayid: holidayid
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
<!-- <script src="{{url('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
<script src="{{url('vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
<script src="{{url('vendors/google-code-prettify/src/prettify.js')}}"></script> -->
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