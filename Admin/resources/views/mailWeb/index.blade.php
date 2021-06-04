<!DOCTYPE html>

<html lang="zxx">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <meta http-equiv="cache-control" content="max-age=0">

    <meta http-equiv="cache-control" content="no-cache">

    <meta http-equiv="expires" content="0">

    <meta http-equiv="pragma" content="no-cache">

    <!-- All CSS files included here -->

    <link rel="stylesheet" href="{{url('mailfile/img/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{url('mailfile/img/style.css')}}">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>طلب اضافه شاليه </title>

</head>



<body topmargin="0" bottommargin="0">




    <br>



    <h4 style="text-align: center;  color: #fff; padding-bottom: 20px;">طلب اضافه شاليه</h4>



    <h6 style="text-align: center;  color: #FFF500">هذا النموذج خاص بملاك وأصحاب الشاليهات فقط</h6>

    <div align="center" width="100%">





        <div class="rowx1" style="margin-bottom: 100px;">

            <div class="rowx31">



                <div class="rowx2" data-wow-delay=".2s">



                    <form id="gxap-contact-form" method="POST" >

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <input dir="rtl" type="tel" id="phone" name="phone" class="form-control1" placeholder="هـاتفـك" required>

                                </div>

                            </div>

                            <div class="col-md-6">



                                <div class="form-group">





                                    <table border="0" width="100%" cellspacing="0" cellpadding="0">

                                        <tr>



                                            <td width="100%" dir="rtl" align="right">





                                                <input dir="rtl" type="text" name="name" class="form-control" id="name" placeholder="أسـمــك" required>

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            </div>

                            <div class="col-md-6">

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <textarea dir="rtl" name="message" class="form-control" rows="6" placeholder="تفاصيل الشاليه مثال : 

- شاليه صف أول على البحر 

- يحتوي على 7 غرف نوم 5 منهم ماستر 

- حمام سباحه خارجي 

- العاب اطفال ... الخ" required></textarea>

                                </div>





                                <div class="form-group">

                   
                </div>
                <button type="button" onclick="myFunction();" class="btn btn-gradient btn-gradient-reverse">send

                    message

                </button>

                <p class="form-send-message" id="showmessage" style="color: red;font-size: 18px;"></p>
<br/>
            </div>

        </div>

        </form>

    </div>
    <script type="text/javascript">
    function myFunction() {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert(check);
        var phone =  $('#phone').val();
        var name =$('#name').val();
        var message = $('#message').val();
        // alert(phone);
        // data:{status:name, password:password, email:email},
        $.ajax({
            type: 'POST',
            url: "{{ route('sendmail') }}",
            data: {
                phone: phone,
                message: message,
                name:name
            },
            beforeSend: function() {
                // Show image container
                // $("#loader1").show();
            },
            success: function(data) {
                //   alert(data.success);
                //   $('#showmessage').val(data.success);
                  document.getElementById("showmessage").innerHTML = data.success;
            },
            complete: function(data) {
                // Hide image container
                // $("#loader1").hide();
            }
        });

        // });
    }
</script>
    <!-- All javascript plugins are included here -->

    <script src="{{url('mailfile/js/jquery-3.3.1.min.js')}}"></script>

    <script src="{{url('mailfile/js/popper.min.js')}}"></script>

    <script src="{{url('mailfile/js/bootstrap.min.js')}}"></script>

    <script src="{{url('mailfile/js/wow.min.js')}}"></script>

    <script src="{{url('mailfile/js/slick.min.js')}}"></script>

    <script src="{{url('mailfile/js/swiper.min.js')}}"></script>

    <script src="{{url('mailfile/js/rellax.min.js')}}"></script>

    <script src="{{url('mailfile/js/jquery.easing.1.3.js')}}"></script>

    <script src="{{url('mailfile/js/venobox.min.js')}}"></script>

    <script src="{{url('mailfile/js/particles.min.js')}}"></script>

    <script src="{{url('mailfile/js/jquery.counter.js')}}"></script>

    <script src="{{url('mailfile/js/smoothscroll.js')}}"></script>

    <script src="{{url('mailfile/js/scripts.js')}}"></script>

</body>

</html>