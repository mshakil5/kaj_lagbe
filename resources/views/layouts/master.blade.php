<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>EDGE</title>

    <!-- CSS FILES -->
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/templatemo-kind-heart-charity.css')}}" rel="stylesheet">

</head>

<body id="section_1">


    @include('frontend.inc.header')

    @yield('content')

    @include('frontend.inc.footer')

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.sticky.js')}}"></script>
    <script src="{{ asset('frontend/js/click-scroll.js')}}"></script>
    <script src="{{ asset('frontend/js/counter.js')}}"></script>
    <script src="{{ asset('frontend/js/custom.js')}}"></script>

    <script>
        
    $(document).ready(function () {

        //header for csrf-token is must in laravel
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //

        //check post code start 
      var url = "{{URL::to('/check-post-code')}}";
        $("#post_code").keyup(function(){
            var length =  $(this).val().length;

            var postcode = $("#post_code").val();
            
            if (length > 2) {
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {postcode},

                    success: function (d) {
                        if (d.status == 303) {
                            $(".perrmsg").html(d.message);
                            $('#submitBtn').attr('disabled', true);
                        }else if(d.status == 300){
                            $(".perrmsg").html(d.message);
                            $('#submitBtn').attr('disabled', false);
                        }
                    },
                    error: function (d) {
                        console.log(d);
                    }
                }); 
            }else{
                $(".perrmsg").html("");
            }

            
        });
        //check post code end 

    });

    </script>

</body>

</html>