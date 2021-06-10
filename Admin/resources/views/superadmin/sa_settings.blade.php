@extends('superadmin.layouts.sa_layout')
@section('title', 'Settings')
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert" align="center"> {{ $message }}</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger" role="alert" align="center"> {{ $message }}</div>
@endif
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-xs-12">

            <div class="x_panel">
                <div class="alert alert-danger" id="dangermsg" style="display:none;" role="alert" align="center"></div>
                <div class="x_title">
                    <h1>Settings</h1>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('updatesettings') }}" enctype="multipart/form-data" id="myform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email (Admin)
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red; font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input name="email_admin" id="email_admin" value="{{$admindata->email}}" required="required" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email (Contact Us)
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red; font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input name="email_Contact" id="email_Contact" value="{{$admindata->contactus_email}}" required="required" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deposit ( KD )
                            <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
    </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input required="required" name="deposit" id="deposit" value="{{$admindata->deposit}}" type="text" class="form-control" placeholder="100">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deposit is Available
                            <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
    </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input required="required" name="deposit_available" id="deposit_available"  value="{{$admindata->deposit_available}}" type="text" class="form-control" placeholder="48"> Hours before Check-in
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pay the remaining amount of the booking
                            <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input required="required" type="text" name="remaining_amt_pay" id="reamining_amt_pay" onchange="deposit_validation();" value="{{$admindata->remaining_amt_pay}}" class="form-control" placeholder="72"> Hours before the Check-in date
                            </div>  
                            <span id='deposit_validation'></span>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Offers Expires before </label>
                            <div class="col-md-5 col-sm-4 col-xs-12">
                                <input id="middle-name" name="offer_expiry" value="{{$admindata->offer_expiry}}" class="form-control col-md-7 col-xs-12" type="number" name="middle-name" placeholder="12"> Hours from Data the Check-in
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Check-in</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <select class="form-control" name="check_in">
                                    <option> </option>
                                    <option value="01:00 AM" <?= $admindata->check_in == '01:00 AM' ? ' selected="selected"' : ''; ?>>01:00 AM</option>

                                    <option value="02:00 AM" <?= $admindata->check_in == '02:00 AM' ? ' selected="selected"' : ''; ?>>02:00 AM</option>

                                    <option value="03:00 AM" <?= $admindata->check_in == '03:00 AM' ? ' selected="selected"' : ''; ?>>03:00 AM</option>

                                    <option value="04:00 AM" <?= $admindata->check_in == '04:00 AM' ? ' selected="selected"' : ''; ?>>04:00 AM</option>

                                    <option value="05:00 AM" <?= $admindata->check_in == '05:00 AM' ? ' selected="selected"' : ''; ?>>05:00 AM</option>

                                    <option value="06:00 AM" <?= $admindata->check_in == '06:00 AM' ? ' selected="selected"' : ''; ?>>06:00 AM</option>

                                    <option value="07:00 AM" <?= $admindata->check_in == '07:00 AM' ? ' selected="selected"' : ''; ?>>07:00 AM</option>

                                    <option value="08:00 AM" <?= $admindata->check_in == '08:00 AM' ? ' selected="selected"' : ''; ?>>08:00 AM</option>

                                    <option value="09:00 AM" <?= $admindata->check_in == '09:00 AM' ? ' selected="selected"' : ''; ?>>09:00 AM</option>

                                    <option value="10:00 AM" <?= $admindata->check_in == '10:00 AM' ? ' selected="selected"' : ''; ?>>10:00 AM</option>

                                    <option value="11:00 AM" <?= $admindata->check_in == '11:00 AM' ? ' selected="selected"' : ''; ?>>11:00 AM</option>

                                    <option value="12:00 AM" <?= $admindata->check_in == '12:00 AM' ? ' selected="selected"' : ''; ?>>12:00 AM</option>

                                    <option value="01:00 PM" <?= $admindata->check_in == '01:00 PM' ? ' selected="selected"' : ''; ?>>01:00 PM</option>

                                    <option value="02:00 PM" <?= $admindata->check_in == '02:00 PM' ? ' selected="selected"' : ''; ?>>02:00 PM</option>

                                    <option value="03:00 PM" <?= $admindata->check_in == '03:00 PM' ? ' selected="selected"' : ''; ?>>03:00 PM</option>

                                    <option value="04:00 PM" <?= $admindata->check_in == '04:00 PM' ? ' selected="selected"' : ''; ?>>04:00 PM</option>

                                    <option value="05:00 PM" <?= $admindata->check_in == '05:00 PM' ? ' selected="selected"' : ''; ?>>05:00 PM</option>

                                    <option value="06:00 PM" <?= $admindata->check_in == '06:00 PM' ? ' selected="selected"' : ''; ?>>06:00 PM</option>

                                    <option value="07:00 PM" <?= $admindata->check_in == '07:00 PM' ? ' selected="selected"' : ''; ?>>07:00 PM</option>

                                    <option value="08:00 PM" <?= $admindata->check_in == '08:00 PM' ? ' selected="selected"' : ''; ?>>08:00 PM</option>

                                    <option value="09:00 PM" <?= $admindata->check_in == '09:00 PM' ? ' selected="selected"' : ''; ?>>09:00 PM</option>

                                    <option value="10:00 PM" <?= $admindata->check_in == '10:00 PM' ? ' selected="selected"' : ''; ?>>10:00 PM</option>

                                    <option value="11:00 PM" <?= $admindata->check_in == '11:00 PM' ? ' selected="selected"' : ''; ?>>11:00 PM</option>

                                    <option value="12:00 PM" <?= $admindata->check_in == '12:00 PM' ? ' selected="selected"' : ''; ?>>12:00 PM</option>
                                </select>

                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Check-out</label>

                            <div class="col-md-5 col-sm-9 col-xs-12">

                                <select class="form-control" name="check_out">
                                    <option> </option>
                                    <option value="01:00 AM" <?= $admindata->check_out == '01:00 AM' ? ' selected="selected"' : ''; ?>>01:00 AM</option>

                                    <option value="02:00 AM" <?= $admindata->check_out == '02:00 AM' ? ' selected="selected"' : ''; ?>>02:00 AM</option>

                                    <option value="03:00 AM" <?= $admindata->check_out == '03:00 AM' ? ' selected="selected"' : ''; ?>>03:00 AM</option>

                                    <option value="04:00 AM" <?= $admindata->check_out == '04:00 AM' ? ' selected="selected"' : ''; ?>>04:00 AM</option>

                                    <option value="05:00 AM" <?= $admindata->check_out == '05:00 AM' ? ' selected="selected"' : ''; ?>>05:00 AM</option>

                                    <option value="06:00 AM" <?= $admindata->check_out == '06:00 AM' ? ' selected="selected"' : ''; ?>>06:00 AM</option>

                                    <option value="07:00 AM" <?= $admindata->check_out == '07:00 AM' ? ' selected="selected"' : ''; ?>>07:00 AM</option>

                                    <option value="08:00 AM" <?= $admindata->check_out == '08:00 AM' ? ' selected="selected"' : ''; ?>>08:00 AM</option>

                                    <option value="09:00 AM" <?= $admindata->check_out == '09:00 AM' ? ' selected="selected"' : ''; ?>>09:00 AM</option>

                                    <option value="10:00 AM" <?= $admindata->check_out == '10:00 AM' ? ' selected="selected"' : ''; ?>>10:00 AM</option>

                                    <option value="11:00 AM" <?= $admindata->check_out == '11:00 AM' ? ' selected="selected"' : ''; ?>>11:00 AM</option>

                                    <option value="12:00 AM" <?= $admindata->check_out == '12:00 AM' ? ' selected="selected"' : ''; ?>>12:00 AM</option>

                                    <option value="01:00 PM" <?= $admindata->check_out == '01:00 PM' ? ' selected="selected"' : ''; ?>>01:00 PM</option>

                                    <option value="02:00 PM" <?= $admindata->check_out == '02:00 PM' ? ' selected="selected"' : ''; ?>>02:00 PM</option>

                                    <option value="03:00 PM" <?= $admindata->check_out == '03:00 PM' ? ' selected="selected"' : ''; ?>>03:00 PM</option>

                                    <option value="04:00 PM" <?= $admindata->check_out == '04:00 PM' ? ' selected="selected"' : ''; ?>>04:00 PM</option>

                                    <option value="05:00 PM" <?= $admindata->check_out == '05:00 PM' ? ' selected="selected"' : ''; ?>>05:00 PM</option>

                                    <option value="06:00 PM" <?= $admindata->check_out == '06:00 PM' ? ' selected="selected"' : ''; ?>>06:00 PM</option>

                                    <option value="07:00 PM" <?= $admindata->check_out == '07:00 PM' ? ' selected="selected"' : ''; ?>>07:00 PM</option>

                                    <option value="08:00 PM" <?= $admindata->check_out == '08:00 PM' ? ' selected="selected"' : ''; ?>>08:00 PM</option>

                                    <option value="09:00 PM" <?= $admindata->check_out == '09:00 PM' ? ' selected="selected"' : ''; ?>>09:00 PM</option>

                                    <option value="10:00 PM" <?= $admindata->check_out == '10:00 PM' ? ' selected="selected"' : ''; ?>>10:00 PM</option>

                                    <option value="11:00 PM" <?= $admindata->check_out == '11:00 PM' ? ' selected="selected"' : ''; ?>>11:00 PM</option>

                                    <option value="12:00 PM" <?= $admindata->check_out == '12:00 PM' ? ' selected="selected"' : ''; ?>>12:00 PM</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Instagram
                             <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red; font-size: 10px;"></i> -->
    </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input required="required" type="text" name="insta_url" id="insta_url" value="{{$admindata->insta_url}}" class="form-control" placeholder="http//www.instagram.com/aby.chalet">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">URL : Terms
                            <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
    </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input required="required" type="text" name="terms_url" id="terms_url" value="{{$admindata->terms_url}}" class="form-control" placeholder="http//www.domain.com/Terms">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">URL : Legal & Privacy
                            <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input required="required" name="landp_url" id="landp_url" value="{{$admindata->l_and_p_url}}" type="text" class="form-control" placeholder="http//www.domain.com/Legal">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">URL : Share App
                            <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
    </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input required="required" name="shareapp_url" id="shareapp_url" value="{{$admindata->shareapp_url}}" type="text" class="form-control" placeholder="http//www.domain.com/Share">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Invite friend</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <textarea class="form-control" name="invite_friend"  rows="5" placeholder="Hi,
