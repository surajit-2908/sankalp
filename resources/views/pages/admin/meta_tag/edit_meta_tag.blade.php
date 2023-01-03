@extends('layouts.admin-dashboard')
@section('content')
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">Edit Meta Tag</h1>
        <a class="addNew" href="{{ route('admin.meta.tag') }}">Back</a>
    </div>
    <div class="admin-body-area">

        <div class="booking-status-sec order-list-sec">
            <div class="category-list-area">
                <form action="{{ route('admin.meta.tag.update', $dataArr['metaTagArr']->id) }}" method="POST"
                    id="category_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Page Name</label>
                                <input type="text" class="form-control" value="{{ $dataArr['metaTagArr']->page_name }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ $dataArr['metaTagArr']->meta_title }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords"
                                    value="{{ $dataArr['metaTagArr']->meta_keywords }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea type="text" class="form-control" name="meta_description" rows="5" required>{{ $dataArr['metaTagArr']->meta_description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button class="submit-btn subBtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
@stop
