@extends('superadmin.layouts.sa_layout')
@section('title', 'User Profile')
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert" align="center">
                    Profile has been Saved
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-success" role="alert" align="center">
                    Password has been Change
                </div>
                @endif
                <div class="x_title">
                    <h1>User Profile</h1>
                    <div class="clearfix"></div>
                </div>
                <br />
                <form class="form-horizontal form-label-left" method="POST" action="{{ url('update_userprofile') }}" enctype="multipart/form-data" id="myform">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="userid" id="userid" value="{{ $userdetails->id }}">
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Profile Photo
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div>
                                @if(!empty($userdetails->profile_pic))
                                <a href="{{url('uploads/profile_pic')}}/<?php echo $userdetails->profile_pic; ?>" target="_blank"><img border="0" src="{{url('uploads/profile_pic')}}/<?php echo $userdetails->profile_pic; ?>" width="100" height="100"></a>
                                @else
                                <a href="{{url('images/img.jpg')}}" target="_blank"><img border="0" src="{{url('images/img.jpg')}}" width="100" height="100"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" id="first-name" name="first_name" required="required" class="form-control col-md-7 col-xs-12" value="{{$userdetails->first_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" id="first-name" name="last_name" required="required" class="form-control col-md-7 col-xs-12" value="{{$userdetails->last_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" id="last-name" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{$userdetails->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                            <select class="form-control" name="country">
                                <option> </option>
                                <option value="Kuwait" <?= $userdetails->country == 'Kuwait' ? ' selected="selected"' : ''; ?>>Kuwait</option>
                                <option value="Saudi Arabia" <?= $userdetails->country == 'Saudi Arabia' ? ' selected="selected"' : ''; ?>>Saudi Arabia</option>
                                <option value="United Arab Erimates" <?= $userdetails->country == 'United Arab Erimates' ? ' selected="selected"' : ''; ?>>United Arab Emirates</option>
                                <option value="Bahrain" <?= $userdetails->country == 'Bahrain' ? ' selected="selected"' : ''; ?>>Bahrain</option>
                                <option value="Oman" <?= $userdetails->country == 'Oman' ? ' selected="selected"' : ''; ?>>Oman</option>
                                <option value="Qatar" <?= $userdetails->country == 'Qatar' ? ' selected="selected"' : ''; ?>>Qatar</option>
                                <option value="Afganistan" <?= $userdetails->country == 'Afganistan' ? ' selected="selected"' : ''; ?>>Afghanistan</option>
                                <option value="Albania" <?= $userdetails->country == 'Albania' ? ' selected="selected"' : ''; ?>>Albania</option>
                                <option value="Algeria" <?= $userdetails->country == 'Algeria' ? ' selected="selected"' : ''; ?>>Algeria</option>
                                <option value="American Samoa" <?= $userdetails->country == 'American Samoa' ? ' selected="selected"' : ''; ?>>American Samoa</option>
                                <option value="Andorra" <?= $userdetails->country == 'Andorra' ? ' selected="selected"' : ''; ?>>Andorra</option>
                                <option value="Angola" <?= $userdetails->country == 'Angola' ? ' selected="selected"' : ''; ?>>Angola</option>
                                <option value="Anguilla" <?= $userdetails->country == 'Anguilla' ? ' selected="selected"' : ''; ?>>Anguilla</option>
                                <option value="Antigua & Barbuda" <?= $userdetails->country == 'Antigua & Barbuda' ? ' selected="selected"' : ''; ?>>Antigua & Barbuda</option>
                                <option value="Argentina" <?= $userdetails->country == 'Argentina' ? ' selected="selected"' : ''; ?>>Argentina</option>
                                <option value="Armenia" <?= $userdetails->country == 'Armenia' ? ' selected="selected"' : ''; ?>>Armenia</option>
                                <option value="Aruba" <?= $userdetails->country == 'Aruba' ? ' selected="selected"' : ''; ?>>Aruba</option>
                                <option value="Australia" <?= $userdetails->country == 'Australia' ? ' selected="selected"' : ''; ?>>Australia</option>
                                <option value="Austria" <?= $userdetails->country == 'Austria' ? ' selected="selected"' : ''; ?>>Austria</option>
                                <option value="Azerbaijan" <?= $userdetails->country == 'Azerbaijan' ? ' selected="selected"' : ''; ?>>Azerbaijan</option>
                                <option value="Bahamas" <?= $userdetails->country == 'Bahamas' ? ' selected="selected"' : ''; ?>>Bahamas</option>
                                <option value="Bangladesh" <?= $userdetails->country == 'Bangladesh' ? ' selected="selected"' : ''; ?>>Bangladesh</option>
                                <option value="Barbados" <?= $userdetails->country == 'Barbados' ? ' selected="selected"' : ''; ?>>Barbados</option>
                                <option value="Belarus" <?= $userdetails->country == 'Belarus' ? ' selected="selected"' : ''; ?>>Belarus</option>
                                <option value="Belgium" <?= $userdetails->country == 'Belgium' ? ' selected="selected"' : ''; ?>>Belgium</option>
                                <option value="Belize" <?= $userdetails->country == 'Belize' ? ' selected="selected"' : ''; ?>>Belize</option>
                                <option value="Benin" <?= $userdetails->country == 'Benin' ? ' selected="selected"' : ''; ?>>Benin</option>
                                <option value="Bermuda" <?= $userdetails->country == 'Bermuda' ? ' selected="selected"' : ''; ?>>Bermuda</option>
                                <option value="Bhutan" <?= $userdetails->country == 'Bhutan' ? ' selected="selected"' : ''; ?>>Bhutan</option>
                                <option value="Bolivia" <?= $userdetails->country == 'Bhutan' ? ' selected="selected"' : ''; ?>>Bolivia</option>
                                <option value="Bonaire" <?= $userdetails->country == 'Bonaire' ? ' selected="selected"' : ''; ?>>Bonaire</option>
                                <option value="Bosnia & Herzegovina" <?= $userdetails->country == 'Bosnia & Herzegovina' ? ' selected="selected"' : ''; ?>>Bosnia & Herzegovina</option>
                                <option value="Botswana" <?= $userdetails->country == 'Botswana' ? ' selected="selected"' : ''; ?>>Botswana</option>
                                <option value="Brazil" <?= $userdetails->country == 'Brazil' ? ' selected="selected"' : ''; ?>>Brazil</option>
                                <option value="British Indian Ocean Ter" <?= $userdetails->country == 'British Indian Ocean Ter' ? ' selected="selected"' : ''; ?>>British Indian Ocean Ter</option>
                                <option value="Brunei" <?= $userdetails->country == 'Brunei' ? ' selected="selected"' : ''; ?>>Brunei</option>
                                <option value="Bulgaria" <?= $userdetails->country == 'Bulgaria' ? ' selected="selected"' : ''; ?>>Bulgaria</option>
                                <option value="Burkina Faso" <?= $userdetails->country == 'Burkina Faso' ? ' selected="selected"' : ''; ?>>Burkina Faso</option>
                                <option value="Burundi" <?= $userdetails->country == 'Burundi' ? ' selected="selected"' : ''; ?>>Burundi</option>
                                <option value="Cambodia" <?= $userdetails->country == 'Cambodia' ? ' selected="selected"' : ''; ?>>Cambodia</option>
                                <option value="Cameroon" <?= $userdetails->country == 'Cameroon' ? ' selected="selected"' : ''; ?>>Cameroon</option>
                                <option value="Canada" <?= $userdetails->country == 'Canada' ? ' selected="selected"' : ''; ?>>Canada</option>
                                <option value="Canary Islands" <?= $userdetails->country == 'Canary Islands' ? ' selected="selected"' : ''; ?>>Canary Islands</option>
                                <option value="Cape Verde" <?= $userdetails->country == 'Cape Verde' ? ' selected="selected"' : ''; ?>>Cape Verde</option>
                                <option value="Cayman Islands" <?= $userdetails->country == 'Cayman Islands' ? ' selected="selected"' : ''; ?>>Cayman Islands</option>
                                <option value="Central African Republic" <?= $userdetails->country == 'Central African Republic' ? ' selected="selected"' : ''; ?>>Central African Republic</option>
                                <option value="Chad" <?= $userdetails->country == 'Chad' ? ' selected="selected"' : ''; ?>>Chad</option>
                                <option value="Channel Islands" <?= $userdetails->country == 'Channel Islands' ? ' selected="selected"' : ''; ?>>Channel Islands</option>
                                <option value="Chile" <?= $userdetails->country == 'Chile' ? ' selected="selected"' : ''; ?>>Chile</option>
                                <option value="China" <?= $userdetails->country == 'China' ? ' selected="selected"' : ''; ?>>China</option>
                                <option value="Christmas Island" <?= $userdetails->country == 'Christmas Island' ? ' selected="selected"' : ''; ?>>Christmas Island</option>
                                <option value="Cocos Island" <?= $userdetails->country == 'Cocos Island' ? ' selected="selected"' : ''; ?>>Cocos Island</option>
                                <option value="Colombia" <?= $userdetails->country == 'Colombia' ? ' selected="selected"' : ''; ?>>Colombia</option>
                                <option value="Comoros" <?= $userdetails->country == 'Comoros' ? ' selected="selected"' : ''; ?>>Comoros</option>
                                <option value="Congo" <?= $userdetails->country == 'Congo' ? ' selected="selected"' : ''; ?>>Congo</option>
                                <option value="Cook Islands" <?= $userdetails->country == 'Cook Islands' ? ' selected="selected"' : ''; ?>>Cook Islands</option>
                                <option value="Costa Rica" <?= $userdetails->country == 'Costa Rica' ? ' selected="selected"' : ''; ?>>Costa Rica</option>
                                <option value="Cote DIvoire" <?= $userdetails->country == 'Cote DIvoire' ? ' selected="selected"' : ''; ?>>Cote DIvoire</option>
                                <option value="Croatia" <?= $userdetails->country == 'Croatia' ? ' selected="selected"' : ''; ?>>Croatia</option>
                                <option value="Cuba" <?= $userdetails->country == 'Cuba' ? ' selected="selected"' : ''; ?>>Cuba</option>
                                <option value="Curaco" <?= $userdetails->country == 'Curaco' ? ' selected="selected"' : ''; ?>>Curacao</option>
                                <option value="Cyprus" <?= $userdetails->country == 'Cyprus' ? ' selected="selected"' : ''; ?>>Cyprus</option>
                                <option value="Czech Republic" <?= $userdetails->country == 'China' ? ' selected="selected"' : ''; ?>>Czech Republic</option>
                                <option value="Denmark" <?= $userdetails->country == 'Denmark' ? ' selected="selected"' : ''; ?>>Denmark</option>
                                <option value="Djibouti" <?= $userdetails->country == 'Djibouti' ? ' selected="selected"' : ''; ?>>Djibouti</option>
                                <option value="Dominica" <?= $userdetails->country == 'Dominica' ? ' selected="selected"' : ''; ?>>Dominica</option>
                                <option value="Dominican Republic" <?= $userdetails->country == 'Dominican Republic' ? ' selected="selected"' : ''; ?>>Dominican Republic</option>
                                <option value="East Timor" <?= $userdetails->country == 'East Timor' ? ' selected="selected"' : ''; ?>>East Timor</option>
                                <option value="Ecuador" <?= $userdetails->country == 'Ecuador' ? ' selected="selected"' : ''; ?>>Ecuador</option>
                                <option value="Egypt" <?= $userdetails->country == 'Egypt' ? ' selected="selected"' : ''; ?>>Egypt</option>
                                <option value="El Salvador" <?= $userdetails->country == 'El Salvador' ? ' selected="selected"' : ''; ?>>El Salvador</option>
                                <option value="Equatorial Guinea" <?= $userdetails->country == 'Equatorial Guinea' ? ' selected="selected"' : ''; ?>>Equatorial Guinea</option>
                                <option value="Eritrea" <?= $userdetails->country == 'Eritrea' ? ' selected="selected"' : ''; ?>>Eritrea</option>
                                <option value="Estonia" <?= $userdetails->country == 'Estonia' ? ' selected="selected"' : ''; ?>>Estonia</option>
                                <option value="Ethiopia" <?= $userdetails->country == 'Ethiopia' ? ' selected="selected"' : ''; ?>>Ethiopia</option>
                                <option value="Falkland Islands" <?= $userdetails->country == 'Falkland Islands' ? ' selected="selected"' : ''; ?>>Falkland Islands</option>
                                <option value="Faroe Islands" <?= $userdetails->country == 'Faroe Islands' ? ' selected="selected"' : ''; ?>>Faroe Islands</option>
                                <option value="Fiji" <?= $userdetails->country == 'Fiji' ? ' selected="selected"' : ''; ?>>Fiji</option>
                                <option value="Finland" <?= $userdetails->country == 'Finland' ? ' selected="selected"' : ''; ?>>Finland</option>
                                <option value="France" <?= $userdetails->country == 'France' ? ' selected="selected"' : ''; ?>>France</option>
                                <option value="French Guiana" <?= $userdetails->country == 'French Guiana' ? ' selected="selected"' : ''; ?>>French Guiana</option>
                                <option value="French Polynesia" <?= $userdetails->country == 'French Polynesia' ? ' selected="selected"' : ''; ?>>French Polynesia</option>
                                <option value="French Southern Ter" <?= $userdetails->country == 'French Southern Ter' ? ' selected="selected"' : ''; ?>>French Southern Ter</option>
                                <option value="Gabon" <?= $userdetails->country == 'Gabon' ? ' selected="selected"' : ''; ?>>Gabon</option>
                                <option value="Gambia" <?= $userdetails->country == 'Gambia' ? ' selected="selected"' : ''; ?>>Gambia</option>
                                <option value="Georgia" <?= $userdetails->country == 'Georgia' ? ' selected="selected"' : ''; ?>>Georgia</option>
                                <option value="Germany" <?= $userdetails->country == 'Germany' ? ' selected="selected"' : ''; ?>>Germany</option>
                                <option value="Ghana" <?= $userdetails->country == 'Ghana' ? ' selected="selected"' : ''; ?>>Ghana</option>
                                <option value="Gibraltar" <?= $userdetails->country == 'Gibraltar' ? ' selected="selected"' : ''; ?>>Gibraltar</option>
                                <option value="Great Britain" <?= $userdetails->country == 'Great Britain' ? ' selected="selected"' : ''; ?>>Great Britain</option>
                                <option value="Greece" <?= $userdetails->country == 'Greece' ? ' selected="selected"' : ''; ?>>Greece</option>
                                <option value="Greenland" <?= $userdetails->country == 'Greenland' ? ' selected="selected"' : ''; ?>>Greenland</option>
                                <option value="Grenada" <?= $userdetails->country == 'Grenada' ? ' selected="selected"' : ''; ?>>Grenada</option>
                                <option value="Guadeloupe" <?= $userdetails->country == 'Guadeloupe' ? ' selected="selected"' : ''; ?>>Guadeloupe</option>
                                <option value="Guam" <?= $userdetails->country == 'Guam' ? ' selected="selected"' : ''; ?>>Guam</option>
                                <option value="Guatemala" <?= $userdetails->country == 'Guatemala' ? ' selected="selected"' : ''; ?>>Guatemala</option>
                                <option value="Guinea" <?= $userdetails->country == 'Guinea' ? ' selected="selected"' : ''; ?>>Guinea</option>
                                <option value="Guyana" <?= $userdetails->country == 'Guyana' ? ' selected="selected"' : ''; ?>>Guyana</option>
                                <option value="Haiti" <?= $userdetails->country == 'Haiti' ? ' selected="selected"' : ''; ?>>Haiti</option>
                                <option value="Hawaii" <?= $userdetails->country == 'Hawaii' ? ' selected="selected"' : ''; ?>>Hawaii</option>
                                <option value="Honduras" <?= $userdetails->country == 'Honduras' ? ' selected="selected"' : ''; ?>>Honduras</option>
                                <option value="Hong Kong" <?= $userdetails->country == 'Hong Kong' ? ' selected="selected"' : ''; ?>>Hong Kong</option>
                                <option value="Hungary" <?= $userdetails->country == 'Hungary' ? ' selected="selected"' : ''; ?>>Hungary</option>
                                <option value="Iceland" <?= $userdetails->country == 'Iceland' ? ' selected="selected"' : ''; ?>>Iceland</option>
                                <option value="Indonesia" <?= $userdetails->country == 'Indonesia' ? ' selected="selected"' : ''; ?>>Indonesia</option>
                                <option value="India" <?= $userdetails->country == 'India' ? ' selected="selected"' : ''; ?>>India</option>
                                <option value="Iran" <?= $userdetails->country == 'Iran' ? ' selected="selected"' : ''; ?>>Iran</option>
                                <option value="Iraq" <?= $userdetails->country == 'Iraq' ? ' selected="selected"' : ''; ?>>Iraq</option>
                                <option value="Ireland" <?= $userdetails->country == 'Ireland' ? ' selected="selected"' : ''; ?>>Ireland</option>
                                <option value="Isle of Man" <?= $userdetails->country == 'Isle of Man' ? ' selected="selected"' : ''; ?>>Isle of Man</option>
                                <option value="Italy" <?= $userdetails->country == 'Italy' ? ' selected="selected"' : ''; ?>>Italy</option>
                                <option value="Jamaica" <?= $userdetails->country == 'Jamaica' ? ' selected="selected"' : ''; ?>>Jamaica</option>
                                <option value="Japan" <?= $userdetails->country == 'Japan' ? ' selected="selected"' : ''; ?>>Japan</option>
                                <option value="Jordan" <?= $userdetails->country == 'Jordan' ? ' selected="selected"' : ''; ?>>Jordan</option>
                                <option value="Kazakhstan" <?= $userdetails->country == 'Kazakhstan' ? ' selected="selected"' : ''; ?>>Kazakhstan</option>
                                <option value="Kenya" <?= $userdetails->country == 'Kenya' ? ' selected="selected"' : ''; ?>>Kenya</option>
                                <option value="Kiribati" <?= $userdetails->country == 'Kiribati' ? ' selected="selected"' : ''; ?>>Kiribati</option>
                                <option value="Korea North" <?= $userdetails->country == 'Korea North' ? ' selected="selected"' : ''; ?>>Korea North</option>
                                <option value="Korea South" <?= $userdetails->country == 'Korea South' ? ' selected="selected"' : ''; ?>>Korea South</option>
                                <option value="Kyrgyzstan" <?= $userdetails->country == 'Kyrgyzstan' ? ' selected="selected"' : ''; ?>>Kyrgyzstan</option>
                                <option value="Laos" <?= $userdetails->country == 'Laos' ? ' selected="selected"' : ''; ?>>Laos</option>
                                <option value="Latvia" <?= $userdetails->country == 'Latvia' ? ' selected="selected"' : ''; ?>>Latvia</option>
                                <option value="Lebanon" <?= $userdetails->country == 'Lebanon' ? ' selected="selected"' : ''; ?>>Lebanon</option>
                                <option value="Lesotho" <?= $userdetails->country == 'Lesotho' ? ' selected="selected"' : ''; ?>>Lesotho</option>
                                <option value="Liberia" <?= $userdetails->country == 'Liberia' ? ' selected="selected"' : ''; ?>>Liberia</option>
                                <option value="Libya" <?= $userdetails->country == 'Libya' ? ' selected="selected"' : ''; ?>>Libya</option>
                                <option value="Liechtenstein" <?= $userdetails->country == 'Liechtenstein' ? ' selected="selected"' : ''; ?>>Liechtenstein</option>
                                <option value="Lithuania" <?= $userdetails->country == 'Lithuania' ? ' selected="selected"' : ''; ?>>Lithuania</option>
                                <option value="Luxembourg" <?= $userdetails->country == 'Luxembourg' ? ' selected="selected"' : ''; ?>>Luxembourg</option>
                                <option value="Macau" <?= $userdetails->country == 'Macau' ? ' selected="selected"' : ''; ?>>Macau</option>
                                <option value="Macedonia" <?= $userdetails->country == 'Macedonia' ? ' selected="selected"' : ''; ?>>Macedonia</option>
                                <option value="Madagascar" <?= $userdetails->country == 'Madagascar' ? ' selected="selected"' : ''; ?>>Madagascar</option>
                                <option value="Malaysia" <?= $userdetails->country == 'Malaysia' ? ' selected="selected"' : ''; ?>>Malaysia</option>
                                <option value="Malawi" <?= $userdetails->country == 'Malawi' ? ' selected="selected"' : ''; ?>>Malawi</option>
                                <option value="Maldives" <?= $userdetails->country == 'Maldives' ? ' selected="selected"' : ''; ?>>Maldives</option>
                                <option value="Mali" <?= $userdetails->country == 'Mali' ? ' selected="selected"' : ''; ?>>Mali</option>
                                <option value="Malta" <?= $userdetails->country == 'Malta' ? ' selected="selected"' : ''; ?>>Malta</option>
                                <option value="Marshall Islands" <?= $userdetails->country == 'Marshall Islands' ? ' selected="selected"' : ''; ?>>Marshall Islands</option>
                                <option value="Martinique" <?= $userdetails->country == 'Martinique' ? ' selected="selected"' : ''; ?>>Martinique</option>
                                <option value="Mauritania" <?= $userdetails->country == 'Mauritania' ? ' selected="selected"' : ''; ?>>Mauritania</option>
                                <option value="Mauritius" <?= $userdetails->country == 'Mauritius' ? ' selected="selected"' : ''; ?>>Mauritius</option>
                                <option value="Mayotte" <?= $userdetails->country == 'Mayotte' ? ' selected="selected"' : ''; ?>>Mayotte</option>
                                <option value="Mexico" <?= $userdetails->country == 'Mexico' ? ' selected="selected"' : ''; ?>>Mexico</option>
                                <option value="Midway Islands" <?= $userdetails->country == 'Midway Islands' ? ' selected="selected"' : ''; ?>>Midway Islands</option>
                                <option value="Moldova" <?= $userdetails->country == 'Moldova' ? ' selected="selected"' : ''; ?>>Moldova</option>
                                <option value="Monaco" <?= $userdetails->country == 'Monaco' ? ' selected="selected"' : ''; ?>>Monaco</option>
                                <option value="Mongolia" <?= $userdetails->country == 'Mongolia' ? ' selected="selected"' : ''; ?>>Mongolia</option>
                                <option value="Montserrat" <?= $userdetails->country == 'Montserrat' ? ' selected="selected"' : ''; ?>>Montserrat</option>
                                <option value="Morocco" <?= $userdetails->country == 'Morocco' ? ' selected="selected"' : ''; ?>>Morocco</option>
                                <option value="Mozambique" <?= $userdetails->country == 'Mozambique' ? ' selected="selected"' : ''; ?>>Mozambique</option>
                                <option value="Myanmar" <?= $userdetails->country == 'Myanmar' ? ' selected="selected"' : ''; ?>>Myanmar</option>
                                <option value="Nambia" <?= $userdetails->country == 'Nambia' ? ' selected="selected"' : ''; ?>>Nambia</option>
                                <option value="Nauru" <?= $userdetails->country == 'Nauru' ? ' selected="selected"' : ''; ?>>Nauru</option>
                                <option value="Nepal" <?= $userdetails->country == 'Nepal' ? ' selected="selected"' : ''; ?>>Nepal</option>
                                <option value="Netherland Antilles" <?= $userdetails->country == 'Netherland Antilles' ? ' selected="selected"' : ''; ?>>Netherland Antilles</option>
                                <option value="Netherlands" <?= $userdetails->country == 'Netherlands' ? ' selected="selected"' : ''; ?>>Netherlands (Holland, Europe)</option>
                                <option value="Nevis" <?= $userdetails->country == 'Nevis' ? ' selected="selected"' : ''; ?>>Nevis</option>
                                <option value="New Caledonia" <?= $userdetails->country == 'New Caledonia' ? ' selected="selected"' : ''; ?>>New Caledonia</option>
                                <option value="New Zealand" <?= $userdetails->country == 'New Zealand' ? ' selected="selected"' : ''; ?>>New Zealand</option>
                                <option value="Nicaragua" <?= $userdetails->country == 'Nicaragua' ? ' selected="selected"' : ''; ?>>Nicaragua</option>
                                <option value="Niger" <?= $userdetails->country == 'Niger' ? ' selected="selected"' : ''; ?>>Niger</option>
                                <option value="Nigeria" <?= $userdetails->country == 'Nigeria' ? ' selected="selected"' : ''; ?>>Nigeria</option>
                                <option value="Niue" <?= $userdetails->country == 'Niue' ? ' selected="selected"' : ''; ?>>Niue</option>
                                <option value="Norfolk Island" <?= $userdetails->country == 'Norfolk Island' ? ' selected="selected"' : ''; ?>>Norfolk Island</option>
                                <option value="Norway" <?= $userdetails->country == 'Norway' ? ' selected="selected"' : ''; ?>>Norway</option>
                                <option value="Oman" <?= $userdetails->country == 'Oman' ? ' selected="selected"' : ''; ?>>Oman</option>
                                <option value="Pakistan" <?= $userdetails->country == 'Pakistan' ? ' selected="selected"' : ''; ?>>Pakistan</option>
                                <option value="Palau Island" <?= $userdetails->country == 'Palau Island' ? ' selected="selected"' : ''; ?>>Palau Island</option>
                                <option value="Palestine" <?= $userdetails->country == 'Palestine' ? ' selected="selected"' : ''; ?>>Palestine</option>
                                <option value="Panama" <?= $userdetails->country == 'Panama' ? ' selected="selected"' : ''; ?>>Panama</option>
                                <option value="Papua New Guinea" <?= $userdetails->country == 'Papua New Guinea' ? ' selected="selected"' : ''; ?>>Papua New Guinea</option>
                                <option value="Paraguay" <?= $userdetails->country == 'Paraguay' ? ' selected="selected"' : ''; ?>>Paraguay</option>
                                <option value="Peru" <?= $userdetails->country == 'Peru' ? ' selected="selected"' : ''; ?>>Peru</option>
                                <option value="Phillipines" <?= $userdetails->country == 'Phillipines' ? ' selected="selected"' : ''; ?>>Philippines</option>
                                <option value="Pitcairn Island" <?= $userdetails->country == 'Pitcairn Island' ? ' selected="selected"' : ''; ?>>Pitcairn Island</option>
                                <option value="Poland" <?= $userdetails->country == 'Poland' ? ' selected="selected"' : ''; ?>>Poland</option>
                                <option value="Portugal" <?= $userdetails->country == 'Portugal' ? ' selected="selected"' : ''; ?>>Portugal</option>
                                <option value="Puerto Rico" <?= $userdetails->country == 'Puerto Rico' ? ' selected="selected"' : ''; ?>>Puerto Rico</option>
                                <option value="Qatar" <?= $userdetails->country == 'Qatar' ? ' selected="selected"' : ''; ?>>Qatar</option>
                                <option value="Republic of Montenegro" <?= $userdetails->country == 'Republic of Montenegro' ? ' selected="selected"' : ''; ?>>Republic of Montenegro</option>
                                <option value="Republic of Serbia" <?= $userdetails->country == 'Republic of Serbia' ? ' selected="selected"' : ''; ?>>Republic of Serbia</option>
                                <option value="Reunion" <?= $userdetails->country == 'Reunion' ? ' selected="selected"' : ''; ?>>Reunion</option>
                                <option value="Romania" <?= $userdetails->country == 'Romania' ? ' selected="selected"' : ''; ?>>Romania</option>
                                <option value="Russia" <?= $userdetails->country == 'Russia' ? ' selected="selected"' : ''; ?>>Russia</option>
                                <option value="Rwanda" <?= $userdetails->country == 'Rwanda' ? ' selected="selected"' : ''; ?>>Rwanda</option>
                                <option value="St Barthelemy" <?= $userdetails->country == 'St Barthelemy' ? ' selected="selected"' : ''; ?>>St Barthelemy</option>
                                <option value="St Eustatius" <?= $userdetails->country == 'St Eustatius' ? ' selected="selected"' : ''; ?>>St Eustatius</option>
                                <option value="St Helena" <?= $userdetails->country == 'St Helena' ? ' selected="selected"' : ''; ?>>St Helena</option>
                                <option value="St Kitts-Nevis" <?= $userdetails->country == 'St Kitts-Nevis' ? ' selected="selected"' : ''; ?>>St Kitts-Nevis</option>
                                <option value="St Lucia" <?= $userdetails->country == 'St Lucia' ? ' selected="selected"' : ''; ?>>St Lucia</option>
                                <option value="St Maarten" <?= $userdetails->country == 'St Maarten' ? ' selected="selected"' : ''; ?>>St Maarten</option>
                                <option value="St Pierre & Miquelon" <?= $userdetails->country == 'St Pierre & Miquelon' ? ' selected="selected"' : ''; ?>>St Pierre & Miquelon</option>
                                <option value="St Vincent & Grenadines" <?= $userdetails->country == 'St Vincent & Grenadines' ? ' selected="selected"' : ''; ?>>St Vincent & Grenadines</option>
                                <option value="Saipan" <?= $userdetails->country == 'Saipan' ? ' selected="selected"' : ''; ?>>Saipan</option>
                                <option value="Samoa" <?= $userdetails->country == 'Samoa' ? ' selected="selected"' : ''; ?>>Samoa</option>
                                <option value="Samoa American" <?= $userdetails->country == 'Samoa American' ? ' selected="selected"' : ''; ?>>Samoa American</option>
                                <option value="San Marino" <?= $userdetails->country == 'San Marino' ? ' selected="selected"' : ''; ?>>San Marino</option>
                                <option value="Sao Tome & Principe" <?= $userdetails->country == 'Sao Tome & Principe' ? ' selected="selected"' : ''; ?>>Sao Tome & Principe</option>
                                <option value="Senegal" <?= $userdetails->country == 'Senegal' ? ' selected="selected"' : ''; ?>>Senegal</option>
                                <option value="Seychelles" <?= $userdetails->country == 'Seychelles' ? ' selected="selected"' : ''; ?>>Seychelles</option>
                                <option value="Sierra Leone" <?= $userdetails->country == 'Sierra Leone' ? ' selected="selected"' : ''; ?>>Sierra Leone</option>
                                <option value="Singapore" <?= $userdetails->country == 'Singapore' ? ' selected="selected"' : ''; ?>>Singapore</option>
                                <option value="Slovakia" <?= $userdetails->country == 'Slovakia' ? ' selected="selected"' : ''; ?>>Slovakia</option>
                                <option value="Slovenia" <?= $userdetails->country == 'Slovenia' ? ' selected="selected"' : ''; ?>>Slovenia</option>
                                <option value="Solomon Islands" <?= $userdetails->country == 'Solomon Islands' ? ' selected="selected"' : ''; ?>>Solomon Islands</option>
                                <option value="Somalia" <?= $userdetails->country == 'Somalia' ? ' selected="selected"' : ''; ?>>Somalia</option>
                                <option value="South Africa" <?= $userdetails->country == 'South Africa' ? ' selected="selected"' : ''; ?>>South Africa</option>
                                <option value="Spain" <?= $userdetails->country == 'Spain' ? ' selected="selected"' : ''; ?>>Spain</option>
                                <option value="Sri Lanka" <?= $userdetails->country == 'Sri Lanka' ? ' selected="selected"' : ''; ?>>Sri Lanka</option>
                                <option value="Sudan" <?= $userdetails->country == 'Sudan' ? ' selected="selected"' : ''; ?>>Sudan</option>
                                <option value="Suriname" <?= $userdetails->country == 'Suriname' ? ' selected="selected"' : ''; ?>>Suriname</option>
                                <option value="Swaziland" <?= $userdetails->country == 'Swaziland' ? ' selected="selected"' : ''; ?>>Swaziland</option>
                                <option value="Sweden" <?= $userdetails->country == 'Sweden' ? ' selected="selected"' : ''; ?>>Sweden</option>
                                <option value="Switzerland" <?= $userdetails->country == 'Switzerland' ? ' selected="selected"' : ''; ?>>Switzerland</option>
                                <option value="Syria" <?= $userdetails->country == 'Syria' ? ' selected="selected"' : ''; ?>>Syria</option>
                                <option value="Tahiti" <?= $userdetails->country == 'Tahiti' ? ' selected="selected"' : ''; ?>>Tahiti</option>
                                <option value="Taiwan" <?= $userdetails->country == 'Taiwan' ? ' selected="selected"' : ''; ?>>Taiwan</option>
                                <option value="Tajikistan" <?= $userdetails->country == 'Tajikistan' ? ' selected="selected"' : ''; ?>>Tajikistan</option>
                                <option value="Tanzania" <?= $userdetails->country == 'Tanzania' ? ' selected="selected"' : ''; ?>>Tanzania</option>
                                <option value="Thailand" <?= $userdetails->country == 'Thailand' ? ' selected="selected"' : ''; ?>>Thailand</option>
                                <option value="Togo" <?= $userdetails->country == 'Togo' ? ' selected="selected"' : ''; ?>>Togo</option>
                                <option value="Tokelau" <?= $userdetails->country == 'Tokelau' ? ' selected="selected"' : ''; ?>>Tokelau</option>
                                <option value="Tonga" <?= $userdetails->country == 'Tonga' ? ' selected="selected"' : ''; ?>>Tonga</option>
                                <option value="Trinidad & Tobago" <?= $userdetails->country == 'Trinidad & Tobago' ? ' selected="selected"' : ''; ?>>Trinidad & Tobago</option>
                                <option value="Tunisia" <?= $userdetails->country == 'Tunisia' ? ' selected="selected"' : ''; ?>>Tunisia</option>
                                <option value="Turkey" <?= $userdetails->country == 'Turkey' ? ' selected="selected"' : ''; ?>>Turkey</option>
                                <option value="Turkmenistan" <?= $userdetails->country == 'Turkmenistan' ? ' selected="selected"' : ''; ?>>Turkmenistan</option>
                                <option value="Turks & Caicos Is" <?= $userdetails->country == 'Turks & Caicos Is' ? ' selected="selected"' : ''; ?>>Turks & Caicos Is</option>
                                <option value="Tuvalu" <?= $userdetails->country == 'Tuvalu' ? ' selected="selected"' : ''; ?>>Tuvalu</option>
                                <option value="Uganda" <?= $userdetails->country == 'Uganda' ? ' selected="selected"' : ''; ?>>Uganda</option>
                                <option value="United Kingdom" <?= $userdetails->country == 'United Kingdom' ? ' selected="selected"' : ''; ?>>United Kingdom</option>
                                <option value="Ukraine" <?= $userdetails->country == 'Ukraine' ? ' selected="selected"' : ''; ?>>Ukraine</option>
                                <option value="United Arab Erimates" <?= $userdetails->country == 'United Arab Erimates' ? ' selected="selected"' : ''; ?>>United Arab Emirates</option>
                                <option value="United States of America" <?= $userdetails->country == 'United States of America' ? ' selected="selected"' : ''; ?>>United States of America</option>
                                <option value="Uraguay" <?= $userdetails->country == 'Uraguay' ? ' selected="selected"' : ''; ?>>Uruguay</option>
                                <option value="Uzbekistan" <?= $userdetails->country == 'Uzbekistan' ? ' selected="selected"' : ''; ?>>Uzbekistan</option>
                                <option value="Vanuatu" <?= $userdetails->country == 'Vanuatu' ? ' selected="selected"' : ''; ?>>Vanuatu</option>
                                <option value="Vatican City State" <?= $userdetails->country == 'Vatican City State' ? ' selected="selected"' : ''; ?>>Vatican City State</option>
                                <option value="Venezuela" <?= $userdetails->country == 'Venezuela' ? ' selected="selected"' : ''; ?>>Venezuela</option>
                                <option value="Vietnam" <?= $userdetails->country == 'Vietnam' ? ' selected="selected"' : ''; ?>>Vietnam</option>
                                <option value="Virgin Islands (Brit)" <?= $userdetails->country == 'ChinVirgin' ? ' selected="selected"' : ''; ?>>Virgin Islands (Brit)</option>
                                <option value="Virgin Islands (USA)" <?= $userdetails->country == 'Virgin Islands (USA)' ? ' selected="selected"' : ''; ?>>Virgin Islands (USA)</option>
                                <option value="Wake Island" <?= $userdetails->country == 'Wake Island' ? ' selected="selected"' : ''; ?>>Wake Island</option>
                                <option value="Wallis & Futana Is" <?= $userdetails->country == 'Wallis & Futana Is' ? ' selected="selected"' : ''; ?>>Wallis & Futana Is</option>
                                <option value="Yemen" <?= $userdetails->country == 'Yemen' ? ' selected="selected"' : ''; ?>>Yemen</option>
                                <option value="Zaire" <?= $userdetails->country == 'Zaire' ? ' selected="selected"' : ''; ?>>Zaire</option>
                                <option value="Zambia" <?= $userdetails->country == 'Zambia' ? ' selected="selected"' : ''; ?>>Zambia</option>
                                <option value="Zimbabwe" <?= $userdetails->country == 'Zimbabwe' ? ' selected="selected"' : ''; ?>>Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile Number</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input id="middle-name" name="phone" class="form-control col-md-7 col-xs-12" type="text" value="{{$userdetails->phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                            <select class="form-control" name="gender">
                                <option> </option>
                                <option value="Male" <?= $userdetails->gender == 'Male' ? ' selected="selected"' : ''; ?>>Male</option>
                                <option value="Female" <?= $userdetails->gender == 'Female' ? ' selected="selected"' : ''; ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Sign Up</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div>
                                <h5>{{date('Y-m-d h:i A', strtotime($userdetails->created_at))}}</h5>
                            </div>
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
                            <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" placeholder="New Password">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat New Passwords</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input id="cpassword" class="form-control col-md-7 col-xs-12" type="password" name="cpassword" placeholder="Repeat New Passwords">
                        </div><span id='message'></span>
                    </div>
                    <hr>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <button id="submit-data" type="submit" disabled="" class="btn btn-success">Save</button>
                    <span id="changebutton">
                                @if($userdetails->block_status=='0')
                                <button id="blockbutton" type="button" onclick="blockuser('1');" class="btn btn-danger">Block</button>
                                @else
                                <button id="blockbutton" type="button" onclick="blockuser('0');" class="btn btn-info">UnBlock</button>
                                @endif
</span>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    var button = $('#submit-data');
    $('form :input').not(button).bind('keyup change', function() {
        // get all that inputs that has changed
        var changed = $('form :input').not(button).filter(function() {
            if (this.type == 'radio' || this.type == 'checkbox') {
                return this.checked != $(this).data('default');
            } else {
                return this.value != $(this).data('default');
            }
        });
        // disable if none have changed - else enable if at least one has changed
        $('#submit-data').prop('disabled', !changed.length);
        $('#blockbutton').prop('disabled', true);
    });
    $('#password, #cpassword').on('keyup', function() {
        if ($('#password').val() == $('#cpassword').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    function blockuser($status) {
        $userid = $('#userid').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert(check);
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('blockuser') }}",
            data: {
                status: $status,
                userid: $userid
            },
            beforeSend: function() {
                // Show image container
                // $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);
                if($status==1)
                {$('#changebutton').html('<button id="blockbutton" type="button" onclick="blockuser('+0+');" class="btn btn-info">UnBlock</button>');
                }else{
                    $('#changebutton').html(' <button id="blockbutton" type="button" onclick="blockuser('+1+');" class="btn btn-danger">Block</button>');  
                }
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