Aby Chalet

Download App And Enjoy

http://www.domain.com">{{$admindata->invite_friend}}</textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Time Zone</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <select class="form-control" name="timezone">
                                    <option value="Pacific/Midway" <?= $admindata->timezone == 'Pacific/Midway' ? ' selected="selected"' : ''; ?>>GMT-11:00 Midway Island, Samoa</option>

                                    <option value="Pacific/Honolulu" <?= $admindata->timezone == 'Pacific/Honolulu' ? ' selected="selected"' : ''; ?>>GMT-10:00 Hawaii</option>

                                    <option value="America/Nome" <?= $admindata->timezone == 'America/Nome' ? ' selected="selected"' : ''; ?>>GMT-09:00 Alaska</option>

                                    <option value="America/Los_Angeles" <?= $admindata->timezone == 'America/Los_Angeles' ? ' selected="selected"' : ''; ?>>GMT-08:00 Pacific Time (US &amp; Canada); Los Angeles</option>

                                    <option value="America/Tijuana" <?= $admindata->timezone == 'America/Tijuana' ? ' selected="selected"' : ''; ?>>GMT-08:00 Pacific Time (US &amp; Canada); Tijuana</option>

                                    <option value="America/Phoenix" <?= $admindata->timezone == 'America/Phoenix' ? ' selected="selected"' : ''; ?>>GMT-07:00 Arizona</option>

                                    <option value="America/Denver" <?= $admindata->timezone == 'America/Denver' ? ' selected="selected"' : ''; ?>>GMT-07:00 Mountain Time (US &amp; Canada)</option>

                                    <option value="America/Chicago" <?= $admindata->timezone == 'America/Chicago' ? ' selected="selected"' : ''; ?>>GMT-06:00 Central Time (US &amp; Canada)</option>

                                    <option value="America/Indiana/Knox" <?= $admindata->timezone == 'America/Indiana/Knox' ? ' selected="selected"' : ''; ?>>GMT-06:00 Eastern Time - Indiana - Starke County</option>

                                    <option value="America/Mexico_City" <?= $admindata->timezone == 'America/Mexico_City' ? ' selected="selected"' : ''; ?>>GMT-06:00 Mexico City, Tegucigalpa</option>

                                    <option value="America/Managua" <?= $admindata->timezone == 'America/Managua' ? ' selected="selected"' : ''; ?>>GMT-06:00 Nicaragua</option>

                                    <option value="America/Regina" <?= $admindata->timezone == 'America/Regina' ? ' selected="selected"' : ''; ?>>GMT-06:00 Saskatchewan</option>

                                    <option value="America/Bogota" <?= $admindata->timezone == 'America/Bogota' ? ' selected="selected"' : ''; ?>>GMT-05:00 Bogota, Lima</option>

                                    <option value="America/New_York" <?= $admindata->timezone == 'America/New_York' ? ' selected="selected"' : ''; ?>>GMT-05:00 Eastern Time (US &amp; Canada)</option>

                                    <option value="America/Indiana/Indianapolis" <?= $admindata->timezone == 'America/Indiana/Indianapolis' ? ' selected="selected"' : ''; ?>>GMT-05:00 Eastern Time - Indiana - most locations</option>

                                    <option value="America/Caracas" <?= $admindata->timezone == 'America/Caracas' ? ' selected="selected"' : ''; ?>>GMT-04:30 Caracas</option>

                                    <option value="America/Halifax" <?= $admindata->timezone == 'America/Halifax' ? ' selected="selected"' : ''; ?>>GMT-04:00 Atlantic Time (Canada)</option>

                                    <option value="America/La_Paz" <?= $admindata->timezone == 'America/La_Paz' ? ' selected="selected"' : ''; ?>>GMT-04:00 La Paz</option>

                                    <option value="America/St_Johns" <?= $admindata->timezone == 'America/St_Johns' ? ' selected="selected"' : ''; ?>>GMT-03:30 Newfoundland</option>

                                    <option value="America/Buenos_Aires" <?= $admindata->timezone == 'America/Buenos_Aires' ? ' selected="selected"' : ''; ?>>GMT-03:00 E Argentina (BA, DF, SC, TF)</option>

                                    <option value="America/Fortaleza" <?= $admindata->timezone == 'America/Fortaleza' ? ' selected="selected"' : ''; ?>>GMT-03:00 NE Brazil (MA, PI, CE, RN, PB)</option>

                                    <option value="America/Recife" <?= $admindata->timezone == 'America/Recife' ? ' selected="selected"' : ''; ?>>GMT-03:00 Pernambuco</option>

                                    <option value="America/Sao_Paulo" <?= $admindata->timezone == 'America/Sao_Paulo' ? ' selected="selected"' : ''; ?>>GMT-03:00 S &amp; SE Brazil (GO, DF, MG, ES, RJ, SP, PR, SC, RS)</option>

                                    <option value="Atlantic/South_Georgia" <?= $admindata->timezone == 'Atlantic/South_Georgia' ? ' selected="selected"' : ''; ?>>GMT-02:00 Mid-Atlantic</option>

                                    <option value="Atlantic/Azores" <?= $admindata->timezone == 'Atlantic/Azores' ? ' selected="selected"' : ''; ?>>GMT-01:00 Azores, Cape Verde Island</option>

                                    <option value="Africa/Casablanca" <?= $admindata->timezone == 'Africa/Casablanca' ? ' selected="selected"' : ''; ?>>GMT (no DST) Tangiers, Casablanca</option>

                                    <option value="Europe/Lisbon" <?= $admindata->timezone == 'Europe/Lisbon' ? ' selected="selected"' : ''; ?>>GMT+00:00 Lisbon</option>

                                    <option value="Etc/GMT" <?= $admindata->timezone == 'Etc/GMT' ? ' selected="selected"' : ''; ?>>GMT (Coordinated Universal Time)</option>

                                    <option value="Europe/London" <?= $admindata->timezone == 'Europe/London' ? ' selected="selected"' : ''; ?>>GMT (Coordinated Universal Time) Dublin, Edinburgh, London</option>

                                    <option value="Europe/Berlin" <?= $admindata->timezone == 'Europe/Berlin' ? ' selected="selected"' : ''; ?>>GMT+01:00 Berlin, Stockholm, Rome, Bern, Brussels</option>

                                    <option value="Europe/Paris" <?= $admindata->timezone == 'Europe/Paris' ? ' selected="selected"' : ''; ?>>GMT+01:00 Paris, Madrid</option>

                                    <option value="Europe/Prague" <?= $admindata->timezone == 'Europe/Prague' ? ' selected="selected"' : ''; ?>>GMT+01:00 Prague, Warsaw</option>

                                    <option value="Europe/Athens" <?= $admindata->timezone == 'Europe/Athens' ? ' selected="selected"' : ''; ?>>GMT+02:00 Athens, Helsinki, Istanbul</option>

                                    <option value="Africa/Cairo" <?= $admindata->timezone == 'Africa/Cairo' ? ' selected="selected"' : ''; ?>>GMT+02:00 Cairo</option>
                                    <option value="EET" <?= $admindata->timezone == 'EET' ? ' selected="selected"' : ''; ?>>GMT+02:00 Eastern Europe</option>

                                    <option value="Africa/Harare" <?= $admindata->timezone == 'Africa/Harare' ? ' selected="selected"' : ''; ?>>GMT+02:00 Harare, Pretoria</option>

                                    <option value="Asia/Jerusalem" <?= $admindata->timezone == 'Asia/Jerusalem' ? ' selected="selected"' : ''; ?>>GMT+02:00 Israel</option>

                                    <option value="Asia/Baghdad" <?= $admindata->timezone == 'Asia/Baghdad' ? ' selected="selected"' : ''; ?>>GMT+03:00 Baghdad, Kuwait, Nairobi, Riyadh</option>

                                    <option value="Europe/Moscow" <?= $admindata->timezone == 'Europe/Moscow' ? ' selected="selected"' : ''; ?>>GMT+03:00 Moscow, St. Petersburg, Volgograd</option>

                                    <option value="Asia/Tehran" <?= $admindata->timezone == 'Asia/Tehran' ? ' selected="selected"' : ''; ?>>GMT+03:30 Tehran</option>

                                    <option value="Asia/Tbilisi" <?= $admindata->timezone == 'Asia/Tbilisi' ? ' selected="selected"' : ''; ?>>GMT+04:00 Abu Dhabi, Muscat, Tbilisi, Kazan</option>

                                    <option value="Asia/Kabul" <?= $admindata->timezone == 'Asia/Kabul' ? ' selected="selected"' : ''; ?>>GMT+04:30 Kabul</option>

                                    <option value="Asia/Karachi" <?= $admindata->timezone == 'Asia/Karachi' ? ' selected="selected"' : ''; ?>>GMT+05:00 Islamabad, Karachi</option>

                                    <option value="Asia/Yekaterinburg" <?= $admindata->timezone == 'Asia/Yekaterinburg' ? ' selected="selected"' : ''; ?>>GMT+05:00 Sverdlovsk, Tashkent</option>

                                    <option value="Asia/Calcutta" <?= $admindata->timezone == 'Asia/Calcutta' ? ' selected="selected"' : ''; ?>>GMT+05:30 Mumbai, Kolkata, Chennai, New Delhi</option>

                                    <option value="Asia/Katmandu" <?= $admindata->timezone == 'Asia/Katmandu' ? ' selected="selected"' : ''; ?>>GMT+05:45 Kathmandu, Nepal</option>

                                    <option value="Asia/Almaty" <?= $admindata->timezone == 'Asia/Almaty' ? ' selected="selected"' : ''; ?>>GMT+06:00 Almaty, Dhaka</option>

                                    <option value="Asia/Omsk" <?= $admindata->timezone == 'Asia/Omsk' ? ' selected="selected"' : ''; ?>>GMT+06:00 Omsk, Novosibirsk</option>

                                    <option value="Asia/Bangkok" <?= $admindata->timezone == 'Asia/Bangkok' ? ' selected="selected"' : ''; ?>>GMT+07:00 Bangkok, Jakarta, Hanoi</option>

                                    <option value="Asia/Krasnoyarsk" <?= $admindata->timezone == 'Asia/Krasnoyarsk' ? ' selected="selected"' : ''; ?>>GMT+07:00 Krasnoyarsk</option>

                                    <option value="Asia/Shanghai" <?= $admindata->timezone == 'Asia/Shanghai' ? ' selected="selected"' : ''; ?>>GMT+08:00 Beijing, Chongqing, Urumqi</option>

                                    <option value="Australia/Perth" <?= $admindata->timezone == 'Australia/Perth' ? ' selected="selected"' : ''; ?>>GMT+08:00 Hong Kong SAR, Perth, Singapore, Taipei</option>

                                    <option value="Asia/Irkutsk" <?= $admindata->timezone == 'Asia/Irkutsk' ? ' selected="selected"' : ''; ?>>GMT+08:00 Irkutsk (Lake Baikal)</option>

                                    <option value="Asia/Tokyo" <?= $admindata->timezone == 'Asia/Tokyo' ? ' selected="selected"' : ''; ?>>GMT+09:00 Tokyo, Osaka, Sapporo, Seoul</option>

                                    <option value="Asia/Yakutsk" <?= $admindata->timezone == 'Asia/Yakutsk' ? ' selected="selected"' : ''; ?>>GMT+09:00 Yakutsk (Lena River)</option>

                                    <option value="Australia/Adelaide" <?= $admindata->timezone == 'Australia/Adelaide' ? ' selected="selected"' : ''; ?>>GMT+09:30 Adelaide</option>

                                    <option value="Australia/Darwin" <?= $admindata->timezone == 'Australia/Darwin' ? ' selected="selected"' : ''; ?>>GMT+09:30 Darwin</option>

                                    <option value="Australia/Brisbane" <?= $admindata->timezone == 'Australia/Brisbane' ? ' selected="selected"' : ''; ?>>GMT+10:00 Brisbane</option>

                                    <option value="Pacific/Guam" <?= $admindata->timezone == 'Pacific/Guam' ? ' selected="selected"' : ''; ?>>GMT+10:00 Guam, Port Moresby</option>

                                    <option value="Australia/Sydney" <?= $admindata->timezone == 'Australia/Sydney' ? ' selected="selected"' : ''; ?>>GMT+10:00 Sydney, Melbourne</option>

                                    <option value="Asia/Vladivostok" <?= $admindata->timezone == 'Asia/Vladivostok' ? ' selected="selected"' : ''; ?>>GMT+10:00 Vladivostok</option>

                                    <option value="Australia/Hobart" <?= $admindata->timezone == 'Australia/Hobart' ? ' selected="selected"' : ''; ?>>GMT+11:00 Hobart</option>

                                    <option value="Pacific/Kwajalein" <?= $admindata->timezone == 'Pacific/Kwajalein' ? ' selected="selected"' : ''; ?>>GMT+12:00 Eniwetok, Kwajalein</option>

                                    <option value="Pacific/Fiji" <?= $admindata->timezone == 'Pacific/Fiji' ? ' selected="selected"' : ''; ?>>GMT+12:00 Fiji Islands, Marshall Islands</option>

                                    <option value="Asia/Kamchatka" <?= $admindata->timezone == 'Asia/Kamchatka' ? ' selected="selected"' : ''; ?>>GMT+12:00 Kamchatka</option>

                                    <option value="Asia/Magadan" <?= $admindata->timezone == 'Asia/Magadan' ? ' selected="selected"' : ''; ?>>GMT+12:00 Magadan, Solomon Islands, New Caledonia</option>

                                    <option value="Pacific/Auckland" <?= $admindata->timezone == 'Pacific/Auckland' ? ' selected="selected"' : ''; ?>>GMT+12:00 Wellington, Auckland</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Rewards</h3>
                        Example: Earn 100 KD On every 2000 KD spent
                        <br>
                        <i>Note</i>: Must be used Total Rewards before the end of the year
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Earn
                            </label>
                            <div class="col-md-5 col-sm-4 col-xs-12">
                                <input type="number" id="last-name" name="reward_earn" value="{{$admindata->reward_earn}}" class="form-control col-md-7 col-xs-12" placeholder="100"> <strong>KD</strong>
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">On every</label>

                            <div class="col-md-5 col-sm-4 col-xs-12">

                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="number" placeholder="2000" name="every_spend" value="{{$admindata->every_spend}}"> <strong>KD</strong> Spent

                            </div>

                        </div>
                        <hr>
                        <h3>Change password</h3>Leave password fields blank for unchange.
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password</label>
                            <div class="col-md-5 col-sm-4 col-xs-12">
                                <input type="hidden" value="{{$admindata->password}}" name="old_adminpassword" class="form-control col-md-7 col-xs-12">
                                <input type="text" id="password" name="adminpassword" class="form-control col-md-7 col-xs-12" placeholder="New Password" style="-webkit-text-security:disc;font-family:dotsfont;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat New Passwords</label>
                            <div class="col-md-5 col-sm-4 col-xs-12">
                                <input id="cpassword" class="form-control col-md-7 col-xs-12" type="text" name="cadminpassword" placeholder="Repeat New Passwords" style="-webkit-text-security:disc;font-family:dotsfont;">
                            </div>
                            <span id='message'></span>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script>
 function deposit_validation() {
    $deposit_available=$('#deposit_available').val();
    $deposit=$('#reamining_amt_pay').val();
    // alert($deposit);
    if($deposit>$deposit_available){
        $('#deposit_validation').html('Hours remaining to pay Must be Lower than Deposit available hour').css('color', 'red'); 
    }
 }

    $('#password, #cpassword').on('keyup', function() {
        if ($('#password').val() == $('#cpassword').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    function myFunction() {
        if ($('#password').val() == $('#cpassword').val()) {
            // $('#message').html('Matching').css('color', 'green');
            if ((!$('#email_admin').val()), (!$('#email_Contact').val()), (!$('#deposit').val()), (!$('#deposit_available').val()), (!$('#reamining_amt_pay').val()), (!$('#insta_url').val()), (!$('#terms_url').val()), (!$('#landp_url').val()), (!$('#shareapp_url').val())) {
                $('#dangermsg').html('Please Enter Required Fields').css('display', 'block');
                $(window).scrollTop(0);
            } else {
                $('#dangermsg').css('display', 'none');
                $("#myform").submit();
            }

        } else
            $('#dangermsg').html('Please Enter Matching Password').css('display', 'block');
        $(window).scrollTop(0);
    }
</script>
@endsection