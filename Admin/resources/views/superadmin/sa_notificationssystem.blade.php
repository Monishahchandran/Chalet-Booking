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
                    @foreach($systemnotification as $system)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$system->function}}</td>
                        <td dir="rtl">{{$system->title}}</td>
                        <td dir="rtl">{{$system->message}}</td>
                        <td>
                        <?php $id = base64_encode($system->id); ?>
                        <!-- <button class="btn btn-success btn-xs" onclick="window.location.href='notifications-edit-System.php';">Edit</button> -->
                        <a class="btn btn-success  btn-xs" href="{{ url('/notifications-edit-System') }}/<?php echo $id; ?>">Edit</a>
                   
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection