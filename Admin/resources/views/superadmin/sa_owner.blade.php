@extends('superadmin.layouts.sa_layout')
@section('title', "Owner's")
@section('content')

<div>
    <!-- /User Blocked -->
    <div class="x_panel">
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert" align="center"> {{ $message }}</div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert" align="center"> {{ $message }}</div>
        @endif
        <div class="x_title">
            <h1>Owner's</h1>
        </div>
        <div class="x_content">
            <h4><a href="{{url('/add-Owner')}}" class="btn btn-primary">+ Add new Owner</a></h4>
            <!-- /.col -->
        </div>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="1%">No.</th>

                    <th width="25%">Owner Details</th>

                    <th width="15%">Chalets</th>

                    <th width="15%">Active</th>

                    <th width="15%">Reservations</th>

                    <th width="15%">Balance</th>

                    <th width="15%">Action</th>

                </tr>

            </thead>



            <tbody>
            @foreach($ownerdetails as $wdetails)
            <?php $activecount = (new \App\Helper)->get_activechalets($wdetails->id); ?>
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <strong>{{$wdetails->first_name}} &nbsp; {{$wdetails->last_name}}</strong>
                        <br>
                        {{$wdetails->gender}}
                        <br>{{$wdetails->country}}
                        <br>
                        Email:{{$wdetails->email}}
                        <br>Mobile: {{$wdetails->phone}}
                    </td>
                    <td>
                    <?php if(((new \App\Helper)->get_count_chalet($wdetails->id)) != 0){ ?>
                        <?php $id=base64_encode($wdetails->id);?>
                        <a class="btn btn-info  btn-xs" href="{{ url('/Chalet-List') }}/<?php echo $id; ?>">
                        {{(new \App\Helper)->get_count_chalet($wdetails->id)}}</a>
                        <?php }else{
                           echo  "none";
                        } ?>
                    </td>
                    <td>
                        <button>{{$activecount}}</button>
                    </td>
                    <td>
                    <?php $id=base64_encode($wdetails->id);?>
                    <?php if(((new \App\Helper)->get_count_chaletreservation($wdetails->id)) != 0){ ?>
                        <a class="btn btn-info  btn-xs" href="{{ url('/Total-Reservations') }}/<?php echo $id; ?>">{{(new \App\Helper)->get_count_chaletreservation($wdetails->id) }}</a>
                        <?php }else{
                           echo  "none";
                        } ?>
                    </td>
                    <td>
                    <?php $wid=base64_encode($wdetails->id);?>
                    <?php if(((new \App\Helper)->get_remaining($wdetails->id)) != 0){ ?>
                    <a class="btn btn-danger  btn-xs" href="{{ url('/Chalet-List') }}/<?php echo $wid; ?>">{{(new \App\Helper)->get_remaining($wdetails->id) }} KD</a>
                    <?php }else{?>
                          <button>{{(new \App\Helper)->get_remaining($wdetails->id) }} KD</button>
                     <?php   } ?>
</td>
                    <td align="center">
                    <?php $id=base64_encode($wdetails->id);?>
                        <a class="btn btn-success btn-xs" href="{{ url('/Owner-profile') }}/<?php echo $id; ?>" >Profile</a>
                        <br>
                        <a class="btn btn-primary btn-xs" href="{{ url('/Chalet-add') }}/<?php echo $id; ?>" >Add Chalet</a>
                        <br>
                        <a class="btn btn-danger btn-xs" href="{{ url('/deleteowner') }}/<?php echo $id; ?>"  >Delete</a>
             </tr>
                @endforeach  
                
            </tbody>
        </table>
        <hr>
    </div>
</div>
@endsection