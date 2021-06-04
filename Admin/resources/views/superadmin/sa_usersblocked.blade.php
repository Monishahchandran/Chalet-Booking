@extends('superadmin.layouts.sa_layout')
@section('title', "Blocked Users")
@section('content')
<div>
    <!-- /User Management -->
    <div class="x_panel">
        <div class="alert alert-success" role="alert" align="center">
            khalifa yousif, Has been UnBlock
        </div>
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
                    <tr>

                        <td>1</td>

                        <td>khalifa yousif</td>

                        <td>Kuwait</td>

                        <td>email@gmail.com</td>

                        <td>+96599791234</td>

                        <td>Male</td>

                        <td><a href="User-Reservations.php" target="_blank" class="btn btn-info btn-xs">4</a></td>

                        <td>100</td>

                        <td align="center"><a href="user-profile.php" class="btn btn-success btn-xs">Profile</a> <a href="#" class="btn btn-info btn-xs">UnBlock</a></td>

                    </tr>
                    <tr>
                        <td>2</td>

                        <td>Mery</td>

                        <td>India</td>

                        <td>email@gmail.com</td>

                        <td>+96599791234</td>

                        <td>Female</td>

                        <td>None</td>

                        <td>None</td>

                        <td align="center"><a href="user-profile.php" class="btn btn-success btn-xs">Profile</a> <a href="#" class="btn btn-info btn-xs">UnBlock</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection