@extends('superadmin.layouts.sa_layout')
@section('title', "Add new Holidays and Events")
@section('content')
<!-- bootstrap-daterangepicker -->
<!-- <link href="{{url('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"> -->
<!-- Custom Theme Style -->
<link href="{{url('build/css/custom.min.css')}}" rel="stylesheet">

<!-- page content -->

<!-- Active Awards -->
<div class="" style="min-height:614px;">
    <div class="clearfix"></div>
    <div class="row">
        <!-- bar charts group -->
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Add new Holidays and Events</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content2">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('addholidayandevent') }}" enctype="multipart/form-data" id="myform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Event Name</label>
                            <div class="col-md-9 col-sm-4 col-xs-12">
                                <input type="text" id="event_name" name="event_name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Check-in</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="" style="padding-top: 5px">
                                    <div class='col-md-4 col-sm-4 col-xs-12'>
                                        <div class="form-group">
                                        <?php $cdate=date("Y-m-d H:i");
                                       $min= date('Y-m-d\TH:i', strtotime($cdate));
                                        ?>
                                        
                                            <!-- <div class='input-group date' id='datetimepicker6'> -->
                                                <input required="required" style="width: 237px;"  name="event_checkin"  min="<?php echo $min; ?>" type='datetime-local' class="form-control" />
                                                <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> -->
                                                </span>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Check-Out</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="" style="padding-top: 5px">
                                    <div class='col-md-4 col-sm-4 col-xs-12'>
                                        <div class="form-group">
                                        <?php  $c_date=date("Y-m-d", strtotime('tomorrow'));
                                         $mini= date('Y-m-d\TH:i', strtotime($c_date)); ?>
                                            <!-- <div class='input-group date' id='datetimepicker7'> -->
                                                <input required="required" min="<?php echo $mini; ?>" name="event_checkout" type='datetime-local' style="width: 237px;" class="form-control" />
                                                <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> -->
                                                </span>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="reset" class="btn btn-primary">Reset</button>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /bar charts group -->
            <!-- pie chart -->
            <!-- /Pie chart -->
        </div>
    </div>
</div>
<!-- /page content -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/moment/min/moment.min.js"></script>
<!-- <script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script> -->
<!-- bootstrap-progressbar -->
<!-- <script src="{{url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script> -->
<!-- bootstrap-daterangepicker -->
<!-- <script src="{{url('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script> -->
<!-- bootstrap-wysiwyg -->
<!-- <script src="{{url('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
<script src="{{url('vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
<script src="{{url('vendors/google-code-prettify/src/prettify.js')}}"></script> -->
<!-- jQuery Tags Input -->
<!-- <script src="{{url('vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script> -->
<!-- Switchery -->
<script src="{{url('vendors/switchery/dist/switchery.min.js')}}"></script>
<!-- Select2 -->
<!-- <script src="{{url('vendors/select2/dist/js/select2.full.min.js')}}"></script> -->
<!-- Parsley -->
<!-- <script src="{{url('vendors/parsleyjs/dist/parsley.min.js')}}"></script> -->
<!-- Autosize -->
<!-- <script src="{{url('vendors/autosize/dist/autosize.min.js')}}"></script> -->
<!-- jQuery autocomplete -->
<!-- <script src="{{url('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script> -->
<!-- starrr -->
<!-- <script src="{{url('vendors/starrr/dist/starrr.js')}}"></script> -->
<!-- Custom Theme Scripts -->
<script src="{{url('build/js/custom.min.js')}}"></script>
<script>
    $('#myDatepicker').datetimepicker();
    $('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
    });
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });
    $('#datetimepicker6').datetimepicker();
    $('#datetimepicker7').datetimepicker({
        useCurrent: false
    });
    $("#datetimepicker6").on("dp.change", function(e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker7").on("dp.change", function(e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
</script>
@endsection