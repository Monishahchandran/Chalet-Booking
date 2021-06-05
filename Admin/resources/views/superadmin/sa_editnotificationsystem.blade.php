@extends('superadmin.layouts.sa_layout')
@section('title', "System Auto Notifications")
@section('content')
<div>
    <div class="clearfix"></div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert" align="center">
        Notification Test has been send to Admin
    </div>
    @endif
    <div class="row">
        <!-- bar charts group -->
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Edit System Auto Notifications</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content2">
                    <form class="form-horizontal form-label-left"  method="POST" action="{{ url('update_systemnotification') }}" enctype="multipart/form-data" id="myform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$notification->id}}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title
                            </label>
                            <div class="col-md-8 col-sm-4 col-xs-12">
                                <input dir="rtl" type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12" value="{{$notification->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Message
                            </label>
                            <div class="col-md-8 col-sm-4 col-xs-12">
                                <textarea dir="rtl" id="message" name="message" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" rows="2" maxlength="140">{{$notification->message}}</textarea>
                            </div>
                            <div style="padding-top: 38px">140</div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <a href="javascript:history.back()" class="btn btn-info btn-warning">Back</a>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                                <button href="#" class="btn btn-info pull-right"><i class="fa fa-send"></i> Send Test to Admin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Code</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content2">
                    <form class="form-horizontal form-label-left">
                        <div class="clearfix">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User Name</label>
                                <div style="padding-top: 8px" class="col-md-9 col-sm-4 col-xs-12">{UserName}</div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Country</label>
                                <div style="padding-top: 8px" class="col-md-9 col-sm-4 col-xs-12">{Country}</div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rewards</label>
                                <div style="padding-top: 8px" class="col-md-9 col-sm-4 col-xs-12">{Rewards}</div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Balance</label>
                                <div style="padding-top: 8px" class="col-md-9 col-sm-4 col-xs-12">{Balance}</div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date</label>
                                <div style="padding-top: 8px" class="col-md-9 col-sm-4 col-xs-12">{Date}</div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Time</label>
                                <div style="padding-top: 8px" class="col-md-9 col-sm-4 col-xs-12">{Time}</div>
                            </div>
                        </div>
                    </form>
                    <br /> <br /> <br /> <br /> <br /> <br /> <br />
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /page content -->
@endsection