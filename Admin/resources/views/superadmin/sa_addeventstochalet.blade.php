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
		<!-- Image loader -->
		<div id='loader1' class="lds-hourglass" style="display:none;"></div>
		<!-- Image loader -->
		<div class="x_title">

			<h1>Event Name: <strong>{{$event->event_name}}</strong></h1>
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
							<input type="hidden" name="event_id" id="event_id" value="@if(!empty($event)){{$event->id}}@endif" />
							<h3>:<input type="datetime-local" style="border: transparent;" name="event_checkin" id="event_checkin" value="@if(!empty($event)){{ date('Y-m-d\TH:i', strtotime($event->check_in)) }}@endif" placeholder="01/05/2021" /></h3>
							<h3>:<input type="datetime-local" name="event_checkout" id="event_checkout" style="border: transparent;" value="@if(!empty($event)){{ date('Y-m-d\TH:i', strtotime($event->check_out)) }}@endif" placeholder="30/09/2021" /> </h3>
							<button id="send" type="button" onclick="myFunction()" class="btn btn-success">Edit Date</button>
							<br>

							<br>

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
					<?php $image = (new \App\Helper)->get_chalet_image($cdetails->cid);
					$chaletevent = (new \App\Helper)->get_chalet_event($cdetails->cid, $event->id);
					?>
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
							<input type="text" id="week_price<?php echo $loop->iteration; ?>" value="@if(!empty($chaletevent)){{$chaletevent->week_price}}@endif" style="height: 30px;" size="6" onchange="weekFunction('<?php echo $cdetails->cid; ?>','<?php echo $event->id; ?>','week_price<?php echo $loop->iteration; ?>');" maxlength="4"> KD
						</td>
						<td>
							<input type="text" id="weekend_eventprice<?php echo $loop->iteration; ?>" value="@if(!empty($chaletevent)){{$chaletevent->weekend_price}}@endif" style="height: 30px;" onchange="weekendFunction('<?php echo $cdetails->cid; ?>','<?php echo $event->id; ?>','weekend_eventprice<?php echo $loop->iteration; ?>');" size="6" maxlength="4"> KD
						</td>
						<td>
							<input type="text" id="weekdays_eventprice<?php echo $loop->iteration; ?>" value="@if(!empty($chaletevent)){{$chaletevent->weekdays_price}}@endif" style="height: 30px;" onchange="weekdaysFunction('<?php echo $cdetails->cid; ?>','<?php echo $event->id; ?>','weekdays_eventprice<?php echo $loop->iteration; ?>');" size="6" maxlength="4"> KD
						</td>
						<td align="center">
							@if(!empty($chaletevent))
							@if($chaletevent->chaletevent_status==1)
							<label><input type="checkbox" id="myCheck<?php echo $loop->iteration; ?>" onclick="mystatusFunction('<?php echo $cdetails->cid; ?>','<?php echo $event->id; ?>','mycheck<?php echo $loop->iteration; ?>')" class="js-switch" name="seasonal_status" checked> </label>
							@endif

							@if($chaletevent->chaletevent_status==0)
							<label><input type="checkbox" id="myCheck<?php echo $loop->iteration; ?>" onclick="mystatusFunction('<?php echo $cdetails->cid; ?>','<?php echo $event->id; ?>','mycheck<?php echo $loop->iteration; ?>')" class="js-switch" name="seasonal_status"> </label>
							@endif

							@endif

							@if(empty($chaletevent))
							<label><input type="checkbox" id="mycheck<?php echo $loop->iteration; ?>" onclick="mystatuscheckFunction('<?php echo $cdetails->cid; ?>','<?php echo $event->id; ?>','mycheck<?php echo $loop->iteration; ?>')" name="seasonal_status" class="js-switch"> </label>
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
	function myFunction() {
		$event_id = $("#event_id").val();
		$event_checkin = $("#event_checkin").val();
		$event_checkout = $("#event_checkout").val();
		// alert($season_start)
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		// data:{status:name, password:password, email:email},
		$.ajax({
			type: 'POST',
			url: "{{ route('edit_eventdate') }}",
			data: {
				event_id: $event_id,
				event_checkin: $event_checkin,
				event_checkout: $event_checkout
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

	function mystatusFunction($cid, $eid, $field) {
		// alert($eid)
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
		var chaletevent_status = check;
		var chaletid = $cid;
		var eventid = $eid;
		// data:{status:name, password:password, email:email},
		$.ajax({
			type: 'POST',
			url: "{{ route('update_eventstatus') }}",
			data: {
				chaletevent_status: chaletevent_status,
				chaletid: chaletid,
				eventid: eventid,
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

	function mystatuscheckFunction($cid, $eid, $field) {
		// alert($eid)
		$tid = "#" + $field;
		if ($($tid).prop('checked') == true) {
			$($tid).prop('checked', true);
			// alert("checked");
			var check = 1;
		} else {
			// alert("not checked");
			$($tid).prop('checked', false);
			var check = 0;
		}
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		// alert(check);
		var chaletevent_status = check;
		var chaletid = $cid;
		var eventid = $eid;
		// data:{status:name, password:password, email:email},
		$.ajax({
			type: 'POST',
			url: "{{ route('update_eventstatus') }}",
			data: {
				chaletevent_status: chaletevent_status,
				chaletid: chaletid,
				eventid: eventid,
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

	function weekFunction($cid, $eid, $field) {
		$tid = "#" + $field;
		$week_price = $($tid).val();
		$chaletid = $cid;
		$eventid = $eid;
		// alert($chaletid);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		// data:{status:name, password:password, email:email},
		$.ajax({
			type: 'POST',
			url: "{{ route('update_weeker') }}",
			data: {
				week_price: $week_price,
				chaletid: $chaletid,
				eventid: $eventid
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

	function weekendFunction($cid, $eid, $field) {
		$tid = "#" + $field;
		$weekend_price = $($tid).val();
		$chaletid = $cid;
		$eventid = $eid;
		// alert($chaletid);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		// data:{status:name, password:password, email:email},
		$.ajax({
			type: 'POST',
			url: "{{ route('update_weekender') }}",
			data: {
				weekend_price: $weekend_price,
				chaletid: $chaletid,
				eventid: $eventid
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

	function weekdaysFunction($cid, $eid, $field) {
		$tid = "#" + $field;
		$weekdays_price = $($tid).val();
		$chaletid = $cid;
		$eventid = $eid;
		// alert($chaletid);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		// data:{status:name, password:password, email:email},
		$.ajax({
			type: 'POST',
			url: "{{ route('update_weekdayser') }}",
			data: {
				weekdays_price: $weekdays_price,
				chaletid: $chaletid,
				eventid: $eventid
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