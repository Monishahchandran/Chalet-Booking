@extends('superadmin.layouts.sa_layout')
@section('title', "Blocked Users")
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div>
    <!-- /User Management -->
    <div class="x_panel">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert" align="center">
            {{$message}}
        </div>
        @endif


        <div class="x_title">

            <h1>Blocked Users</h1>

            <div class="clearfix"></div>

        </div>
        <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th width="1%">ID</th>

                        <th width="20%">User name</th>

                        <th width="10%">Country</th>

                        <th width="10%">Email </th>

                        <th width="10%">Mobile Number</th>

                        <th width="10%">Gender</th>

                        <th width="10%">Reservations</th>

                        <th width="10%">Rewards</th>

                        <th width="10%">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($userdetails as $udetails)
                    <tr>
                        <td>{{$udetails->id}}</td>
                        <td>{{$udetails->first_name}}&nbsp;{{$udetails->last_name}}</td>
                        <td>{{$udetails->country}}</td>

                        <td>{{$udetails->email}}</td>

                        <td>{{$udetails->country_code}}{{$udetails->phone}}</td>

                        <td>{{$udetails->gender}}</td>

                        <td>
                            <?php $id = base64_encode($udetails->id); ?>
                            <?php if (((new \App\Helper)->get_count_userchaletreservation($udetails->id)) != 0) { ?>
                                <a class="btn btn-info  btn-xs" href="{{ url('/User-Reservations') }}/<?php echo $id; ?>">{{(new \App\Helper)->get_count_userchaletreservation($udetails->id) }}</a>
                            <?php } else {
                                echo  "none";
                            } ?>
                        </td>

                        <td> <?php $id = base64_encode($udetails->id); ?>
                            <?php if (((new \App\Helper)->get_rewards($udetails->id)) != 0) { ?>
                                <button> {{(new \App\Helper)->get_rewards($udetails->id) }}</button>
                            <?php } else {
                                echo  "none";
                            } ?>
                        </td>

                        <?php $userid = base64_encode($udetails->id); ?>
                        <td align="center"><a class="btn btn-success btn-xs" href="{{ url('/user-profile') }}/<?php echo $userid; ?>">Profile</a>
                        <a class="btn btn-info btn-xs" href="{{ url('/unblockuser') }}/<?php echo $userid; ?>">UnBlock</a>
                        </td>
                    </tr>
                    @endforeach
                    <!-- <tr>
                         <td>2</td>

                        <td>Mery</td>

                        <td>India</td>

                        <td>email@gmail.com</td>

                        <td>+96599791234</td>

                        <td>Female</td>

                        <td>None</td>

                        <td>None</td>

                        <td align="center"><a href="user-profile.php" class="btn btn-success btn-xs">Profile</a> <a href="#" class="btn btn-info btn-xs">UnBlock</a></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function blockuser($status) {
        $userid = $('#userid').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert(check);
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('blockuser') }}",
            data: {
                status: $status,
                userid: $userid
            },
            beforeSend: function() {
                // Show image container
                // $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);
                if ($status == 1) {
                    $('#changebutton').html('<button id="blockbutton" type="button" onclick="blockuser(' + 0 + ');" class="btn btn-info">UnBlock</button>');
                } else {
                    $('#changebutton').html(' <button id="blockbutton" type="button" onclick="blockuser(' + 1 + ');" class="btn btn-danger">Block</button>');
                }
            },
            complete: function(data) {
                // Hide image container
                // $("#loader1").hide();
            }
        });

        // });
    }
</script>
@endsection