<!DOCTYPE html>
<html lang="en-US">

<head>
    @include('includes.header')
</head>

<body>
	<section class="login-body-bg">
		<!-- <img class="login-bg" src="{{ asset('admin/images/login-body-bg.jpg') }}" alt=""> -->
		<div class="login-form">
			<div class="container">
				<div class="login-logo"><img src="{{asset('assets/images/footer-logo.png')}}" alt="Hero Fit"></div>
				@yield('content')
				@include('includes.footer-text')
			</div>
		</div>
	</section>
	@include('includes.footer')
</body>

</html>
