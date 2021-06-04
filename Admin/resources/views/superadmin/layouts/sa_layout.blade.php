<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
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
<style>
.lds-roller {
  position: absolute;
    margin-left:627px;
    margin-top:290px;
  /* display: inline-block; */
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #fff;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


  #myDiv {
    display: none;
  }
</style>

<body class="nav-md" onload="loaderFunction()">
  <div class="container body">
    <div class="main_container">
      <!-- <div class="lds-roller"></div> -->
      <div id="loader" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      <span style="display:none;" id="myDiv">
        <!--  menu -->
        @include('superadmin.sa_menu')
        <!-- / menu -->

        <!-- page content -->
        <!-- Active Awards -->
        <div class="right_col" role="main">
          <!-- Warning -->
          <!-- <div class="x_panel">
            <div class="alert alert-success" role="alert" align="center">
            Note
            </div>
            </div>-->
          <!-- Warning -->
          @yield('content')
          <!-- /footer content -->
      </span>
    </div>
  </div>
  <script>
    var myVar;
    function loaderFunction() {
      myVar = setTimeout(showPage);
      //setTimeout(showPage, 100);
    }
    function showPage() {
      document.getElementById("loader").style.display = "none";
      document.getElementById("myDiv").style.display = "block";
    }
  </script>

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
</body>

</html>