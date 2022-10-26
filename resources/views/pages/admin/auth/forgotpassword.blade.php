@extends('layouts.admin-login')
@section('content')
<div class="login-form-yellow-shadow">
	<div class="login-form-bg">
		<img src="{{ asset('images/login-lock-icon.png') }}" alt="">
		<h1>Forgot <span>password</span></h1>
		<form id="sign_in_adm" method="POST" action="{{ route('admin.sendpasswordresetlink') }}">
			{{ csrf_field() }}
			<div class="form-group">
			<input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" autofocus required>
			</div>
			@if($errors->has('email'))
				<span class="text-danger">{{ $errors->first('email') }}</span>
			@endif
			@include('includes.message')
			<div class="login-btn">
				<input type="submit" name="" value="Send">
			</div>
		</form>    
	</div>
</div>
@stop