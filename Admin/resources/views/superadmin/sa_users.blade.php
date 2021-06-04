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

                        <td>none
                        <!-- <a href="User-Reservations.php" target="_blank" class="btn btn-info btn-xs">6</a> -->
                        </td>

                        <td>none
                        <!-- <a href="User-Invoices-Total-PAID.php" target="_blank" class="btn btn-success btn-xs">4</a> -->
                        </td>

                        <td>none
                        <!-- <a href="User-Invoices-Total-UnPaid.php" target="_blank" class="btn btn-danger btn-xs">1</a> -->
                        </td>

                        <td>none
                        <!-- <a href="User-Invoices-Total-Remaining.php" target="_blank" class="btn btn-warning btn-xs">1</a> -->
                        </td>

                        <td>none
                        <!-- <button>2.250 KD</button.> -->
                        </td>

                        <td>none
                        <!-- <button>100 KD</button> -->
                        </td>

                        <td align="center"><a href="user-profile.php" class="btn btn-success btn-xs">Profile</a></td>

                    </tr>
                    @endforeach    
                    
                </tbody>
            </table>
        </div>

    </div>

</div>
<!-- /User Management -->
@endsection