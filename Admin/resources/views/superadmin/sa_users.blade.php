@extends('superadmin.layouts.sa_layout')
@section('title', "Users")
@section('content')
<div>
    <!-- /User Management -->
    <div class="x_panel">
        @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert" align="center"> {{ $message }}</div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert" align="center"> {{ $message }}</div>
        @endif
        <div class="x_title">

            <h1>Users</h1>

            <div class="clearfix"></div>

        </div>

        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th width="1%">ID</th>

                        <th width="20%">User name</th>

                        <th width="10%">Reservation</th>

                        <th width="10%">PAID</th>

                        <th width="10%">UnPaid</th>

                        <th width="10%">Deposits</th>

                        <th width="10%">Total Amount</th>

                        <th width="10%">Rewards</th>

                        <th width="10%">Action</th>

                    </tr>

                </thead>

                <tbody>
                
                    @foreach($userdetails as $udetails)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <b>{{$udetails->first_name}} &nbsp; {{$udetails->last_name}}</b>

                            <br>{{$udetails->gender}}

                            <br>{{$udetails->country}}

                            <br>Email:{{$udetails->email}}

                            <br>Mobile: {{$udetails->phone}}

                        </td>

                        <td>
                        <?php $id=base64_encode($udetails->id);?>
                    <?php if(((new \App\Helper)->get_count_userchaletreservation($udetails->id)) != 0){ ?>
                        <a class="btn btn-info  btn-xs" href="{{ url('/User-Reservations') }}/<?php echo $id; ?>">{{(new \App\Helper)->get_count_userchaletreservation($udetails->id) }}</a>
                        <?php }else{
                           echo  "none";
                        } ?>
                        </td>
                        <td>
                        <?php $id=base64_encode($udetails->id);?>
                    <?php if(((new \App\Helper)->get_usertotalpaid($udetails->id)) != 0){ ?>
                        <?php $page = base64_encode('paid'); ?>
                        <a class="btn btn-success  btn-xs" href="{{ url('/User-Invoices') }}/<?php echo $id; ?>/<?php echo $page; ?>">{{(new \App\Helper)->get_usertotalpaid($udetails->id) }}</a>
                        <?php }else{
                           echo  "none";
                        } ?>
                        <!-- <a href="User-Invoices-Total-PAID.php" target="_blank" class="btn btn-success btn-xs">4</a> -->
                        </td>

                        <td>
                        <?php $id=base64_encode($udetails->id);?>
                    <?php if(((new \App\Helper)->get_usertotalunpaid($udetails->id)) != 0){ ?>
                        <?php $page = base64_encode('unpaid'); ?>
                        <a class="btn btn-danger  btn-xs" href="{{ url('/User-Invoices') }}/<?php echo $id; ?>/<?php echo $page; ?>">{{(new \App\Helper)->get_usertotalunpaid($udetails->id) }}</a>
                        <?php }else{
                           echo  "none";
                        } ?>
                        <!-- <a href="User-Invoices-Total-UnPaid.php" target="_blank" class="btn btn-danger btn-xs">1</a> -->
                        </td>

                        <td>
                        <?php $id=base64_encode($udetails->id);?>
                    <?php if(((new \App\Helper)->get_usertotalunpaid($udetails->id)) != 0){ ?>
                        <?php $page = base64_encode('deposit'); ?>
                        <a class="btn btn-warning  btn-xs" href="{{ url('/User-Invoices') }}/<?php echo $id; ?>/<?php echo $page; ?>">{{(new \App\Helper)->get_usertotalunpaid($udetails->id) }}</a>
                        <?php }else{
                           echo  "none";
                        } ?>
                        <!-- <a href="User-Invoices-Total-Remaining.php" target="_blank" class="btn btn-warning btn-xs">1</a> -->
                        </td>

                        <td>
                        <?php $id=base64_encode($udetails->id);?>
                    <?php if(((new \App\Helper)->get_usertotalamount($udetails->id)) != 0){ ?>
                  <button>   {{(new \App\Helper)->get_usertotalamount($udetails->id) }}</button>
                        <?php }else{
                           echo  "none";
                        } ?>
                        </td>

                        <td>
                        <?php $id=base64_encode($udetails->id);?>
                    <?php if(((new \App\Helper)->get_rewards($udetails->id)) != 0){ ?>
                  <button>   {{(new \App\Helper)->get_rewards($udetails->id) }}</button>
                        <?php }else{
                           echo  "none";
                        } ?>
                        <!-- <button>100 KD</button> -->
                        </td>
                        <?php $userid = base64_encode($udetails->id); ?>
                        <td align="center"><a class="btn btn-success btn-xs" href="{{ url('/user-profile') }}/<?php echo $userid; ?>">Profile</a>
                            </td>

                    </tr>
                    @endforeach    
                    
                </tbody>
            </table>
        </div>

    </div>

</div>
<!-- /User Management -->
@endsection