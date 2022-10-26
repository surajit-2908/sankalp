<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>787 Fitness</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <!-- Bootstrap Css -->
    <link type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Fontawesome Css -->
    <link type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Owl Ccarousel Css -->
    <link type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Custom Css -->
    <link type="text/css" href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- Font Link -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">

    @stack('links')
</head>

<body>
    <div class="wrapper">
        @if (!Route::is('product.detail'))
            <div class="bodyBG">

                @include('includes.frontend.header')

                @yield('content')

            </div>
        @else
            @include('includes.frontend.header')

            @yield('content')
        @endif
        @include('includes.frontend.footer')
    </div>
    @stack('modal')
    <!-- JS Start here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script>
        window.jQuery ||
            document.write('<script src="js/jquery.min.js"><\/script>');
    </script>
    <!-- <script src="{{ asset('assets/js/modernizr-3.6.0.min.js') }}"></script> -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Owl Ccarousel JS -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#submit-footer-form").on("click", function() {
                ValidateEmail($("#footer-email").val());
            })
        })

        function ValidateEmail(email) {

            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (!filter.test(email)) {
                $('#footer-email-err').removeClass('d-none');
                email.focus;
                return false;
            } else {
                $('#footer-email-err').addClass('d-none');
                $('#submit-footer-form').addClass('d-none');
                $('#footer-form-loader').removeClass('d-none');
                setTimeout(function() {
                    $('#submit-footer-form').removeClass('d-none');
                    $('#footer-form-loader').addClass('d-none');
                    $('#footer-email-suc').removeClass('d-none');
                    $("#footer-email").val("");
                    setTimeout(function() {
                        $('#footer-email-suc').addClass('d-none');
                    }, 4000);
                }, 4000);
            }
        }
    </script>
    @stack('scripts')
</body>

</html>
