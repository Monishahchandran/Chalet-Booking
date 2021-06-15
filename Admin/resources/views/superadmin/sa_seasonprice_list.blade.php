@extends('superadmin.layouts.sa_layout')
@section('title', "Season Prices")
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
            <h1>Season Prices</h1>
        </div>
        <div class="x_content">
            <!-- /.col -->
            <div class="col-md-6 col-sm-12 col-xs-6">
                <table border="0" width="100%" cellpadding="5" cellspacing="0">
                    <tr>
                        <td width="20%" valign="top">
                            <ul>
                                <li>
                                    <h3 style="color: limegreen">Start</h3>
                                </li>
                                <li>
                                    <h3 style="color: red">End</h3>
                                </li>
                            </ul>
                        </td>
                        <td width="80%" valign="top">
                        
                            <h3>:<input type="text" onkeypress='validate(event)' style="border: transparent;" onclick="change();" name="season_start" id="season_start" value="@if(!empty($seasondate)){{$seasondate->season_start}}@endif" placeholder="Start Date(Date/Month)"/></h3>
                            <h3>:<input type="text" onkeypress='validate(event)' name="season_end" onclick="change();" id="season_end" style="border: transparent;" value="@if(!empty($seasondate)){{$seasondate->season_end}}@endif" placeholder="End Date(Date/Month)"/> </h3>
                            <!-- <span id='errormessage'></span><br> -->
                            <button id="send" type="button" onclick="myFunction()" class="btn btn-success">Edit Date</button>
                           
                           <br>

                            <br>

                        </td>
                    </tr>

                </table>

            </div>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="1%">No.</th>
                        <th width="1%">Photo</th>
                        <th width="30%">Owner Details</th>
                        <th width="30%">Chalet Details</th>
                        <th width="10%">Week</th>
                        <th width="10%">Weekend</th>
                        <th width="10%">Weekdays</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($chaletlist as $cdetails)
                <?php $image = (new \App\Helper)->get_chalet_image($cdetails->cid); ?>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img border="0" src="{{url('uploads/chalet_uploads/chalet_images/')}}/<?php echo $image; ?>" width="100"></td>
                        <td>
                        <strong>{{$cdetails->first_name}} {{$cdetails->last_name}} </strong>
                            <br>
                            {{$cdetails->gender}}
                            <br>{{$cdetails->country}}
                            <br>
                            Email:{{$cdetails->email}}
                            <br>Mobile: {{$cdetails->phone}}
                        </td>
                        <td>
                        <strong>{{$cdetails->chalet_name}}</strong></br></br>
                            Weekdays : <strong>{{$cdetails->weekday_rent}}</strong> KD</br>
                            Weekend : <strong>{{$cdetails->weekend_rent}}</strong> KD</br>
                            Week : <strong>{{$cdetails->week_rent}}</strong> KD
                        </td>
                        <td>
                            <input type="number" id="week_seasonprice<?php echo $loop->iteration;?>" value="{{$cdetails->week_seasonprice}}" style="height: 30px;width: 80px;" size="6" onchange="weekFunction('<?php echo $cdetails->cid; ?>','week_seasonprice<?php echo $loop->iteration;?>');" maxlength="4"> KD
                        </td>
                        <td>
                            <input type="number" id="weekend_seasonprice<?php echo $loop->iteration;?>" value="{{$cdetails->weekend_seasonprice}}" style="height: 30px;width: 80px;"  onchange="weekendFunction('<?php echo $cdetails->cid; ?>','weekend_seasonprice<?php echo $loop->iteration;?>');" size="6" maxlength="4"> KD
                        </td>
                        <td>
                            <input type="number" id="weekdays_seasonprice<?php echo $loop->iteration;?>" value="{{$cdetails->weekdays_seasonprice}}"  onchange="weekdaysFunction('<?php echo $cdetails->cid; ?>','weekdays_seasonprice<?php echo $loop->iteration;?>');" style="height: 30px;width: 80px;" size="6" maxlength="4"> KD
                        </td>
                        <td align="center">
                            @if($cdetails->season_status==1)
                            <label><input type="checkbox" id="myCheck<?php echo $loop->iteration; ?>" onclick="mystatusFunction('<?php echo $cdetails->cid; ?>','myCheck<?php echo $loop->iteration; ?>')" class="js-switch" name="seasonal_status" checked> </label>
                            @endif
                            @if($cdetails->season_status==0)
                            <label><input type="checkbox" id="myCheck<?php echo $loop->iteration; ?>" onclick="mystatusFunction('<?php echo $cdetails->cid; ?>','myCheck<?php echo $loop->iteration; ?>')" class="js-switch" name="seasonal_status"> </label>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function validate(evt) {
      var theEvent = evt || window.event;

      // Handle paste
      if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
      } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
      }
      var regex = /[0-9-/]|\./;
      if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
      }
    }

   
  </script>
<script type="text/javascript">
function change(){
    $season_start = $("#season_start").val();
    $season_end = $("#season_end").val();
        //  var regEx = /^\d{2}\/\d{2}\/\d{4}$/;
        //  if((!regEx.test(season_start)) || (!regEx.test(season_end)) ){
        // //  alert("Please enter date format mm/dd/yyyy");
        //  $('#errormessage').html('Please enter Correct date format').css('color', 'red');
        //  }
        //  else{
        //   alert("Thanks..You have entered correct date");
        //  }
    document.getElementById("send").innerHTML = "Save Details";

}
    function myFunction() {
        $season_start = $("#season_start").val();
        $season_end = $("#season_end").val();
        // alert($season_start)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('edit_seasondate') }}",
            data: {
                season_start: $season_start,
                season_end: $season_end
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
    function mystatusFunction($cid,$field) {
        // alert($cid)
        $tid = "#" + $field;
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
        // alert(check);
        var season_status = $check;
        var chaletid = $cid;
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_seasonstatus') }}",
            data: {
                season_status: season_status,
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
    function weekFunction($cid,$field) {
        $tid = "#" + $field;
		$week_seasonprice = $($tid).val();
        $chaletid = $cid;
        // alert($season_start)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_weeksr') }}",
            data: {
                week_seasonprice: $week_seasonprice,
                chaletid: $chaletid
            },
            beforeSend: function() {
                // Show image container
                // $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);

            },
            complete: function(data) {
                // Hide image container
                // $("#loader1").hide();
            }
        });
    }
    function weekendFunction($cid, $field) {
        $tid = "#" + $field;
		$weekend_seasonprice = $($tid).val();
        $chaletid = $cid;
        // alert($season_start)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_weekendsr') }}",
            data: {
                weekend_seasonprice: $weekend_seasonprice,
                chaletid: $chaletid
            },
            beforeSend: function() {
                // Show image container
                // $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);

            },
            complete: function(data) {
                // Hide image container
                // $("#loader1").hide();
            }
        });
    }
    function weekdaysFunction($cid,$field) {
        $tid = "#" + $field;
		$weekdays_seasonprice = $($tid).val();
        $chaletid = $cid;
        // alert($season_start)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_weekdayssr') }}",
            data: {
                weekdays_seasonprice: $weekdays_seasonprice,
                chaletid: $chaletid
            },
            beforeSend: function() {
                // Show image container
                // $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);

            },
            complete: function(data) {
                // Hide image container
                // $("#loader1").hide();
            }
        });
    }
    </script>
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