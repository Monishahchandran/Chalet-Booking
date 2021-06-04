@extends('superadmin.layouts.sa_layout')
@section('title', 'Dashboard')
@section('content')
<!-- Dashboard-->
<div>
    <div class="x_panel">
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert" align="center">
        {{ $message }}
        </div>
        @endif
        <div class="x_title">
            <h1>Dashboard</h1>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="1%">Mark</th>
                            <th width="28%">informations</th>
                            <th width="12%">Week</th>
                            <th width="12%">1 Month</th>
                            <th width="12%">3 Months</th>
                            <th width="12%">6 Months</th>
                            <th width="12%">Year</th>
                            <th width="12%">All Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-user" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <td>
                                <h4>Registered users</h4>
                            </td>
                            <td>
                                <h4>100</h4>
                            </td>
                            <td>
                                <h4>425</h4>
                            </td>
                            <td>
                                <h4>813</h4>
                            </td>
                            <td>
                                <h4>8596</h4>
                            </td>
                            <td>
                                <h4>45252</h4>
                            </td>

                            <td>
                                <h4>354287</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-users" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <td>
                                <h4>Total Visitors</h4>
                            </td>
                            <td>
                                <h4>7</h4>
                            </td>
                            <td>
                                <h4>30</h4>
                            </td>
                            <td>
                                <h4>90</h4>
                            </td>
                            <td>
                                <h4>180</h4>
                            </td>
                            <td>
                                <h4>365</h4>
                            </td>
                            <td>
                                <h4>124589</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-users" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <td>
                                <h4>Total Reservations</h4>
                            </td>

                            <td>
                                <h4>5</h4>
                            </td>

                            <td>
                                <h4>12</h4>
                            </td>

                            <td>
                                <h4>44</h4>
                            </td>

                            <td>
                                <h4>76</h4>
                            </td>

                            <td>
                                <h4>127</h4>
                            </td>

                            <td>
                                <h4>21087</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="glyphicon glyphicon-shopping-cart" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <td>
                                <h4>Total Amount Reservations ( KD )</h4>
                            </td>
                            <td>
                                <h4>1.000</h4>
                            </td>
                            <td>
                                <h4>7.000</h4>
                            </td>

                            <td>
                                <h4>20.000</h4>
                            </td>

                            <td>
                                <h4>40.000</h4>
                            </td>

                            <td>
                                <h4>60.000</h4>
                            </td>

                            <td>
                                <h4>90.000</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-dollar" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <td>
                                <h4>Total Commission income ( KD ) </h4>
                            </td>

                            <td>
                                <h4>100</h4>
                            </td>

                            <td>
                                <h4>700</h4>
                            </td>

                            <td>
                                <h4>2.000</h4>
                            </td>

                            <td>
                                <h4>4.000</h4>
                            </td>

                            <td>
                                <h4>6.000</h4>
                            </td>

                            <td>
                                <h4>9.000</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    <div align="center" class="icon"><i class="fa fa-dollar" style="padding-bottom: 10px"></i></div>
                                </h4>
                            </td>
                            <td>
                                <h2>Total Amount after Commission ( KD ) </h2>
                            </td>
                            <td>
                                <h4>900</h4>
                            </td>

                            <td>
                                <h4>6.300</h4>
                            </td>

                            <td>
                                <h4>18.000</h4>
                            </td>

                            <td>
                                <h4>36.000</h4>
                            </td>

                            <td>
                                <h4>54.000</h4>
                            </td>

                            <td>
                                <h4>81.000</h4>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h3>
                                    <div align="center" class="icon"><i class="fa fa-dollar" style="padding-bottom: 10px"></i></div>
                                </h3>
                            </td>

                            <td colspan="7">
                                <h3>Total amounts to be Deposited To Owner ( KD ) : <button class="btn btn-danger btn" onclick="window.location.href='Deposited-Money-To-Owner.php';">5.500 KD</button> </h3>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <br>
                <div class="x_title">
                    <h1 style="color: #B10622">Awaiting Acceptance of the owner</h1>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No.</th>
                                <th width="15%">User Details</th>
                                <th width="20%">Booking Details</th>
                                <th width="25%">Price</th>
                                <th width="15%">Owner Details</th>
                                <th width="15%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Inv000001</td>
                                <td>
                                    <address>
                                        <b>khalifa Yousef ALqenaei</b>
                                        <br>Male
                                        <br>Kuwait
                                        <br>Email: admin@6rb.net
                                        <br>Mobile: +965-99791234
                                    </address>
                                </td>
                                <td>
                                    <strong>Chalet Name</strong>
                                    <br><br>
                                    <b style="color: limegreen">Check-in</b>: 21/03/2021
                                    <br>
                                    <b style="color: red">Check-Out</b>: 24/03/2021
                                </td>
                                <td>
                                    <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td width="60%">
                                                <ul>
                                                    <li>Rental price</li>
                                                    <li>Deposit</li><br>
                                                    <li>Rewards ( Discount )</li>
                                                    <li>Offers ( Discount )</li><br>
                                                    <li>Total Paid</li>
                                                    <li>Remaining:</li>
                                                </ul>
                                            </td>
                                            <td width="40%" valign="top">

                                                : <strong>600 KD </strong><br>

                                                : <b style="color: #FF9933">200 KD </b><br><br>

                                                : -100 KD<br>

                                                : -0 KD<br><br>

                                                : <b style="color: limegreen">200 KD </b><br>

                                                : <b style="color: orangered">300 KD </b><br>



                                            </td>



                                        </tr>

                                    </table>

                                </td>
                                <td>
                                    <address>
                                        <b>Owner Name</b>
                                        <br>Male
                                        <br>Kuwait
                                        <br>Email: admin@6rb.net
                                        <br>Mobile: +965-99791234
                                    </address>
                                </td>
                                <td>
                                    <button style="width: 100%">03:44 Ago</button>
                                    <br><br>
                                    <button class="btn btn-success btn" onclick="window.location.href='#';" style="width: 100%"><i class="fa fa-check-circle"></i> Accept</button>
                                    <br><br>
                                    <button class="btn btn-danger btn" onclick="window.location.href='#';" style="width: 100%"><i class="fa fa-times-circle"></i> Reject </button>
                                </td>
                                <td align="center">
                                    <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>
                                    <br><br><button class="btn btn-success btn-xs" onclick="window.location.href='user-profile.php';">User Profile</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="x_title">
                    <h1 style="color: #B10622">Remaining Amounts</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th width="15%">User Details</th>
                                    <th width="20%">Booking Details</th>
                                    <th width="25%">Price</th>
                                    <th width="15%">Time Expires</th>
                                    <th width="15%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Inv000001</td>
                                    <td>
                                        <address>
                                            <b>khalifa Yousef ALqenaei</b>
                                            <br>Male
                                            <br>Kuwait
                                            <br>Email: admin@6rb.net
                                            <br>Mobile: +965-99791234
                                        </address>
                                    </td>
                                    <td>
                                        <strong>Chalet Name</strong>
                                        <br><br>
                                        <b style="color: limegreen">Check-in</b>: 21/03/2021
                                        <br>
                                        <b style="color: red">Check-Out</b>: 24/03/2021
                                    </td>
                                    <td>
                                        <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td width="60%">
                                                    <ul>
                                                        <li>Rental price</li>
                                                        <li>Deposit</li><br>
                                                        <li>Rewards ( Discount )</li>
                                                        <li>Offers ( Discount )</li><br>
                                                        <li>Total Paid</li>
                                                        <li>Remaining:</li>
                                                    </ul>
                                                </td>
                                                <td width="40%" valign="top">
                                                    : <strong>600 KD </strong><br>
                                                    : <b style="color: #FF9933">200 KD </b><br><br>
                                                    : -100 KD<br>
                                                    : -0 KD<br><br>
                                                    : <b style="color: limegreen">200 KD </b><br>
                                                    : <b style="color: orangered">300 KD </b><br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="center">
                                        <button class="btn btn-danger btn" style="width: 100%">18/03/2021 - 00:44:20</button>
                                        <br>
                                        <br>
                                        <a class="btn btn-primary btn" href="#" style="width: 100%">Send Reminders</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" onclick="window.location.href='Invoic-Paid-Remaining.php';">Paid ( Remaining )</button>
                                    </td>
                                    <td align="center">

                                        <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>

                                        <br><br><button class="btn btn-success btn-xs" onclick="window.location.href='user-profile.php';">User Profile</button>

                                    </td>

                                </tr>
                                <tr>
                                    <td>Inv000002</td>
                                    <td>
                                        <address>
                                            <b>LoLo Ali</b>

                                            <br>Female

                                            <br>Kuwait

                                            <br>Email: admin@6rb.net

                                            <br>Mobile: +965-99791234



                                        </address>

                                    </td>
                                    <td>
                                        <strong>Chalet Name</strong>
                                        <br><br>
                                        <b style="color: limegreen">Check-in</b>: 28/03/2021
                                        <br>
                                        <b style="color: red">Check-Out</b>: 31/03/2021
                                    </td>
                                    <td>
                                        <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td width="60%">
                                                    <ul>
                                                        <li>Rental price</li>
                                                        <li>Deposit</li><br>
                                                        <li>Rewards ( Discount )</li>
                                                        <li>Offers ( Discount )</li><br>
                                                        <li>Total Paid</li>
                                                        <li>Remaining:</li>
                                                    </ul>
                                                </td>
                                                <td width="40%" valign="top">
                                                    : <strong>1000 KD </strong><br>
                                                    : <b style="color: #FF9933">200 KD </b><br><br>
                                                    : -0 KD<br>
                                                    : -100 KD<br><br>
                                                    : <b style="color: limegreen">200 KD </b><br>
                                                    : <b style="color: orangered">700 KD </b><br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="center">
                                        <button style="width: 100%">14/06/2021 - 27:44:20</button>
                                        <br>
                                        <br>
                                        <a class="btn btn-primary btn" href="#" style="width: 100%">Send Reminders</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" onclick="window.location.href='Invoic-Paid-Remaining.php';">Paid ( Remaining )</button>
                                    </td>
                                    <td align="center">
                                        <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>
                                        <br><br><button class="btn btn-success btn-xs" onclick="window.location.href='user-profile.php';">User Profile</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Inv000003</td>
                                    <td>
                                        <address>
                                            <b>khalifa Yousef ALqenaei</b>
                                            <br>Male
                                            <br>Kuwait
                                            <br>Email: admin@6rb.net
                                            <br>Mobile: +965-99791234
                                        </address>
                                    </td>
                                    <td>
                                        <strong>Chalet Name</strong>
                                        <br><br>
                                        <strong>Weekdays</strong>
                                        <br>
                                        <b style="color: limegreen">Check-in</b>: 01/04/2021
                                        <br>
                                        <b style="color: red">Check-Out</b>: 03/04/2021
                                    </td>
                                    <td>
                                        <table border="0" width="100%" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td width="60%">
                                                    <ul>
                                                        <li>Rental price</li>
                                                        <li>Deposit</li><br>
                                                        <li>Rewards ( Discount )</li>
                                                        <li>Offers ( Discount )</li><br>
                                                        <li>Total Paid</li>
                                                        <li>Remaining:</li>
                                                    </ul>
                                                </td>
                                                <td width="40%" valign="top">
                                                    : <strong>600 KD </strong><br>
                                                    : <b style="color: #FF9933">200 KD </b><br><br>
                                                    : -0 KD<br>
                                                    : -0 KD<br><br>
                                                    : <b style="color: limegreen">200 KD </b><br>
                                                    : <b style="color: orangered">400 KD </b><br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="center">
                                        <button style="width: 100%">04/08/2021 - 00:44:20</button>
                                        <br>
                                        <br>
                                        <a class="btn btn-primary btn" href="#" style="width: 100%">Send Reminders</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" onclick="window.location.href='Invoic-Paid-Remaining.php';">Paid ( Remaining )</button>
                                    </td>
                                    <td align="center">
                                        <a class="btn btn-success btn-xs" href="http://www.aby-chalet.com/chalet/1" target="_blank">View Chalet</a>

                                        <br><br><button class="btn btn-success btn-xs" onclick="window.location.href='user-profile.php';">User Profile</button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard-->
    </div>
    <!-- /User Blocked -->
</div>
@endsection