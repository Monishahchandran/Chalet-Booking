@extends('superadmin.layouts.sa_layout')
@section('title', "Add New Chalet")
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
        $(wrapper).append('<div><a href="#" style="margin-left: 486px;" class="delete">Delete</a><div  style="margin-left: 263px;display:flex;flex-flow: row wrap;"><input type="file" dir="rtl"  style="width: 297px;height: 34px;" id="insert_video" name="uploadvideo[]"  accept="video/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /><div id="videopreview"><img border="0" src="{{url("images/Chalet.jpg")}}" width="100"></div></div>');  //add video field
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
        $(wrapper).append('<div><a href="#" style="margin-left: 486px;" class="delete">Delete</a><div  style="margin-left: 263px;display:flex;flex-flow: row wrap;"><input type="file" dir="rtl"  style="width: 297px;height: 34px;padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" id="insertphoto" accept="image/*" data-role="magic-overlay" name="uploadphoto[]" data-target="#pictureBtn" data-edit="insertImage" multiple /><div id="photopreview"><img border="0" src="{{url("images/Chalet.jpg")}}" width="100"></div></div>');  //add photo field
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
          <h1>Add New Chalet to Owner : {{$ownerdetails->first_name}}&nbsp;{{$ownerdetails->last_name}}</h1>
          <ul class="nav navbar-right panel_toolbox">
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form class="form-horizontal form-label-left" method="POST" action="{{ url('addchalet') }}" enctype="multipart/form-data" id="myform">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="ownerid" value="{{$ownerdetails->id}}">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Chalet Name</label>
              <div class="col-md-5 col-sm-9 col-xs-12">
              <!-- dir="rtl" -->
                <input  type="text" required="required"  name="chalet_name" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Location ( URL )</label>
              <div class="col-md-5 col-sm-9 col-xs-12">
                <input type="url" required="required" name="location" placeholder="https://www.google.com/maps/place/Kuwait/@29.3117846,46.4143415,8z/data=!3m1!4b1!4m5!3m4!1s0x3fc5363fbeea51a1:0x74726bcd92d8edd2!8m2!3d29.31166!4d47.481766" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Commission %</label>
              <div class="col-md-5 col-sm-9 col-xs-12">
                <input type="number" required="required" placeholder="10" name="commission" class="form-control">
              </div>
            </div>
            <div class="ln_solid"></div>
            <h3>Rental Price</h3>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Weekdays</label>
              <div class="col-md-5 col-sm-9 col-xs-12">
                <input type="number" required="required" name="weekday_rent" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Weekend</label>
              <div class="col-md-5 col-sm-9 col-xs-12">
                <input type="number" required="required" name="weekend_rent" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Week (A) / Week (B)</label>
              <div class="col-md-5 col-sm-9 col-xs-12">
                <input type="number" required="required" name="week_rent" class="form-control">
              </div>
            </div>
            <div class="ln_solid"></div>
            <h3>Video ( optional )</h3>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
              <div class="col-md-5 col-sm-9 col-xs-12">
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
                            <td align="right" width="50%"><a  style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" onclick="mydeletefunction();">Delete</a> </td>
                          </tr>
                          <tr>
                            <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" id="insertvideo" name="uploadvideo[]" accept="video/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></td>
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
                </table>
                
              </div>
            </div>
                      <div class="container2" >
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
                            <td align="right" width="50%"><a  style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" id="deletebutton" onclick="myfunction();">Delete</a> </td>
                          </tr>
                          <tr>
                            <td align="center" width="100%" colspan="2" dir="rtl" cellpadding="5"><input style="padding: 5px; margin: 10px 10px 10px 0px; background: #ffffff" class="col-md-12 col-sm-12 col-xs-12" dir="rtl" type="file" id="insertphoto" name="uploadphoto[]" accept="image/*" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" required="required" /></td>
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
                </table>
              </div>
            </div>
            <div class="container3" >
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
                                <td align="center" width="100%" colspan="2"  cellpadding="5"><input type="text" id="first-name" name="chalet_detail[]" class="form-control" ></td>
                              </tr>
                              <tr>
                                <td align="center" width="50%" style="padding-right: 80px">
                                  <h3 style="margin: 5px">
                                    <div class="fa fa-arrows"></div>
                                  </h3>
                                </td>
                                <td align="right" width="50%"><a href="#" style="padding: 2px 5px 2px 5px" class="btn btn-primary bg-red" >Delete</a> </td>
                              </tr>
                              <tr>
                              <!-- dir="rtl"dir="rtl"dir="rtl"dir="rtl" -->
                                <td align="center" width="100%" colspan="2"  cellpadding="5"><input type="text" id="first-name" name="chalet_detail[]" class="form-control" ></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <!-- all -->
                      </tbody>
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

function myfunction(){
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
function mydeletefunction(){
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
</script>
@endsection
