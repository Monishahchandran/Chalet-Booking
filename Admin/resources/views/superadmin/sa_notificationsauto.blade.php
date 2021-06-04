@extends('superadmin.layouts.sa_layout')
@section('title', "Auto Notifications ( Scheduled Notifications List )")
@section('content')
<div>
<div class="x_panel">
  <div class="x_title">
    <h1>Auto Notifications</h1>
    <h3> Scheduled Notifications List</h3>
    <div class="clearfix">
      <h4><a href="notifications-add-new-auto-notifications.php" class="btn btn-primary">+ Add new Auto Notifications</a></h4>
    </div>
    <div class="clearfix"></div>
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

          <td dir="rtl"> Happy New Year
  </div>
  </td>
  <td dir="rtl"> {username}, Happy New Year
</div>
</td>
<td>22.85k</td>
<td>02/10/2020 10:45 PM</td>
<td><a href="notifications-edit-auto-notifications.php" class="btn btn-success btn-xs">Edit</a> <a href="#" class="btn btn-primary bg-red  btn-xs">Delete</a></td>
</tr>
<tr>
  <td>2</td>

  <td dir="rtl"> Happy New Year</td>

  <td dir="rtl"> {username}, Happy New Year</td>

  <td>22.85k</td>

  <td>02/10/2020 10:45 PM</td>
  <td><a href="notifications-edit-auto-notifications.php" class="btn btn-success btn-xs">Edit</a> <a href="#" class="btn btn-primary bg-red  btn-xs">Delete</a></td>
</tr>
</tbody>
</table>
</div>
@endsection