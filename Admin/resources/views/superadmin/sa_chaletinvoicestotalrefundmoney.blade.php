@extends('superadmin.layouts.sa_layout')
@section('title', "Refund Money")
@section('content')
<div>
    <!-- /User Blocked -->
    <div class="x_panel">
        <div class="x_title">
            <h1>Cancel Reservation And Refund <b style="color: orangered">Money</b> of User's </h1>
        </div>
        <div class="x_content">
            <div>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th width="1%">No.</th>

                            <th width="30%">User Details</th>

                            <th width="30%">Booking Details</th>

                            <th width="30%">Price</th>

                            <th width="5%">Status</th>

                            <th width="10%">Refund Money</th>
                            <th width="5%">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>Inv000001</td>

                            <td>
                                <b>LoLo Ali</b>

                                <br>Female

                                <br>Kuwait

                                <br>Email: admin@6rb.net

                                <br>Mobile: +965-99791234
                            </td>
                            <td>

                                <strong>Chalet Name</strong>
                                <br><br>

                                Weekdays

                                <br>

                                <b style="color: limegreen">Check-in</b>: 28/03/2021

                                <br>

                                <b style="color: red">Check-Out</b>: 31/03/2021
                            </td>
                            <td>
                                <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td width="0">
                                            <ul>
                                                <li>Rental price</li>

                                                <li>Total Paid</li>

                                                <li>Totol Refund:</li>
                                            </ul>
                                        </td>
                                        <td width="100%" valign="top">
                                            : <strong>400 KD </strong><br>

                                            : <b style="color: limegreen">400 KD </b><br>

                                            : <b style="color: orangered">400 KD </b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <button class="btn btn-success btn-xs" onclick="window.location.href='Invoic-Paid.php';">Paid</button>
                            </td>

                            <td>

                                <b>400 KD</b>

                                <br>

                                28/03/2021

                            </td>

                            <td>

                                <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>

                                <br><button class="btn btn-primary btn-xs" onclick="window.location.href='user-profile.php';">User Profile</button>

                            </td>

                        </tr>
                        <tr>

                            <td>Inv000002</td>

                            <td>

                                <b>LoLo Ali</b>

                                <br>Female

                                <br>Kuwait

                                <br>Email: admin@6rb.net
                                <br>Mobile: +965-99791234
                            </td>
                            <td>
                                <strong>Chalet Name</strong>
                                <br><br>
                                Weekdays
                                <br>
                                <b style="color: limegreen">Check-in</b>: 28/03/2021
                                <br>
                                <b style="color: red">Check-Out</b>: 31/03/2021
                            </td>
                            <td>
                                <table border="0" width="100%" cellpadding="5" cellspacing="0">

                                    <tr>

                                        <td width="0">

                                            <ul>

                                                <li>Rental price</li>

                                                <li>Total Paid</li>

                                                <li>Totol Refund:</li>

                                            </ul>

                                        </td>

                                        <td width="100%" valign="top">

                                            : <strong>500 KD </strong><br>

                                            : <b style="color: limegreen">200 KD </b><br>

                                            : <b style="color: orangered">200 KD </b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-xs" onclick="window.location.href='Invoic-Paid-Remaining.php';">Paid ( Remaining )</button>
                            </td>
                            <td>

                                <b>200 KD</b>
                                <br>

                                28/03/2021

                            </td>
                            <td>
                                <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>
                                <br><button class="btn btn-primary btn-xs" onclick="window.location.href='user-profile.php';">User Profile</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /User Blocked -->
@endsection