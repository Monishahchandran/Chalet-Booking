@extends('superadmin.layouts.sa_layout')
@section('title', "Deposited Money To Owner")
@section('content')
<div>
    <!-- /User Blocked -->
    <div class="x_panel">
        <div class="x_title">
            <h1>Deposited <b style="color: limegreen">Money</b> To Owner </h1>
        </div>
        <div class="x_content">
            <!-- /.col -->
            <div class="col-md-6 col-sm-12 col-xs-6">
                <h3>Reservations information</h3>
                <br>Total Amount of <b>Reservation </b>: <button>100.000</button> KD

                <br>Total Amount of <b>Commission </b>: <button>10.000</button> KD

                <br>Total Amount after <b>Commission</b> : <button>90.000</button> KD

                <br>Total amounts to be <b>Deposited</b> : <button>5.500</button> KD
                <br>
            </div>
            <div>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th width="1%">No.</th>

                            <th width="30%">Owner Details</th>

                            <th width="30%">Booking Details</th>

                            <th width="30%">Price</th>

                            <th width="5%">Status</th>

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

                                        <td width="40%">

                                            <ul>

                                                <li>Rental price</li>

                                                <li>Commission</li><br>

                                                <li>Total Deposited</li>
                                            </ul>

                                        </td>

                                        <td width="60%" valign="top">

                                            : <strong>600 KD </strong><br>

                                            : <b style="color: #FF9933">( 10% ) -60 KD</b><br><br>

                                            : <b style="color: limegreen">0 KD</b><br>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                            <td align="center">

                                <button class="btn btn-warning btn-xs">Processing</button>

                            </td>

                            <td>

                                <button class="btn btn-success btn-xs" onclick="window.location.href='Invoic-Paid.php';">Invoic</button><br>

                                <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>

                                <br><button class="btn btn-primary btn-xs" onclick="window.location.href='user-profile.php';">User Profile</button>

                            </td>
                        </tr>
                        <tr>

                            <td>Inv000002</td>

                            <td>
                                <b>khalifa Yousef ALqenaei</b>

                                <br>Male

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

                                        <td width="40%">

                                            <ul>

                                                <li>Rental price</li>

                                                <li>Commission</li><br>

                                                <li>Total Deposited</li>



                                            </ul>

                                        </td>

                                        <td width="60%" valign="top">

                                            : <strong>800 KD </strong><br>

                                            : <b style="color: #FF9933">( 20% ) -160 KD</b><br><br>

                                            : <b style="color: limegreen">640 KD</b><br>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                            <td>

                                <button class="btn btn-success btn-xs" onclick="window.location.href='Invoic-Deposited.php';">Deposited</button>

                            </td>

                            <td>
                                <button class="btn btn-success btn-xs" onclick="window.location.href='Invoic-Paid.php';">Invoic</button><br>

                                <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>

                                <br><button class="btn btn-primary btn-xs" onclick="window.location.href='user-profile.php';">User Profile</button>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
    </div>
</div>
<!-- /User Blocked -->
@endsection