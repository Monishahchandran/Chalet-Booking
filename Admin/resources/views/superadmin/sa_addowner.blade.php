@extends('superadmin.layouts.sa_layout')
@section('title', "Add Owner")
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<style>
    #pfile {
        border-radius: 50px;
    }
</style>
<div class="">

    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
                <div class="alert alert-danger" id="dangermsg" style="display:none;" role="alert" align="center"></div>
                @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert" align="center">{{ $message }}</div>
                @endif

                <div class="x_title">
                    <h1>Add Owner</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('addowner') }}" enctype="multipart/form-data" id="myform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Profile Photo
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div>
                                    <div id="image_preview">
                                        <a href="images/img.jpg" target="_blank"><img border="0" src="images/img.jpg" width="100" height="100" ></a>
                                    </div><br>
                                    <input class="col-md-12 col-sm-12 col-xs-12"  type="file" name="photo" id="photo" class="form-control"><br>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                                </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" id="first-name" name="first_name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                                </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" id="last_name" name="last_name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                                </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Country
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                                <select class="form-control" id="country" name="country" >
                                    <option selected> </option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="United Arab Erimates">United Arab Emirates</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Qatar">Qatar</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile Number
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input  class="form-control col-md-7 col-xs-12" type="number" name="phone" id="phone" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                                <select class="form-control" name="gender" id="gender" >
                                    <option selected> </option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Documents</h3>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">CIVIL ID
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <table border="0" width="100%">
                                    <tr>
                                        <td width="0" valign="top">x</td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="100%" colspan="2" cellpadding="5"><input class="col-md-12 col-sm-12 col-xs-12" type="file"  name="civilid" id="civilid" class="form-control"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Chalet ownership
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <table border="0" width="100%">
                                    <tr>
                                        <td width="0" valign="top">x</td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="100%" colspan="2" cellpadding="5"><input class="col-md-12 col-sm-12 col-xs-12"  type="file" name="ownership" id="ownership" class="form-control"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Agreement
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <table border="0" width="100%">
                                    <tr>
                                        <td width="0" valign="top">x</td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="100%" colspan="2" cellpadding="5"><input class="col-md-12 col-sm-12 col-xs-12" type="file"  name="agreement" id="agreement" class="form-control"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <h3>Bank Detail</h3>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bank Account Holder Name
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input id="holder_name" class="form-control col-md-7 col-xs-12" type="text" name="holder_name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank Name
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                                <select class="form-control" name="bank_name" id="bank_name" >
                                    <option selected> </option>
                                    <option value="BKM">Ahli United</option>
                                    <option value="ABK">Al Ahli Bank of Kuwait</option>
                                    <option value="BNP">BNP-BNP Paribas</option>
                                    <option value="BBK">BOB&amp;K-Bank of Bahrain and Kuwait</option>
                                    <option value="BOB">BOBBK-Boubyan Bank</option>
                                    <option value="BUR">BURGAN-Burgan Bank of Kuwait</option>
                                    <option value="COB">CBK- Commercial Bank of Kuwait</option>
                                    <option value="CBK">Central- Central Bank of Kuwait</option>
                                    <option value="CIT">CITI-CitiBank Kuwait</option>
                                    <option value="DOH">DOHA BANK</option>
                                    <option value="GBK">GULF- Gulf Bank</option>
                                    <option value="HSB">HSBC-HSBC</option>
                                    <option value="IBK">IBK-Industrial Bank of Kuwait</option>
                                    <option value="ICK">Industrial and Commercial Bank of China Limited - Kuwait </option>
                                    <option value="KFH">KFH-Kuwait Finance House</option>
                                    <option value="KIB">KIB-Kuwait International Bank</option>
                                    <option value="MSR">Mashreq Bank</option>
                                    <option value="MSQ">Masqat Bank</option>
                                    <option value="RAJ">Masraf Al-Rajhi</option>
                                    <option value="NBK">National Bank Of Kuwait NBK</option>
                                    <option value="NBA">NBAD-National Bank of Abu Dhabi</option>
                                    <option value="QNB">QATAR NATIONAL BANK KUWAIT</option>
                                    <option value="SCB">SCB-Saving and Credit Bank</option>
                                    <option value="UNB">Union National Bank - Kuwait</option>
                                    <option value="WRB">Warba Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">IBAN Number
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input id="iban_num" class="form-control col-md-7 col-xs-12" type="text" name="iban_num" onchange="ValidateIBAN();">
                            </div>
                            <input type="hidden" id='error_message' name='error_message'>
                            <span id='errormessage'></span>
                        </div>
                        <hr>
                        <h3>Password</h3>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Password
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" placeholder="Password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Passwords
                                <!-- <i class="fa fa-asterisk" aria-hidden="true" id="farequired" style="color: red;font-size: 10px;"></i> -->
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input id="cpassword" class="form-control col-md-7 col-xs-12" type="password" name="cpassword" placeholder="Repeat Passwords" >
                            </div>
                            <span id='message'></span>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <div id="submitbutton">
                                    <button id="submit_send" type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#photo").change(function() {
        $('#image_preview').html("");
        var total_file = document.getElementById("photo").files.length;
        for (var i = 0; i < total_file; i++) {
            $('#image_preview').append("<a target='_blank' href=" + URL.createObjectURL(event.target.files[i]) + "><img  width=" + 100 + "; height=" + 100 + "; id='pfile' src=" + URL.createObjectURL(event.target.files[i]) + "></a>");
        }
    });
    $('#password, #cpassword').on('keyup', function() {
        if ($('#password').val() == $('#cpassword').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    function myFunction() {
        if ($('#password').val() == $('#cpassword').val()) {
            // $('#message').html('Matching').css('color', 'green');
            // if ($('#photo').val() == '') {
            //     $('#dangermsg').html('Please Enter Required Fields').css('display', 'block');
            //     $(window).scrollTop(0);
            // } else {
            //     if ($('#civilid').val() == '') {
            //         $('#dangermsg').html('Please Enter Required Fields').css('display', 'block');
            //         $(window).scrollTop(0);
            //     } else {
            //         if ($('#ownership').val() == '') {
            //             $('#dangermsg').html('Please Enter Required Fields').css('display', 'block');
            //             $(window).scrollTop(0);
            //         } else {
            //             if ($('#agreement').val() == '') {
            //                 $('#dangermsg').html('Please Enter Required Fields').css('display', 'block');
            //                 $(window).scrollTop(0);
            //             } else {
            if ($('#error_message').val() == '1') {
                $('#dangermsg').html('Please Enter Valid IBAN Number').css('display', 'block');
                $(window).scrollTop(0);
            } else {
                // , (!$('#country').val()), (!$('#phone').val()), (!$('#gender').val()), (!$('#holder_name').val()), (!$('#bank_name').val()), (!$('#iban_num').val()), (!$('#password').val()), (!$('#cpassword').val())
                if ((!$('#first_name').val()), (!$('#last_name').val()), (!$('#email').val())) {
                    $('#dangermsg').html('Please Enter Required Fields').css('display', 'block');
                    $(window).scrollTop(0);
                } else {
                    $('#dangermsg').css('display', 'none');
                    $("#myform").submit();
                }
            }

            //         }
            //     }
            // }
            // }
        } else
            $('#dangermsg').html('Please Enter Matching Password').css('display', 'block');
        $(window).scrollTop(0);
    }
</script>
<script>
    function ValidateIBAN() {
        //var IBAN = "DE12500105170648489890";

        //var IBAN = "GB82WEST12345698765432";

        // var IBAN="AE260211000000230064016";
        var IBAN = $('#iban_num').val()
        // alert(IBAN);

        // if (IBAN == "") {
        // alert("Please Enter IBAN Value");
        // // this.getField("txtIBAN").setFocus();
        // // exit();
        // }
        if (IBAN != "") {

            if (IBAN.length != 23) {
                // alert("IBAN Validation Error!! IBAN should contain 23 Characters");
                // this.getField("txtIBAN").setFocus();
                // exit();
                $('#errormessage').html('IBAN Validation Error!! IBAN should contain 23 Characters').css('color', 'red');
                $('#error_message').val('1');
            } else {

                var moveLast = IBAN.substring(0, 2);


                var CheckDigit = IBAN.substring(2, 4);

                var BankCode = IBAN.substring(4, 7);
                var AccountCode = IBAN.substring(7, 23);


                if (CheckAllCaps(IBAN) == false) {
                    // alert("Invalid IBAN");
                    // this.getField("txtIBAN").setFocus();
                    // exit();
                    $('#errormessage').html('Invalid IBAN').css('color', 'red');
                    $('#error_message').val('1');
                } else {
                    // alert("valid");
                    $('#errormessage').html('Valid').css('color', 'green');
                    $('#error_message').val('0');
                }
                // var CountryCodeString = '';
                // CountryCodeString = GetCharCode(CountryCode);

                // alert(CountryCodeString);

                // moveLast = BankCode + AccountCode + CountryCodeString + CheckDigit;

                // moveLast = RemoveLeadingZeros(moveLast);



                // alert(strcode);

                // var strcode = parseFloat(strcode) % 97;
                // alert(strcode);

                // if (strcode != "1") {
                // alert("Not a valid IBAN");
                // // this.getField("txtIBAN").setFocus();
                // // exit();
                // }
            }
        }
    }

    function CheckAllCaps(IBAN) {
        var i = 0;
        var countUpper = 0;
        var countAlphabets = 0;
        var character = '';
        while (i <= IBAN.length) {
            character = IBAN.charAt(i);
            if (isNaN(character * 1)) {
                countAlphabets++;
                if (character == character.toUpperCase()) {
                    countUpper++;
                }
            }
            i++;
        }
        if ((countAlphabets == 0) || (countAlphabets != countUpper)) {
            return false;
        }
        return true;
    }

    function GetCharCode(CountryCode) {
        var count = 0;
        var CountryCodeSplit = '';
        var CountryCodeStr = '';
        var Result = '';
        var charCodeAr = new Array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        var DecValueAr = new Array("10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35");
        while (count <= 1) {
            for (var i = 0; i < charCodeAr.length; i++) {
                if (CountryCode.substring(count, count + 1) == charCodeAr[i]) {
                    Result = Result + DecValueAr[i];
                }
            }
            count++;
        }

        return Result;
    }
</script>
@endsection