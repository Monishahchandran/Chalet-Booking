@extends('superadmin.layouts.sa_layout')
@section('title', "Edit Chalet")
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<style>
    .container1 input[type=text] {
        padding: 5px 0px;
        margin: 5px 5px 5px 0px;
    }

    .add_form_fieldx {
        background-color: #1c97f3;
        border: none;
        color: white;
        padding: 8px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border: 1px solid #186dad;
    }

    .add_form_field_Photox {
        background-color: #1c97f3;
        border: none;
        color: white;
        padding: 8px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border: 1px solid #186dad;
    }

    input {
        border: 1px solid #cccccc;
        width: 95%;
        margin: 5px;
        padding: 5px;
    }

    .delete {
        background-color: #E74C3C;
        border: none;
        color: white;
        padding: 2px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
    }
</style>
<script src="{{url('js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function() {
        var max_fields = 50;
        var wrapper = $(".container_Photo");
        var add_button = $(".add_form_field_Photo");
        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div><input type="file" name="myImage" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /><a href="#" class="delete">Delete</a><div class="ln_solid"></div>');
            } else {
                alert('You Reached the limits')
            }
        });
        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    $(document).ready(function() {
        var max_fields = 50;
        var wrapper = $(".container1");
        var add_button = $(".add_form_field");
        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div><input style="padding: 5px" class="form-control" type="text" name="chalet_detail[]"><a href="#" class="delete">Delete</a><div class="ln_solid"></div>'); //add input box
            } else {
                alert('You Reached the limits')
            }
        });
        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    //add more video
    $(document).ready(function() {
        var max_fields = 50;
        var wrapper = $(".container2");
        var add_button = $(".add_video_field");
        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div><a href="#" style="margin-left: 486px;" class="delete">Delete</a><div  style="margin-left: 263px;display:flex;flex-flow: row wrap;"><input type="file" dir="rtl"  style="width: 297px;height: 34px;" id="insert_video" name="upload_video[]"  accept="video/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /><div id="videopreview"><img border="0" src="{{url("images/Chalet.jpg")}}" width="100"></div></div>'); //add video field
            } else {
                alert('You Reached the limits')
            }
        });
        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    //add more photo
    $(document).ready(function() {
        var max_fields = 50;
        var wrapper = $(".container3");
        var add_button = $(".add_photo_field");
        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div><a href="#" style="margin-left: 486px;" class="delete">Delete</a><div  style="margin-left: 263px;display:flex;flex-flow: row wrap;"><input type="file" dir="rtl"  style="width: 297px;height: 34px;padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" id="insertphoto" accept="image/*" data-role="magic-overlay" name="upload_photo[]" data-target="#pictureBtn" data-edit="insertImage"  /><div id="photopreview"><img border="0" src="{{url("images/Chalet.jpg")}}" width="100"></div></div>'); //add photo field
            } else {
                alert('You Reached the limits')
            }
        });
        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Edit Chalet</h1>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('editchalet') }}" enctype="multipart/form-data" id="myform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="chaletid" value="{{$chaletdata->id}}">
                        <input type="hidden" name="ownerid" value="{{$chaletdata->ownerid}}">
                        <input type="hidden" name="page" value="{{$page}}">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Chalet Name</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input type="text" required="required" dir="rtl" value="{{$chaletdata->chalet_name}}" name="chalet_name" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Location ( URL )</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input type="text" required="required" name="location" value="{{$chaletdata->location}}" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Commission %</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input type="number" required="required" placeholder="10" name="commission" value="{{$chaletdata->commision}}" class="form-control">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <h3>Rental Price</h3>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Weekdays</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input type="number" required="required" value="{{$chaletdata->weekday_rent}}" name="weekday_rent" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Weekend</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input type="number" required="required" value="{{$chaletdata->weekend_rent}}" name="weekend_rent" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Week (A) / Week (B)</label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <input type="number" required="required" value="{{$chaletdata->week_rent}}" name="week_rent" class="form-control">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <h3>Video ( optional )</h3>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <table id="videotable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    @if($chaletuploads_video->isEmpty())
                                    <tbody>
                                        <tr>
                                            <td align="right" width="100%" valign="top">
                                                <table border="0" width="100%">
                                                    <tr>
                                                        <td align="center" width="50%">
                                                            <h3 style="margin: 5px">
                                                                <div class="fa fa-arrows"></div>
                                                            </h3>
                                                        </td>
                                                        <td align="right" width="50%"><a style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" onclick="mydeletefunction();">Delete</a> </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" id="insertvideo" name="upload_video[]" accept="video/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td width="0" valign="top">
                                                <div id="video_preview">
                                                    <img border="0" src="{{url('images/Chalet.jpg')}}" width="100">
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- all -->
                                    </tbody>
                                    @endif
                                    @if(!empty($chaletuploads_video))
                                    <input type="hidden" id="videochaletupload_id" name="videochaletupload_id"/>
                                    <input type="hidden" value="" id="updated_cvid" name="updated_cvid" />
                                    @foreach($chaletuploads_video as $cvdetails)
                                    <tbody id="videotbody<?php echo $loop->iteration; ?>">
                                        <tr>
                                            <td align="right" width="100%" valign="top">
                                                <table border="0" width="100%">
                                                    <tr>
                                                        <td align="center" width="50%">
                                                            <h3 style="margin: 5px">
                                                                <div class="fa fa-arrows"></div>
                                                            </h3>
                                                        </td>
                                                        <td align="right" width="50%"><a style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" onclick="deletevideo_function('<?php echo $cvdetails->id; ?>','videotbody<?php echo $loop->iteration; ?>');" class="delete">Delete</a> </td>
                                                    </tr>
                                                    <tr>

                                                        <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" id="insertvideo" name="uploadvideo[]" onchange="mychangefunction('<?php echo $cvdetails->id; ?>');" accept="video/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td width="0" valign="top">
                                                <div id="video_preview">
                                                    <video src="{{url('uploads/chalet_uploads/chalet_images/')}}/{{$cvdetails->file_name}}" controls height="100" ;></video>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- all -->
                                    </tbody>
                                    @endforeach
                                    @endif
                                </table>

                            </div>
                        </div>
                        <div class="container2">
                            <a href="#" class="btn btn-primary add_video_field" style="margin-bottom: 5px;margin-left: 535px;"> + Add More Videos</a>
                        </div>
                        <div class="ln_solid"></div>
                        <h3>Photos</h3>
                        The first is the Default
                        <br>
                        <br>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <table id="phototable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    @if($chaletuploads_photo->isEmpty())
                                    <tbody>
                                        <tr>
                                            <td align="right" width="100%" valign="top">
                                                <table border="0" width="100%">
                                                    <tr>
                                                        <td align="center" width="50%">
                                                            <h3 style="margin: 5px">
                                                                <div class="fa fa-arrows"></div>
                                                            </h3>
                                                        </td>
                                                        <td align="right" width="50%"><a style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" id="deletebutton" onclick="myfunction();">Delete</a> </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" id="insertphoto" name="upload_photo[]" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="0" valign="top">
                                                <div id="image_preview">
                                                    <img border="0" src="{{url('images/Chalet.jpg')}}" width="100">
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- all -->
                                    </tbody>
                                    @endif
                                    @if(!empty($chaletuploads_photo))
                                    <input type="hidden" id="photochaletupload_id" name="photochaletupload_id"/>
                                    <input type="hidden" value="" id="updated_cpid" name="updated_cpid" />
                                    @foreach($chaletuploads_photo as $cpdetails)
                                    <tbody id="phototbody<?php echo $loop->iteration; ?>">
                                        <tr>
                                            <td align="right" width="100%" valign="top">
                                                <table border="0" width="100%">
                                                    <tr>
                                                        <td align="center" width="50%">
                                                            <h3 style="margin: 5px">
                                                                <div class="fa fa-arrows"></div>
                                                            </h3>
                                                        </td>
                                                        <td align="right" width="50%"><a style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" id="deletebutton" onclick="deletephoto_function('<?php echo $cpdetails->id; ?>','phototbody<?php echo $loop->iteration; ?>');" class="delete">Delete</a> </td>
                                                    </tr>
                                                    <tr>


                                                        <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" id="insertphoto" name="uploadphoto[]" onchange="myphotochangefunction('<?php echo $cpdetails->id; ?>');" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="0" valign="top">
                                                <div id="image_preview">
                                                    <img border="0" src="{{url('uploads/chalet_uploads/chalet_images/')}}/{{$cpdetails->file_name}}" width="100" height="100">
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- all -->
                                    </tbody>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="container3">
                            <a href="#" class="btn btn-primary add_photo_field" style="margin-bottom: 5px;margin-left: 535px;"> + Add More Photos</a>
                        </div>
                        <div class="ln_solid"></div>
                        <h3>Chalet Details</h3>
                        <!-- HTML Code -->
                        <div class="x_content">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Html Code</button>
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" style="background: #2B5468">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel" style="color:#ffffff;">Html Code</h4>
                                        </div>
                                        <div class="modal-body" style="background: #2B5468">
                                            <table style="background: #1E4355" id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <tr style="background: #1E4355">
                                                    <td width="30%" style="color:#ffffff;"><b>Bold</b></td>
                                                    <td width="70%">&lt;b&gt; Text here &lt;/b&gt;</td>
                                                </tr>
                                                <tr style="background: #1E4355">
                                                    <td width="30%">
                                                        <font style="color:#6FDA44;">Text color</font>
                                                    </td>
                                                    <td width="70%">&lt;font style="color:#6FDA44;"&gt; Text here &lt;/font&gt;</td>
                                                </tr>
                                                <tr style="background: #1E4355">
                                                    <td width="30%">
                                                        <font style="color:#6FDA44;"><b>Text color and Bold</b></font>
                                                    </td>
                                                    <td width="70%">&lt;font style="color:#6FDA44;"&gt;&lt;b&gt; Text here &lt;/b&gt;&lt;/font&gt;</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- HTML Code -->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div>
                                        <!-- Chalet Details -->
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            @if($chaletdetails->isEmpty())
                                            <tbody>
                                                <tr>
                                                    <td align="right" width="100%" valign="top">
                                                        <table border="0" width="100%">
                                                            <tr>
                                                                <td align="center" width="50%" style="padding-right: 80px">
                                                                    <h3 style="margin: 5px">
                                                                        <div class="fa fa-arrows"></div>
                                                                    </h3>
                                                                </td>
                                                                <td align="right" width="50%"><a href="#" style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red">Delete</a> </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input type="text" id="first-name" name="chalet_detail[]" class="form-control" dir="rtl"></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" width="50%" style="padding-right: 80px">
                                                                    <h3 style="margin: 5px">
                                                                        <div class="fa fa-arrows"></div>
                                                                    </h3>
                                                                </td>
                                                                <td align="right" width="50%"><a href="#" style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red">Delete</a> </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input type="text" id="first-name" name="chalet_detail[]" class="form-control" dir="rtl"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- all -->
                                            </tbody>
                                            @endif
                                            @if(!empty($chaletdetails))
                                            <input type="hidden" value="" id="updated_cdid" name="updated_cdid" />
                                            <input type="hidden" id="chaletdetail_id" name="chaletdetail_id"/>
                                            @foreach($chaletdetails as $cdetails)
                                            <tbody id="chaletdetailbody<?php echo $loop->iteration; ?>">
                                                <tr>
                                                    <td align="right" width="100%" valign="top">
                                                        <table border="0" width="100%">
                                                            <tr>
                                                                <td align="center" width="50%" style="padding-right: 80px">
                                                                    <h3 style="margin: 5px">
                                                                        <div class="fa fa-arrows"></div>
                                                                    </h3>
                                                                </td>
                                                                <td align="right" width="50%"><a style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" onclick="deletechaletdetail_function('<?php echo $cdetails->id; ?>','chaletdetailbody<?php echo $loop->iteration; ?>');">Delete</a> </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input type="text" id="first-name" name="chaletdetail[]" class="form-control" dir="rtl" value="{{$cdetails->chalet_detail}}" onchange="mycdchangefunction('<?php echo $cdetails->id; ?>');"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- all -->
                                            </tbody>
                                            @endforeach
                                            @endif
                                        </table>
                                        <!-- Chalet Details -->
                                        <div class="container1" dir="rtl">
                                            <a href="#" class="btn btn-primary add_form_field" style="margin-bottom: 5px"> + Add New Details </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="col-md-5 col-sm-12 col-xs-12 col-md-offset-4">
                            <button id="send" type="submit" class="btn btn-success" style="padding: 5px 40px 5px 40px">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>
