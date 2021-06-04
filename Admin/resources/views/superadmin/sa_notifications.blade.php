@extends('superadmin.layouts.sa_layout')
@section('title', "Notifications")
@section('content')
<div>
    <div class="x_panel">
        <div class="alert alert-success" role="alert" align="center">
            Notification has been send
        </div>
        <div class="x_title">
            <h1>Sent list Notifications</h1>
            <div class="clearfix">
                <h4><a href="notifications-push.php" class="btn btn-primary">+ Push Notifications</a></h4>
            </div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th width="0%">ID</th>

                        <th width="20%">Title</th>

                        <th width="40%">Message</th>

                        <th width="10%">Recipients</th>

                        <th width="20%">Sending Date</th>

                        <th width="10%">Action</th>

                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td dir="rtl"> Title</td>
                        <td dir="rtl"> message</td>
                        <td>22.85k</td>
                        <td>02/10/2020 10:45 PM</td>
                        <td><a href="#" class="btn btn-success btn-xs">Resend</a> <a href="#" class="btn btn-primary bg-red  btn-xs">Delete</a></td>
                    </tr>
                    <tr>
                        <td>2</td>

                        <td dir="rtl"> Title</td>

                        <td dir="rtl"> message</td>

                        <td>22.85k</td>

                        <td>02/10/2020 10:45 PM</td>

                        <td><a href="#" class="btn btn-success btn-xs">Resend</a> <a href="#" class="btn btn-primary bg-red  btn-xs">Delete</a></td>

                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection