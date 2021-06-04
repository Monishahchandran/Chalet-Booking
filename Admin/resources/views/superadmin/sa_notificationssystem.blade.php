@extends('superadmin.layouts.sa_layout')
@section('title', "System Auto Notifications")
@section('content')
<div>
    <div class="x_panel">
        <div class="x_title">
            <h1>System Auto Notifications</h1>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="0%">ID</th>

                        <th width="15%">Function</th>

                        <th width="25%">Title</th>

                        <th width="60%">Message</th>

                        <th width="0%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>

                        <td>1</td>

                        <td>Congratulations</td>

                        <td dir="rtl">Congratulations</td>

                        <td dir="rtl">You Got A Rewards For {Rewards} KD, Your Rewards Balance {Balance} Kd</td>

                        <td><button class="btn btn-success btn-xs" onclick="window.location.href='notifications-edit-System.php';">Edit</button></td>

                    </tr>
                    <tr>

                        <td>2</td>

                        <td>Reservation Canceled</td>

                        <td dir="rtl">Reservation Canceled</td>

                        <td dir="rtl">We Are Sorry, Your Reservation Has Been Canceled Due To Non-Payment Of The Remaining Amount</td>

                        <td><button class="btn btn-success btn-xs" onclick="window.location.href='notifications-edit-System.php';">Edit</button></td>

                    </tr>

                    <tr>

                        <td>3</td>

                        <td>Booking Confirmed</td>

                        <td dir="rtl">Booking Confirmed</td>

                        <td dir="rtl">text ... text</td>

                        <td><button class="btn btn-success btn-xs" onclick="window.location.href='notifications-edit-System.php';">Edit</button></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection