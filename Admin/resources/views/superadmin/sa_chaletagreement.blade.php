@extends('superadmin.layouts.sa_layout')
@section('title', 'Agreement')
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

        var wrapper = $(".container1");

        var add_button = $(".add_form_field");
        var x = 1;

        $(add_button).click(function(e) {

            e.preventDefault();

            if (x < max_fields) {

                x++;

                $(wrapper).append('<div><input style="padding: 5px" class="form-control" type="text" name="agreement[]"><a href="#" class="delete">Delete</a><div class="ln_solid"></div>'); //add input box

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
                    <h1>Agreement</h1>
                    <!-- HTML Code -->
                    <div class="x_content">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Html Code</button>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Html Code</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <tr>

                                                <td width="30%"><b>Bold</b></td>

                                                <td width="70%">&lt;b&gt; Text here &lt;/b&gt;</td>

                                            </tr>
                                            <tr>

                                                <td width="30%">
                                                    <font style="color:red;">Red color</font>
                                                </td>

                                                <td width="70%">&lt;font style="color:red;"&gt; Text here &lt;/font&gt;</td>

                                            </tr>
                                            <tr>

                                                <td width="30%">
                                                    <font style="color:red;"><b>Red color and Bold</b></font>
                                                </td>

                                                <td width="70%">&lt;font style="color:red;"&gt;&lt;b&gt; Text here &lt;/b&gt;&lt;/font&gt;</td>

                                            </tr>
                                            <tr>

                                                <td width="30%">
                                                    <font style="color:blue;">blue color</font>
                                                </td>

                                                <td width="70%">&lt;font style="color:blue;"&gt; Text here &lt;/font&gt;</td>

                                            </tr>
                                            <tr>

                                                <td width="30%">
                                                    <font style="color:blue;"><b>blue color and Bold</b></font>
                                                </td>

                                                <td width="70%">&lt;font style="color:blue;"&gt;&lt;b&gt; Text here &lt;/b&gt;&lt;/font&gt;</td>

                                            </tr>
                                            <tr>

                                                <td width="30%">( <font style="color:red;"><b> Sample 1 </b></font> )</td>

                                                <td width="70%">( &lt;font style="color:red;"&gt;&lt;b&gt; Text here &lt;/b&gt;&lt;/font&gt; )</td>

                                            </tr>
                                            <tr>
                                                <td width="30%">( <font style="color:blue;"><b> Sample 2 </b></font> )</td>

                                                <td width="70%">( &lt;font style="color:blue;"&gt;&lt;b&gt; Text here &lt;/b&gt;&lt;/font&gt; )</td>

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
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                @if($agreementdata->isEmpty())
                                <form class="form-horizontal form-label-left" method="POST" action="{{ url('addagreement') }}" enctype="multipart/form-data" id="myform">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div>
                                        <!-- Chalet Details -->
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

                                                                <td align="right" width="50%"><a href="#" style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red">Delete</a> </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input type="text" id="first-name" name="agreement[]" class="form-control" dir="rtl"></td>

                                                            </tr>
                                                        </table>
                                                <tr>

                                                    <td align="right" width="100%" valign="top">
                                                        <table border="0" width="100%">
                                                            <tr>

                                                                <td align="center" width="50%">
                                                                    <h3 style="margin: 5px">
                                                                        <div class="fa fa-arrows"></div>
                                                                    </h3>
                                                                </td>

                                                                <td align="right" width="50%"><a href="#" style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red">Delete</a> </td>

                                                            </tr>

                                                            <tr>

                                                                <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input type="text" id="first-name" name="agreement[]" class="form-control" dir="rtl"></td>

                                                            </tr>
                                                        </table>
                                                        <!-- all -->
                                            </tbody>
                                        </table>

                                        <!-- Chalet Details -->

                                        <div class="container1" dir="rtl">
                                            <a href="#" class="btn btn-primary add_form_field" style="margin-bottom: 5px" dir="ltr"> + Add New Note </a>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-md-offset-4">
                                                <button id="send" type="submit" class="btn btn-success" style="padding: 10px 120px 10px 120px">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <form class="form-horizontal form-label-left" method="POST" action="{{ url('updateagreements') }}" enctype="multipart/form-data" id="myform">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="agreementid" id="agreementid">
                                    <input type="hidden" name="deleteid" id="deleteid">
                                    <div>
                                        @foreach($agreementdata as $adata)
                                        <!-- Chalet Details -->
                                        <table id="agreement_table<?php echo $loop->iteration; ?>" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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

                                                                <td align="right" width="50%"><a href="#" style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" onclick="delete_function('<?php echo $adata->id; ?>','agreement_table<?php echo $loop->iteration; ?>');">Delete</a> </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" width="100%" colspan="2" cellpadding="5"><input type="text" id="agreement_update<?php echo $loop->iteration; ?>" name="agreement_update[]" class="form-control" value="{{$adata->agreement_content}}" onchange="myfunction('<?php echo $adata->id; ?>','agreement_update<?php echo $loop->iteration; ?>');"></td>

                                                            </tr>
                                                        </table>

                                            </tbody>
                                        </table>
                                        @endforeach
                                        <!-- Chalet Details dir="rtl"-->

                                        <div class="container1">
                                            <a href="#" class="btn btn-primary add_form_field" style="margin-bottom: 5px;margin-left: 900px;"> + Add New Note </a>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-md-offset-4">
                                                <button id="send" type="submit" class="btn btn-success" style="padding: 10px 120px 10px 120px">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    function myfunction($id, $tagid) {
        $val = $("#agreementid").val();
        // alert($val);
        $tid = "#" + $tagid;
        $content = $($tid).val();
        var nn = $id;
        if ($val == "") {
            // alert("empty");
            $('#agreementid').val($('#agreementid').val() + nn + '+' + $content);
        } else {
            // alert("not empty");
            $('#agreementid').val($('#agreementid').val() + ',' + nn + '+' + $content);
        }
    }

    function delete_function($id, $tagid) {
        // alert($tagid);
        $val = $("#deleteid").val();
        $tid = "#" + $tagid;
        $($tid).remove();
        var nn = $id;
        if ($val == "") {
            // alert("empty");
            $('#deleteid').val($('#deleteid').val() + nn);
        } else {
            // alert("not empty");
            $('#deleteid').val($('#deleteid').val() + ',' + nn);
        }
    }
</script>
@endsection