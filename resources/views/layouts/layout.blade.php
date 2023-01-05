<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />
    <title>{{ $metaTag->meta_title ? $metaTag->meta_title : 'Sankalp Corporation' }}</title>
    <meta name="keywords" content="{{ $metaTag->meta_keywords ? $metaTag->meta_keywords : 'Sankalp Corporation' }}" />
    <meta name="description" content="{{ $metaTag->meta_description ? $metaTag->meta_description : 'Sankalp Corporation' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />
    <!-- Bootstrap -->
    <link type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Owl Carousel -->
    <link type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <!-- Custom Css -->
    <link type="text/css" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    @stack('links')
</head>

<body>
    @include('includes.frontend.header')
    <section class="bodySec">
        <div class="dFlx">

            @include('includes.frontend.sidebar')

            @yield('content')

            @include('includes.frontend.modal')
        </div>
        @stack('modal')
        <!-- JS Start here -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')
        </script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- Owl Carousel JS -->
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <!-- Custome js -->
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        @stack('scripts')
        <script>
            function validateEmail($email) {
                if ($email != "") {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    return emailReg.test($email);
                } else {
                    return false;
                }
            }
            $(document).ready(function() {
                $("#track-button").click(function() {
                    let invoice_number = $("#invoice_number").val();
                    let email = $("#email").val();
                    if (invoice_number == "") {
                        $("#invoice_number_error").show();
                    } else if (!validateEmail(email)) {
                        $("#invoice_number_error").hide();
                        $("#email_error").show();
                    } else {
                        $("#invoice_number_error").hide();
                        $("#email_error").hide();
                        $("#track-button").val("Loading...")
                        $.post('{{ route('show.tracking.details') }}', {
                            "invoice_number": invoice_number,
                            "email": email,
                            "_token": "{!! @csrf_token() !!}"
                        }, function(response) {
                            $("#track-button").val("Track now")
                            $("#modalOrderStatus").html(response);
                        });
                    }
                })

                $("#close-tracking").click(function() {
                    $(".modalOrderStatus").hide();
                    $("#invalid-invoice").hide();
                    $("#invoice_number").val("");
                    $("#email").val("");
                })
            })
        </script>

</body>

</html>