</div>
<script>
    //  $("#insertphoto").change(function() {
    //         $('#image_preview').html("");
    //         var total_file = document.getElementById("insertphoto").files.length;
    //         for (var i = 0; i < total_file; i++) {
    //             $('#image_preview').append("<img   height=" + 100 + "; id='pfile' src=" + URL.createObjectURL(event.target.files[i]) + ">");
    //         }
    //     });

    function myfunction() {
        $("#insertphoto").val('');
        //  $('#image_preview').html("");
        //  $val="http://localhost/aby_chalet/images/Chalet.jpg";
        //  $('#image_preview').append("<img   height=" + 100 + ";  src=" + $val + ">");
        return false;
    }
    // $("#insertvideo").change(function() {
    //         $('#video_preview').html("");
    //         var total_file = document.getElementById("insertvideo").files.length;
    //         for (var i = 0; i < total_file; i++) {
    //             $('#video_preview').append("<video src="+ URL.createObjectURL(event.target.files[i]) +" controls height=" + 100 + ";></video>");
    //         }
    //     });
    function mydeletefunction() {
        $("#insertvideo").val('');
        //  $('#video_preview').html("");
        //  $val="http://localhost/aby_chalet/images/Chalet.jpg";
        //  $('#video_preview').append("<img   height=" + 100 + ";  src=" + $val + ">");
        return false;
    }
    // function changefunction(){
    //   // alert('hi');
    //   $('#videopreview').html("");
    //         var total_file = document.getElementById("insert_video").files.length;
    //         for (var i = 0; i < total_file; i++) {
    //             $('#videopreview').append("<video src="+ URL.createObjectURL(event.target.files[i]) +" controls height=" + 100 + ";></video>");
    //         }
    // }
    function deletevideo_function($id, $tagid) {
        // alert($tagid);
        $val = $("#videochaletupload_id").val();
        // alert($val);
        $tid = "#" + $tagid;
        $($tid).remove();
        var nn = $id;
        if ($val == "") {
            // alert("empty");
            $('#videochaletupload_id').val($('#videochaletupload_id').val() + nn);
        } else {
            // alert("not empty");
            $('#videochaletupload_id').val($('#videochaletupload_id').val() + ',' + nn);
        }
    }

    function deletephoto_function($id, $tagid) {
        // alert($tagid);
        $val = $("#photochaletupload_id").val();
        $tid = "#" + $tagid;
        $($tid).remove();
        var nn = $id;
        if ($val == "") {
            // alert("empty");
            $('#photochaletupload_id').val($('#photochaletupload_id').val() + nn);
        } else {
            // alert("not empty");
            $('#photochaletupload_id').val($('#photochaletupload_id').val() + ',' + nn);
        }
    }
    function deletechaletdetail_function($id, $tagid) {
        // alert($tagid);
        $val = $("#chaletdetail_id").val();
        // alert($val);
        $tid = "#" + $tagid;
        $($tid).remove();
        var nn = $id;
        if ($val == "") {
            // alert("empty");
            $('#chaletdetail_id').val($('#chaletdetail_id').val() + nn);
        } else {
            // alert("not empty");
            $('#chaletdetail_id').val($('#chaletdetail_id').val() + ',' + nn);
        }
    }
    function myphotochangefunction($cid) {
        $val = $("#updated_cpid").val();
        var nn = $cid;
        if ($val == "") {
            // alert("empty");
            $('#updated_cpid').val($('#updated_cpid').val() + nn);
        } else {
            // alert("not empty");
            $('#updated_cpid').val($('#updated_cpid').val() + ',' + nn);
        }
    }

    function mychangefunction($cid) {
        // alert($cid);
        $val = $("#updated_cvid").val();
        var nn = $cid;
        if ($val == "") {
            // alert("empty");
            $('#updated_cvid').val($('#updated_cvid').val() + nn);
        } else {
            // alert("not empty");
            $('#updated_cvid').val($('#updated_cvid').val() + ',' + nn);
        }
    }
    function mycdchangefunction($cdid) {
        // alert($cdid);
        $val = $("#updated_cdid").val();
        var nn = $cdid;
        if ($val == "") {
            // alert("empty");
            $('#updated_cdid').val($('#updated_cdid').val() + nn);
        } else {
            // alert("not empty");
            $('#updated_cdid').val($('#updated_cdid').val() + ',' + nn);
        }
    }
</script>
@endsection