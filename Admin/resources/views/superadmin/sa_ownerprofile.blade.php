@extends('superadmin.layouts.sa_layout')
@section('title', 'Owner Profile')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
                @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert" align="center">
                    Profile has been Saved
                </div>
                @endif
                <div class="x_title">
                    <h1>Owner Profile</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('editowner') }}" enctype="multipart/form-data" id="myform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="ownerid" name="ownerid" value="{{$ownerdetails->id}}">
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Profile Photo
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div>
                                    <div id="image_preview">
                                        @if(!empty($ownerdetails->profile_pic))
                                        <a href="{{url('uploads/profile_pic/')}}/<?php echo $ownerdetails->profile_pic; ?>" target="_blank"><img id="pfile" border="0" src="{{url('uploads/profile_pic/')}}/<?php echo $ownerdetails->profile_pic; ?>" width="100" height="100"></a>
                                        @else
                                        <a href="{{url('images/img.jpg')}}" target="_blank"><img id="pfile" border="0" src="{{url('images/img.jpg')}}" width="100" height="100"></a>
                                        @endif
                                    </div>
                                    <br>
                                    <input class="col-md-12 col-sm-12 col-xs-12" required="required" type="file" name="photo" id="photo" class="form-control"><br>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" id="first_name" name="first_name" required="required" class="form-control col-md-7 col-xs-12" value="{{$ownerdetails->first_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" id="last_name" name="last_name" required="required" class="form-control col-md-7 col-xs-12" value="{{$ownerdetails->last_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{$ownerdetails->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                                <select class="form-control" id="country" name="country" required="required">
                                    <option> </option>
                                    <option value="Kuwait" <?= $ownerdetails->country == 'Kuwait' ? ' selected="selected"' : ''; ?>>Kuwait</option>
                                    <option value="Saudi Arabia" <?= $ownerdetails->country == 'Saudi Arabia' ? ' selected="selected"' : ''; ?>>Saudi Arabia</option>
                                    <option value="United Arab Erimates" <?= $ownerdetails->country == 'United Arab Erimates' ? ' selected="selected"' : ''; ?>>United Arab Emirates</option>
                                    <option value="Bahrain" <?= $ownerdetails->country == 'Bahrain' ? ' selected="selected"' : ''; ?>>Bahrain</option>
                                    <option value="Oman" <?= $ownerdetails->country == 'Oman' ? ' selected="selected"' : ''; ?>>Oman</option>
                                    <option value="Qatar" <?= $ownerdetails->country == 'Qatar' ? ' selected="selected"' : ''; ?>>Qatar</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile Number</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input name="phone" id="phone" class="form-control col-md-7 col-xs-12" type="number" value="{{$ownerdetails->phone}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                                <select class="form-control" name="gender" id="gender" required="required">
                                    <option selected> </option>
                                    <option value="Male" <?= $ownerdetails->gender == 'Male' ? ' selected="selected"' : ''; ?>>Male</option>
                                    <option value="Female" <?= $ownerdetails->gender == 'Female' ? ' selected="selected"' : ''; ?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Sign Up</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div>
                                    <h5>{{date('Y-m-d h:i A', strtotime($ownerdetails->created_at))}}</h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3>Documents</h3>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">CIVIL ID</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <table border="0" width="100%">
                                    <tr>
                                        <td width="0" valign="top">x</td>
                                    </tr>
                                    <tr>
                                    <td align="center" width="100%" colspan="2" cellpadding="5"><input class="col-md-12 col-sm-12 col-xs-12" type="file" required="required" name="civilid" id="civilid" class="form-control"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Chalet ownership</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <table border="0" width="100%">
                                    <tr><td width="0" valign="top">x</td></tr>
                                    <tr>
                                    <td align="center" width="100%" colspan="2" cellpadding="5"><input class="col-md-12 col-sm-12 col-xs-12" required="required" type="file" name="ownership" id="ownership" class="form-control"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Agreement</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <table border="0" width="100%">
                                    <tr><td width="0" valign="top">x</td></tr>
                                    <tr>
                                    <td align="center" width="100%" colspan="2" cellpadding="5"><input class="col-md-12 col-sm-12 col-xs-12" type="file" required="required" name="agreement" id="agreement" class="form-control"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <h3>Bank Detail</h3>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bank Account Holder Name</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                            <input id="holder_name" class="form-control col-md-7 col-xs-12" type="text" name="holder_name" required="required" value="{{$ownerdetails->bank_holder_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank Name</label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                                <select class="form-control" name="bank_name" id="bank_name" required="required">
                                    <option selected> </option>
                                    <option value="BKM" <?= $ownerdetails->bank_name == 'BKM' ? ' selected="selected"' : ''; ?>>Ahli United</option>
                                    <option value="ABK" <?= $ownerdetails->bank_name == 'ABK' ? ' selected="selected"' : ''; ?>>Al Ahli Bank of Kuwait</option>
                                    <option value="BNP" <?= $ownerdetails->bank_name == 'BNP' ? ' selected="selected"' : ''; ?>>BNP-BNP Paribas</option>
                                    <option value="BBK" <?= $ownerdetails->bank_name == 'BBK' ? ' selected="selected"' : ''; ?>>BOB&amp;K-Bank of Bahrain and Kuwait</option>
                                    <option value="BOB" <?= $ownerdetails->bank_name == 'BOB' ? ' selected="selected"' : ''; ?>>BOBBK-Boubyan Bank</option>
                                    <option value="BUR" <?= $ownerdetails->bank_name == 'BUR' ? ' selected="selected"' : ''; ?>>BURGAN-Burgan Bank of Kuwait</option>
                                    <option value="COB" <?= $ownerdetails->bank_name == 'COB' ? ' selected="selected"' : ''; ?>>CBK- Commercial Bank of Kuwait</option>
                                    <option value="CBK" <?= $ownerdetails->bank_name == 'CBK' ? ' selected="selected"' : ''; ?>>Central- Central Bank of Kuwait</option>
                                    <option value="CIT" <?= $ownerdetails->bank_name == 'CIT' ? ' selected="selected"' : ''; ?>>CITI-CitiBank Kuwait</option>
                                    <option value="DOH" <?= $ownerdetails->bank_name == 'DOH' ? ' selected="selected"' : ''; ?>>DOHA BANK</option>
                                    <option value="GBK" <?= $ownerdetails->bank_name == 'GBK' ? ' selected="selected"' : ''; ?>>GULF- Gulf Bank</option>
                                    <option value="HSB" <?= $ownerdetails->bank_name == 'HSB' ? ' selected="selected"' : ''; ?>>HSBC-HSBC</option>
                                    <option value="IBK" <?= $ownerdetails->bank_name == 'IBK' ? ' selected="selected"' : ''; ?>>IBK-Industrial Bank of Kuwait</option>
                                    <option value="ICK" <?= $ownerdetails->bank_name == 'ICK' ? ' selected="selected"' : ''; ?>>Industrial and Commercial Bank of China Limited - Kuwait </option>
                                    <option value="KFH" <?= $ownerdetails->bank_name == 'KFH' ? ' selected="selected"' : ''; ?>>KFH-Kuwait Finance House</option>
                                    <option value="KIB" <?= $ownerdetails->bank_name == 'KIB' ? ' selected="selected"' : ''; ?>>KIB-Kuwait International Bank</option>
                                    <option value="MSR" <?= $ownerdetails->bank_name == 'MSR' ? ' selected="selected"' : ''; ?>>Mashreq Bank</option>
                                    <option value="MSQ" <?= $ownerdetails->bank_name == 'MSQ' ? ' selected="selected"' : ''; ?>>Masqat Bank</option>
                                    <option value="RAJ" <?= $ownerdetails->bank_name == 'RAJ' ? ' selected="selected"' : ''; ?>>Masraf Al-Rajhi</option>
                                    <option value="NBK" <?= $ownerdetails->bank_name == 'NBK' ? ' selected="selected"' : ''; ?>>National Bank Of Kuwait NBK</option>
                                    <option value="NBA" <?= $ownerdetails->bank_name == 'NBA' ? ' selected="selected"' : ''; ?>>NBAD-National Bank of Abu Dhabi</option>
                                    <option value="QNB" <?= $ownerdetails->bank_name == 'QNB' ? ' selected="selected"' : ''; ?>>QATAR NATIONAL BANK KUWAIT</option>
                                    <option value="SCB" <?= $ownerdetails->bank_name == 'SCB' ? ' selected="selected"' : ''; ?>>SCB-Saving and Credit Bank</option>
                                    <option value="UNB" <?= $ownerdetails->bank_name == 'UNB' ? ' selected="selected"' : ''; ?>>Union National Bank - Kuwait</option>
                                    <option value="WRB" <?= $ownerdetails->bank_name == 'WRB' ? ' selected="selected"' : ''; ?>>Warba Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">IBAN Number</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input id="iban_num" class="form-control col-md-7 col-xs-12" type="text" name="iban_num" value="{{$ownerdetails->iban_num}}" onchange="ValidateIBAN();">
                            </div>
                            <input type="hidden" id='error_message' name='error_message'>
                            <span id='errormessage'></span>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email To</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input id="tomail" name="tomail" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
                                <br><br>
                                <button id="send" onclick="sendmail();" type="button" class="btn btn-success">Send Documents and Bank Detail</button> 
                                <!-- <a href="Example.htm" target="_blank">Example</a> -->
                            </div>
                        </div>
                        <hr>
                        <h3>Change password</h3>
                        Leave password fields blank for unchange.
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="hidden" id="old_password" name="old_password" class="form-control col-md-7 col-xs-12" value="{{$ownerdetails->password}}" >
                            <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" placeholder="New Password" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat New Passwords</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                            <input id="cpassword" class="form-control col-md-7 col-xs-12" type="password" name="cpassword" placeholder="Repeat New Passwords" required="required">
                            </div>
                            <span id='message'></span>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button id="send" type="button" class="btn btn-success" onclick="myFunction()">Save</button>
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
    function sendmail() {
        $holder_name = $('#holder_name').val();
        $bank_name = $('#bank_name').val();
        $iban_num = $('#iban_num').val();
        $tomail = $('#tomail').val();
        $ownerid = $('#ownerid').val();
        // alert($ownerid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert(check);
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('send_bankdetails') }}",
            data: {
                holder_name: $holder_name,
                bank_name: $bank_name,
                iban_num: $iban_num,
                email:$tomail,
                ownerid:$ownerid
            },
            beforeSend: function() {
                // Show image container
                // $("#loader1").show();
            },
            success: function(data) {
                  alert(data.success);

            },
            complete: function(data) {
                // Hide image container
                // $("#loader1").hide();
            }
        });

        // });
    }
</script>
@endsection