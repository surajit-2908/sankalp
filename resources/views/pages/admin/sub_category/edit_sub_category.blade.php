@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Edit Sub Category</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.sub.category') }}">Back</a>
                </h3>
            </div>

            <div class="category-list-area">
                <form action="{{ route('admin.sub.category.update', $dataArr['categoryArr']->id) }}" method="POST"
                    id="category_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="parent_id" required>
                                    <option value="0">Select Category</option>
                                    @foreach ($dataArr['parentCategoryArr'] as $pCat)
                                        <option value="{{ $pCat->id }}"
                                            {{ $pCat->id == $dataArr['categoryArr']->parent_id ? 'selected' : '' }}>
                                            {{ $pCat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $dataArr['categoryArr']->name }}" required="">
                            </div>
                        </div>
                    </div>
                    <button class="submit-btn subbtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
