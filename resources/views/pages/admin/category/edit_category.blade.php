@extends('layouts.admin-dashboard')
@section('content')
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">Edit Category</h1>
        <a class="addNew" href="{{ route('admin.category') }}">Back</a>
    </div>
    <div class="admin-body-area">

        <div class="booking-status-sec order-list-sec">
            <div class="category-list-area">
                <form action="{{ route('admin.category.update', $dataArr['categoryArr']->id) }}" method="POST"
                    id="category_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $dataArr['categoryArr']->name }}" required="">
                            </div>
                        </div>
                    </div>
                    <button class="submit-btn subBtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
@stop
