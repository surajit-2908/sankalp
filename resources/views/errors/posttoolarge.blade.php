@extends('errors.minimal')

@section('title', __('Post Too Large'))
@section('code', '422')
@section('message', __('Image Size Too Large'))
@section('button')
    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider text-center">
        <a href="{{ url()->previous() }}" class="btn btn-default">Go Back To Upload</a>
    </div>
@endsection
