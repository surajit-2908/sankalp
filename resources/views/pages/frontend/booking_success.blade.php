@extends('layouts.layout')
@section('content')

    <!-- Body part Start here -->
    <div class="loginBodySec">
        <div class="container">
            <div class="cart-empty bkSuccess">
                <img style="margin-bottom:25px;" alt="icon" src="{{ asset('assets/images/success.png') }}" />
                <h4>Booking Successful</h4>
                <p>Order was successfully processed.</p>
                @if ($booking_type == 'item')
                    <a class="shopBtn" href="{{ route('user.my.orders') }}">View Orders</a>
                @else
                    <a class="shopBtn" href="{{ route('user.online.training.orders') }}">View Orders</a>
                @endif
            </div>
        </div>
    </div>
@stop
