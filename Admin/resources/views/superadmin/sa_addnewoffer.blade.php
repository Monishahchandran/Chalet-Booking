@extends('superadmin.layouts.sa_layout')
@section('title', "Add new offer to Chalet")
@section('content')
<!-- bootstrap-wysiwyg -->
<!-- <link href="{{url('vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet"> -->
<!-- Select2 -->
<!-- <link href="{{url('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet"> -->
<!-- Switchery -->
<link href="{{url('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
<!-- starrr -->
<!-- <link href="{{url('vendors/starrr/dist/starrr.css')}}" rel="stylesheet"> -->
<!-- bootstrap-daterangepicker -->
<!-- <link href="{{url('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"> -->
<!-- page content -->
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <!-- bar charts group -->
        <div class="x_panel">
        <div class="alert alert-danger" id="dangermsg" style="display:none;" role="alert" align="center"></div>
            <div class="x_title">
                <h1>Add new offer to Chalet</h1>
                <div class="clearfix"></div>
            </div>
            <div class="x_content2">
                <form class="form-horizontal form-label-left" method="POST" action="{{ url('addoffer') }}" enctype="multipart/form-data" id="myform">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="chalet_id" id="chalet_id">
                                        <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Discount ( KD )</label>
                        <div class="col-md-3 col-sm-9 col-xs-12">
                            <input type="text" id="discount_amt" name="discount_amt" required="required" class="form-control col-md-7 col-xs-12" >
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Check-in</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="" style="padding-top: 5px">
                                <div class='col-md-4 col-sm-4 col-xs-12'>
                                    <div class="form-group">
                                        <?php $cdate = date("Y-m-d H:i");
                                        $min = date('Y-m-d\TH:i', strtotime($cdate));
                                        ?>
                                        
                                        <!-- <div class='input-group date' id='datetimepicker6'> -->
                                        <input required="required" min="<?php echo $min; ?>" type='datetime-local' id="offer_checkin"  name="offer_checkin" class="form-control" />
                                        <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> -->
                                        <!-- </span> -->
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
                                        <?php $cdate = date("Y-m-d H:i");
                                        $min = date('Y-m-d\TH:i', strtotime($cdate));
                                        ?>
                                        <!-- <div class='input-group date' id='datetimepicker7'> -->
                                        <input required="required" min="<?php echo $min; ?>" type='datetime-local' id="offer_checkout" name="offer_checkout" class="form-control" />
                                        <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <button id="send" type="button"  onclick="myFunction();" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Chalet List</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content2">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th width="1%">Photo</th>
                                <th width="40%">Chalet Details</th>
                                <th width="55%">Original Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chaletdetails as $cdetails)
                            <?php $image = (new \App\Helper)->get_chalet_image($cdetails->cid);
                            $count = (new \App\Helper)->get_offer_count($cdetails->cid);
                            ?>
                            <tr>
                                <td align="center">
                                    <label><input type="checkbox" id="myCheck<?php echo $cdetails->cid; ?>" onclick="myclickfunc('<?php echo $cdetails->cid; ?>','myCheck<?php echo $cdetails->cid; ?>')" name="chaletid"> </label>
                                </td>

                                <td>
                                    <img border="0" src="{{url('uploads/chalet_uploads/chalet_images/')}}/<?php echo $image; ?>" width="120">
                                </td>
                                <td>
                                    <strong>{{$cdetails->chalet_name}}</strong></br>
                                    <br>
                                    Total No. Offers : <strong>{{$count}}</strong>
                                </td>
                                <td>
                                    Weekdays : <strong>{{$cdetails->weekday_rent}}</strong> KD</br>
                                    Weekend : <strong>{{$cdetails->weekend_rent}}</strong> KD</br>
                                    Week : <strong>{{$cdetails->week_rent}}</strong> KD
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function myclickfunc($id,$tagid) {
        // alert($tagid);
        $tid = "#" + $tagid;
        if ($($tid).prop('checked')  == true) {
			// alert("now checked");
            $($tid).prop('checked', true);
			$check = 1;
		} 
        else {
			// alert("now un-checked");
			$check = 0;
		}
        // alert($check);

        if ($check == '1') {
            $val = $("#chalet_id").val();
            // 
            // $content = $($tid).val();
            var nn = $id;
            if ($val == "") {
                // alert("empty");
                $('#chalet_id').val($('#chalet_id').val() + nn);
            } else {
                // alert("not empty");
                $('#chalet_id').val($('#chalet_id').val() + ',' + nn );
            }
        }else{

            $val = $("#chalet_id").val();
            $ret = $val.replace($id,'');
            // $("#chalet_id").val(ret);
            $("#chalet_id").val($ret)
            // alert($ret);
        }
    }
    function myFunction() {
    //    alert($('#discount_amt').val());
    //    if (){
    //        alert("empty");
    //    }else{
    //        alert("not");
    //    }
            if ((!$('#chalet_id').val())) {
                $('#dangermsg').html('Please Select Chalets').css('display', 'block');
                $(window).scrollTop(0);
            } else {
                if ((!$('#offer_checkin').val()),(!$('#offer_checkout').val()),(!$('#discount_amt').val())) {
                $('#dangermsg').html('Please Enter All Fields').css('display', 'block');
                $(window).scrollTop(0);
            } else {
                $('#dangermsg').css('display', 'none');
                $("#myform").submit();
            }
            }

    }
</script>
<!-- bootstrap-progressbar -->
<!-- <script src="{{url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script> -->
<!-- iCheck -->
<script src="{{url('vendors/iCheck/icheck.min.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{url('vendors/moment/min/moment.min.js')}}"></script>
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
@endsection