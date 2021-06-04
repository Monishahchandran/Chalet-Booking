<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    @if($reservationlist->status=='Remaining')
    Paid invoice ( Remaining )
    @endif
    @if($reservationlist->status=='Paid')
    Paid invoice
    @endif
    @if(empty($reservationlist->status))
    UnPaid invoice
    @endif
  </title>
  <!-- Bootstrap -->
  <link href="{{url('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{url('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{url('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{url('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  <!-- Datatables -->
  <link href="{{url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="{{url('build/css/custom.min.css')}}" rel="stylesheet">
</head>

<body style="padding: 120px 0px 0px 0px">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <section class="content invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12 invoice-header">
              <h1><i class="fa fa-globe"></i>
                @if($reservationlist->status=='Remaining')
                Paid invoice ( Remaining )
                @endif
                @if($reservationlist->status=='Paid')
                Paid invoice
                @endif
                @if(empty($reservationlist->status))
                UnPaid invoice
                @endif
                <small class="pull-right">No. : #{{$reservationlist->reservation_id}} </small>
              </h1> <b style="padding: 50px"></b>
              <h4>{{date('Y-m-d h:i A', strtotime($reservationlist->createdat))}}
                <h4>
                  <hr>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-md-6 col-sm-12 col-xs-6">
              <h3>User Details</h3>
              <address>
                <?php $userdetails = (new \App\Helper)->get_user_details($reservationlist->userid); ?>
                <address>
                  <b>{{$userdetails->first_name}}&nbsp;{{$userdetails->last_name}}</b>
                  <br>{{$userdetails->gender}}
                  <br>{{$userdetails->country}}
                  <br>Email:{{$userdetails->email}}
                  <br>Mobile:{{$userdetails->country_code}}{{$userdetails->phone}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-md-6 col-sm-12 col-xs-6">
              <h3>Chalet Details</h3>
              <address>
                <b>{{$reservationlist->chalet_name}}</b>
                <br>
                <b style="color: limegreen">Check-in</b>: {{$reservationlist->check_in}}
                <br>
                <b style="color: red">Check-Out</b>: {{$reservationlist->check_out}}
              </address>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <table class="table">
                <tbody>
                  <tr>
                    <td style="width:25%">
                      <h3>Basic Info</h3>
                    </td>
                    <td></td>
                    <td>
                      <h3>Transactions</h3>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Status</b></td>
                    <td style="color: limegreen"><b>
                        @if($reservationlist->status=='Remaining')
                        Remaining
                        @endif
                        @if($reservationlist->status=='Paid')
                        Paid
                        @endif
                        @if(empty($reservationlist->status))
                        UnPaid
                        @endif
                      </b></td>
                    <td><b>Transaction Date</b></td>
                    <td>{{date('Y-m-d h:i A', strtotime($reservationlist->createdat))}}</td>
                  </tr>
                  <tr>
                    <th>Rental Price </th>
                    <td><b>{{$reservationlist->package_price}} KD</b> </td>
                    <td><b>Payment Gateway</b></td>
                    <td>{{$reservationlist->payment_gateway}}</td>
                  </tr>
                  <tr>
                    <th>Deposit</th>
                    <td><b>{{$reservationlist->deposit}} KD</b> </td>
                    <td><b>Payment ID</b></td>
                    <td>{{$reservationlist->payment_id}}</td>
                  </tr>
                  <tr>
                    <th>Rewards ( Discount )</th>
                    <td><b>-{{$reservationlist->reward_discount}} KD</b> </td>
                    <td><b>Authorization ID</b></td>
                    <td>{{$reservationlist->authorization_id}}</td>
                  </tr>
                  <tr>
                    <th>Offers ( Discount )</th>
                    <td><b>-{{$reservationlist->offer_discount}} KD</b> </td>
                    <td><b>Track ID</b></td>
                    <td>{{$reservationlist->track_id}}</td>
                  </tr>
                  <tr>
                    <th>Total Paid</th>
                    <td><b>{{$reservationlist->total_paid}} KD</b> </td>
                    <td><b>Transaction ID</b></td>
                    <td>{{$reservationlist->transaction_id}}</td>
                  </tr>
                  <tr>
                    <th>Remaining</th>
                    <td><b>{{$reservationlist->package_price-$reservationlist->total_paid}} KD</b> </td>
                    <th>Invoice Reference</th>
                    <td>{{$reservationlist->invoice_reference}}</td>
                  </tr>
                  <tr>
                    <th>Invoice Reference</th>
                    <td>{{$reservationlist->invoice_reference}}</td>
                    <td><b>Reference ID</b></td>
                    <td>{{$reservationlist->reference_id}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
        </section>
      </div>
    </div>
    <div class="row no-print">
      <div class="col-xs-12">
        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print bg-xs"></i> Print</button>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{url('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{url('vendors/fastclick/lib/fastclick.js')}}"></script>
  <!-- NProgress -->
  <script src="{{url('vendors/nprogress/nprogress.js')}}"></script>
  <!-- iCheck -->
  <script src="{{url('vendors/iCheck/icheck.min.js')}}"></script>
  <!-- Datatables -->
  <script src="{{url('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <!-- <script src="{{url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script> -->
  <script src="{{url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
  <!-- <script src="{{url('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script> -->
  <!-- <script src="{{url('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script> -->
  <!-- <script src="{{url('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script> -->
  <!-- <script src="{{url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script> -->
  <!-- <script src="{{url('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script> -->
  <!-- <script src="{{url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script> -->
  <script src="{{url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
  <!-- <script src="{{url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script> -->
  <!-- <script src="{{url('vendors/jszip/dist/jszip.min.js')}}"></script> -->
  <!-- <script src="{{url('vendors/pdfmake/build/pdfmake.min.js')}}"></script> -->
  <!-- <script src="{{url('vendors/pdfmake/build/vfs_fonts.js')}}"></script> -->
  <!-- Custom Theme Scripts -->
  <script src="{{url('build/js/custom.min.js')}}"></script>
</body>

</html>