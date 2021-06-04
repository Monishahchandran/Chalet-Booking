@extends('superadmin.layouts.sa_layout')
@section('title', 'Rejected List')
@section('content')
<!-- Dashboard-->
<div>
    <div class="x_panel">
        <div class="x_content">
            <div>
                <div class="x_title">
                    <h1>Rejected List</h1>
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
                                                : -0 KD<br>
                                                : -0 KD<br><br>
                                                : <b style="color: limegreen">200 KD </b><br>
                                                : <b style="color: orangered">400 KD </b><br>
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
                                    <i class="fa fa-times-circle"></i>
                                    <b>Reject By Admin</b>
                                    <br>
                                    18/03/2021 - 18:44:20 PM
                                    <hr>
                                    <b>Refund Money :</b>
                                    <br>
                                    <b style="color: #FF9933">Processing </b>
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

                                                : -0 KD<br>

                                                : -0 KD<br><br>

                                                : <b style="color: limegreen">200 KD </b><br>

                                                : <b style="color: orangered">400 KD </b><br>
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
                                    <i class="fa fa-times-circle"></i>

                                    <b>Reject By Owner</b>
                                    <br>

                                    18/03/2021 - 18:44:20 PM

                                    <hr>

                                    <b>Refund Money :</b>

                                    <br>

                                    <b style="color: limegreen">200 KD </b> ( Book )

                                    <br>

                                    21/03/2021 - 10:15:45 AM

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
                                    <i class="fa fa-times-circle"></i>
                                    <b>Reject By Owner</b>
                                    <br>
                                    18/03/2021 - 18:44:20 PM
                                    <hr>
                                    <b>Refund Money :</b>
                                    <br>
                                    <b style="color: limegreen">200 KD </b> ( Book )
                                    <br>
                                    <b style="color: limegreen">100 KD </b> ( Rewards )
                                    <br>
                                    21/03/2021 - 10:15:45 AM
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
        <!-- Dashboard-->
    </div>
    <!-- /User Blocked -->
</div>
@endsection