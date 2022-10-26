@extends('layouts.admin-login')
@section('content')
<div class="login-form-yellow-shadow">
	<div class="login-form-bg">
		<img src="{{ asset('images/login-lock-icon.png') }}" alt="">
		<h1>Reset <span>password</span></h1>
		<form id="sign_in_adm" method="POST" action="{{ route('admin.dopasswordreset') }}">
			{{ csrf_field() }}
			<input type="hidden" name="password_reset_token" value="{{ $token }}">
			<div class="form-group">
			<input type="password" class="form-control" name="password" placeholder="New Password" autofocus minlength="6" required>
			</div>
			@if($errors->has('password'))
				<span class="text-danger">{{ $errors->first('password') }}</span>
			@endif
			<div class="form-group">
			<input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" autofocus minlength="6" required>
			</div>
			@if($errors->has('password_confirmation'))
				<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
			@endif
			@include('includes.message')
			<div class="login-btn">
				<input type="submit" name="" value="Reset">
			</div>
		</form>    
	</div>
</div>
@stop