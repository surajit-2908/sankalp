@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec variation-list-sec">
            <div class="category-list-hdn">
                <h2>Add Variation</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.variation') }}">Back</a>
                </h3>
            </div>


            <div class="variation-list-area">
                <form action="{{ route('admin.variation.insert') }}" method="POST" id="variation_form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        {{-- <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Category <small class="text-danger">*Select to add sub-variation</small>
                                </label>
                                <select class="form-control" name="category_id" required="">
                                    <option value="0">Select Category</option>
                                    @foreach ($dataArr['parentCategoryArr'] as $pCat)
                                        <option value="{{ $pCat->id }}">{{ $pCat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required="">
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
