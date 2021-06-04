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
                $(wrapper).append('<div><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" name="myImage" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />User Name <input style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="text" placeholder="Moho" required="required" class="form-control"><br>Phone <input  style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="ltr" type="number" placeholder="+96597912345" class="form-control"><br>whatsapp <input  style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="ltr" type="number" placeholder="+96597912345" class="form-control"><br><a href="#" class="delete">Delete</a><div class="ln_solid"></div></div>'); //add input box
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
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                                            <td align="right" width="50%"><a style="margin: 0px; width: 60px" href="Chalet-edit.php" class="btn btn-primary bg-red">Delete</a></td>

                                        </tr>

                                        <tr>

                                            <td align="center" width="100%" colspan="2" dir="rtl"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" name="myImage" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>

                                        </tr>
                                        <tr>

                                            <td align="right" width="100%" colspan="2" dir="rtl">User Name <input style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="text" placeholder="Moho" required="required" class="form-control"></td>

                                        </tr>
                                        <tr>

                                            <td align="right" width="100%" colspan="2" dir="rtl">whatsapp <input style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="ltr" type="number" placeholder="+96597912345" class="form-control"></td>

                                        </tr>
                                    </table>
                                </td>
                                <td width="0" valign="top"><img border="0" src="images/img.jpg" width="60"></td>
                            <tr>
                                <td align="right" width="100%" valign="top">

                                    <table border="0" width="100%">
                                        <tr>
                                            <td align="center" width="50%">
                                                <h3 style="margin: 5px">
                                                    <div class="fa fa-arrows"></div>
                                                </h3>
                                            </td>

                                            <td align="right" width="50%"><a style="margin: 0px; width: 60px" href="Chalet-edit.php" class="btn btn-primary bg-red">Delete</a></td>

                                        </tr>

                                        <tr>

                                            <td align="center" width="100%" colspan="2" dir="rtl"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" name="myImage" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" width="100%" colspan="2" dir="rtl">User Name <input style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="text" placeholder="Moho" required="required" class="form-control"></td>

                                        </tr>
                                        <tr>
                                            <td align="right" width="100%" colspan="2" dir="rtl">whatsapp <input style="padding: 5px; margin: 0px 10px 10px 0px;" class="col-md-12 col-sm-12 col-xs-12" dir="ltr" type="number" placeholder="+96597912345" class="form-control"></td>

                                        </tr>



                                    </table>

                                </td>

                                <td width="0" valign="top"><img border="0" src="images/img.jpg" width="60"></td>

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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection