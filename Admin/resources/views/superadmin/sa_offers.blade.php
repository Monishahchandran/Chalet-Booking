@extends('superadmin.layouts.sa_layout')
@section('title', "Offers")
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
		@if ($message = Session::get('success'))
		<div class="alert alert-success" role="alert" align="center">
			{{ $message }}
		</div>
		@endif
		@if ($message = Session::get('error'))
		<div class="alert alert-danger" role="alert" align="center">
			{{ $message }}
		</div>
		@endif
		 <!-- Image loader -->
		 <div id='loader1' class="lds-hourglass" style="display:none;"></div>
        <!-- Image loader -->
		<div class="x_title">
			<h1>Offers</h1>
		</div>
		<div class="x_content">
			<!-- /.col -->
			<h4><a href="{{url('/Add-new-Offers-to-Chalet')}}" class="btn btn-primary">+ Add new Offers to Chalet</a></h4>
			<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">

				<thead>

					<tr>

						<th width="1%">No.</th>

						<th width="1%">Photo</th>

						<th width="20%">Chalet Details</th>

						<th width="40%">Date</th>

						<th width="10%">Discount</th>

						<th width="20%">Status</th>

						<th width="10%">Action</th>

					</tr>

				</thead>
				<tbody>
					@foreach($chaletdetails as $cdetails)
					<?php $image = (new \App\Helper)->get_chalet_image($cdetails->cid); 
				$count = (new \App\Helper)->get_offer_count($cdetails->cid);
					?>
					<?php
							// $datetime='2021-05-19 05:23:00';
							$ofexpiry = $admindata->offer_expiry;
							$date_time = date("Y-m-d H:i:s", strtotime($cdetails->offer_checkin));
							$timestamp = strtotime($date_time);
							$etime = $timestamp - ($ofexpiry * 60 * 60);
							// echo date("Y-m-d H:i:s", $time);
							//Print it out in a human-readable format.
							// echo date("M d,Y H:i:s", $time);
							$end_date = date("Y-m-d H:i:s", $etime);
							// echo $end_date;
							// die();
							$current_date= date('Y-m-d H:i:s');
							?>
							@if($current_date<$end_date)
					<tr>
						<td>{{$loop->iteration}}</td>

						<td> <img border="0" src="{{url('uploads/chalet_uploads/chalet_images/')}}/<?php echo $image; ?>" width="120"></td>
						<td>

							<strong>{{$cdetails->chalet_name}}</strong></br>

							<br>

							<strong>Original Price</strong><br>

							Weekdays : <strong>{{$cdetails->weekday_rent}}</strong> KD</br>
							Weekend : <strong>{{$cdetails->weekend_rent}}</strong> KD</br>
							Week : <strong>{{$cdetails->week_rent}}</strong> KD
							<br>
							<br>
							Total No. Offers : <strong>{{$count}}</strong>

						</td>
						<td>

							<table border="0" width="100%" cellpadding="5" cellspacing="0">

								<tr>
									<td width="30%" valign="top">

										<!-- <strong>Weekend</strong></br> -->
										<ul>
											<li><b style="color: limegreen">Check-in</b></li>

											<li><b style="color: red">Check-Out</b></li>
										</ul>
									</td>
									<td width="70%" valign="top">

										<!-- <br> -->&nbsp;
										<strong>:{{ date('Y-m-d h:i A', strtotime($cdetails->offer_checkin)) }}</strong>
										<br>&nbsp;

										<strong>:{{ date('Y-m-d h:i A', strtotime($cdetails->offer_checkout)) }}</strong><br>

									</td>
								</tr>

							</table>

						</td>
						<td>

							<!-- <input type="text" style="height: 30px;" size="6" maxlength="4"> KD -->
							<input type="number" id="offer_price<?php echo $loop->iteration;?>" value="{{$cdetails->discount_amt}}"  onchange="changeamt('<?php echo $cdetails->oid; ?>','offer_price<?php echo $loop->iteration;?>');" style="height: 30px;width: 80px;" size="6" maxlength="4"> KD
						</td>
						<td align="center">
							<?php
							// $datetime='2021-05-19 05:23:00';
							$offer_expiry = $admindata->offer_expiry;
							$datetime = date("Y-m-d H:i:s", strtotime($cdetails->offer_checkin));
							// echo $datetime;
							$timestamp = strtotime($datetime);
							$time = $timestamp - ($offer_expiry * 60 * 60);
							// echo date("Y-m-d H:i:s", $time);
							//Print it out in a human-readable format.
							// echo  date("Y-m-d H:i:s", $time);
							$enddate = date("M d, Y H:i:s", $time);
							// echo $enddate;
							// die();
							?>
							<!-- {{$enddate}} -->
							<button id="cancelbutton<?php echo $loop->iteration; ?>">Cancel After : <p id="demo<?php echo $loop->iteration; ?>"></p></button>
							<p id="expirydemo<?php echo $loop->iteration; ?>"></p>
							<script>
								// Set the date we're counting down to
								var countDownDate<?php echo $loop->iteration; ?> = new Date("<?php echo $enddate; ?>").getTime();

								// Update the count down every 1 second
								var x<?php echo $loop->iteration; ?> = setInterval(function() {

									// Get today's date and time
									var now<?php echo $loop->iteration; ?> = new Date().getTime();

									// Find the distance between now and the count down date
									var distance<?php echo $loop->iteration; ?> = countDownDate<?php echo $loop->iteration; ?> - now<?php echo $loop->iteration; ?>;
									// Time calculations for days, hours, minutes and seconds
									var days<?php echo $loop->iteration; ?> = Math.floor(distance<?php echo $loop->iteration; ?> / (1000 * 60 * 60 * 24));
									var hours<?php echo $loop->iteration; ?> = Math.floor((distance<?php echo $loop->iteration; ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
									var minutes<?php echo $loop->iteration; ?> = Math.floor((distance<?php echo $loop->iteration; ?> % (1000 * 60 * 60)) / (1000 * 60));
									var seconds<?php echo $loop->iteration; ?> = Math.floor((distance<?php echo $loop->iteration; ?> % (1000 * 60)) / 1000);


									// alert("not");
									// If the count down is over, write some text 
									if (distance<?php echo $loop->iteration; ?> < 0) {
										clearInterval(x<?php echo $loop->iteration; ?>);
										document.getElementById("cancelbutton<?php echo $loop->iteration; ?>").style.display = "none";
										document.getElementById("expirydemo<?php echo $loop->iteration; ?>").innerHTML = "EXPIRED";
										// alert("expired");
									} else {
										// Output the result in an element with id="demo"
										document.getElementById("demo<?php echo $loop->iteration; ?>").innerHTML = days<?php echo $loop->iteration; ?> + "d " + hours<?php echo $loop->iteration; ?> + "h " +
											minutes<?php echo $loop->iteration; ?> + "m " + seconds<?php echo $loop->iteration; ?> + "s ";
									}

								}, 1000);
							</script>
						</td>
						<td align="center">
						<?php $id = base64_encode($cdetails->oid);?>
							<a class="btn btn-danger btn-xs" href="{{ url('/deleteoffers') }}/<?php echo $id; ?>"  >Delete</a>
						</td>

					</tr>
@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /User Blocked -->
<script>
function changeamt($id,$field) {
        $tid = "#" + $field;
		$new_price = $($tid).val();
        // alert($season_start)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('update_offerprice') }}",
            data: {
                new_price: $new_price,
                id: $id
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