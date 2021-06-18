@extends('superadmin.layouts.sa_layout')
@section('title', 'Contact-Us')
@section('content')
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
                $(wrapper).append('<div><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" name="uploadphoto[]" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />User Name <input name="contacts[][uname]" style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="text" placeholder="Moho" required="required" class="form-control"><br>whatsapp <input name="contacts[][watsapp]" style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="ltr" type="number" placeholder="+96597912345" class="form-control"><br><a href="#" class="delete">Delete</a><div class="ln_solid"></div></div>'); //add input box
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
                    <h1>Contact-Us</h1>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- Photo of Chalet -->
                    @if($contactdata->isEmpty())
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('addcontacts') }}" enctype="multipart/form-data" id="myform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tbody>
                                <tr id="block1">
                                    <td align="right" width="100%" valign="top">
                                        <table border="0" width="100%">
                                            <tr>
                                                <td align="center" width="50%">
                                                    <h3 style="margin: 5px">
                                                        <div class="fa fa-arrows"></div>
                                                    </h3>
                                                </td>
                                                <td align="right" width="50%"><a onclick="delete_block('<?php echo 'block1'; ?>');" style="margin: 0px; width: 60px" class="btn btn-primary bg-red">Delete</a></td>
                                            </tr>

                                            <tr>

                                                <td align="center" width="100%" colspan="2" dir="rtl"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" id="upload_photo1" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" name="upload_photo[]" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>

                                            </tr>
                                            <tr>

                                                <td align="right" width="100%" colspan="2" dir="rtl">User Name <input style="padding: 5px; margin: 0px 10px 10px 0px;" name="contact[1][username]" id="username1" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="text" placeholder="Moho" required="required" class="form-control"></td>

                                            </tr>
                                            <tr>

                                                <td align="right" width="100%" colspan="2" dir="rtl">whatsapp <input style="padding: 5px; margin: 0px 10px 10px 0px;" id="watsapp_num1" name="contact[1][watsapp_num]" class="col-md-12 col-sm-12 col-xs-12" dir="ltr" type="number" placeholder="+96597912345" class="form-control"></td>

                                            </tr>
                                        </table>
                                    </td>
                                    <td width="0" valign="top"><img border="0" src="{{url('images/img.jpg')}}" width="60"></td>
                                </tr>
                                <tr id="block2">
                                    <td align="right" width="100%" valign="top">

                                        <table border="0" width="100%">
                                            <tr>
                                                <td align="center" width="50%">
                                                    <h3 style="margin: 5px">
                                                        <div class="fa fa-arrows"></div>
                                                    </h3>
                                                </td>

                                                <td align="right" width="50%"><a onclick="delete_block('<?php echo 'block2'; ?>');" style="margin: 0px; width: 60px" class="btn btn-primary bg-red">Delete</a></td>

                                            </tr>

                                            <tr>

                                                <td align="center" width="100%" colspan="2" dir="rtl"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" id="upload_photo2" name="upload_photo[]" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>
                                            </tr>
                                            <tr>
                                                <td align="right" width="100%" colspan="2" dir="rtl">User Name <input style="padding: 5px; margin: 0px 10px 10px 0px;" name="contact[2][username]" id="username2" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="text" placeholder="Moho" required="required" class="form-control"></td>

                                            </tr>
                                            <tr>
                                                <td align="right" width="100%" colspan="2" dir="rtl">whatsapp <input style="padding: 5px; margin: 0px 10px 10px 0px;" id="watsapp_num2" name="contact[2][watsapp_num]" class="col-md-12 col-sm-12 col-xs-12" dir="ltr" type="number" placeholder="+96597912345" class="form-control"></td>

                                            </tr>



                                        </table>

                                    </td>

                                    <td width="0" valign="top"><img border="0" src="{{url('images/img.jpg')}}" width="60"></td>

                                </tr>
                                <!-- all -->
                            </tbody>
                        </table>
                        <div class="container_Photo" dir="rtl">
                            <a href="#" class="btn btn-primary add_form_field_Photo" style="margin-bottom: 5px" dir="ltr"> + Add New User </a>
                        </div>
                        <div class="ln_solid">
                            <br>
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                                <button id="send" type="submit" class="btn btn-success" style="padding: 10px 120px 10px 120px">Save</button>

                            </div>
                            <!-- Photo of Chalet -->
                        </div>
                    </form>
                    @else
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('updatecontacts') }}" enctype="multipart/form-data" id="myform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="imagechange_id" id="imagechange_id">
                        <input type="hidden" name="delete_id" id="delete_id">
                        @foreach($contactdata as $contact)
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tbody>
                                <tr id="block<?php echo $loop->iteration; ?>">
                                    <td align="right" width="100%" valign="top">
                                        <table border="0" width="100%">
                                            <tr>

                                                <td align="center" width="50%">
                                                    <h3 style="margin: 5px">
                                                        <div class="fa fa-arrows"></div>
                                                    </h3>
                                                </td>
                                                <td align="right" width="50%"><a style="margin: 0px; width: 60px" onclick="delete_function('<?php echo $contact->id; ?>','block<?php echo $loop->iteration; ?>');" class="btn btn-primary bg-red">Delete</a></td>

                                            </tr>
                                            <input type="hidden" name="contact[<?php echo $loop->iteration; ?>][updated_id]" id="updated_id" value="{{$contact->id}}">
                                            <tr>

                                                <td align="center" width="100%" colspan="2" dir="rtl"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" name="upload_image[]" onchange="mychangefunction('<?php echo $contact->id; ?>');" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>

                                            </tr>
                                            <tr>

                                                <td align="right" width="100%" colspan="2" dir="rtl">User Name <input style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="text" name="contact[<?php echo $loop->iteration; ?>][username]" value="{{$contact->name}}" placeholder="Moho" required="required" class="form-control"></td>

                                            </tr>
                                            <tr>

                                                <td align="right" width="100%" colspan="2" dir="rtl">whatsapp <input style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="ltr" type="number" name="contact[<?php echo $loop->iteration; ?>][watsapp_num]" value="{{$contact->phone}}" placeholder="+96597912345" class="form-control"></td>

                                            </tr>
                                        </table>
                                    </td>
                                    <td width="0" valign="top">
                                        @if(!empty($contact->profile_pic))
                                        <?php $image = $contact->profile_pic; ?>
                                        <img border="0" src="{{url('uploads/contacts/')}}/<?php echo $image; ?>" width="60">
                                        @else
                                        <img border="0" src="{{url('images/img.jpg')}}" width="60">
                                        @endif
                                    </td>
                                    <!-- all -->
                            </tbody>
                        </table>
                        @endforeach
                        <div class="container_Photo" dir="rtl">
                            <a href="#" class="btn btn-primary add_form_field_Photo" style="margin-bottom: 5px" dir="ltr"> + Add New User </a>
                        </div>
                        <div class="ln_solid">
                            <br>
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                                <button id="send" type="submit" class="btn btn-success" style="padding: 10px 120px 10px 120px">Save</button>

                            </div>
                            <!-- Photo of Chalet -->
                        </div>
                    </form>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function mychangefunction($cid) {
        // alert($cid);
        $val = $("#imagechange_id").val();
        var nn = $cid;
        if ($val == "") {
            // alert("empty");
            $('#imagechange_id').val($('#imagechange_id').val() + nn);
        } else {
            // alert("not empty");
            $('#imagechange_id').val($('#imagechange_id').val() + ',' + nn);
        }
    }

    function delete_function($id, $tagid) {
        // alert($tagid);
        $val = $("#delete_id").val();
        // alert($val);
        $tid = "#" + $tagid;
        $($tid).remove();
        var nn = $id;
        if ($val == "") {
            // alert("empty");
            $('#delete_id').val($('#delete_id').val() + nn);
        } else {
            // alert("not empty");
            $('#delete_id').val($('#delete_id').val() + ',' + nn);
        }
    }

    function delete_block($tagid) {
        // alert($tagid);
        $tid = "#" + $tagid;
        $($tid).remove();

    }
</script>
@endsection