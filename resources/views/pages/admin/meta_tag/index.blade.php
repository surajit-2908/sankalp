@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">Meta Tag Management</h1>

    <div class="admin-body-area">

        <div class="booking-status-sec company-list-sec">
            <div class="category-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable table1">
                    <table class="table" id="bootstrap-data-table">

                        <thead>
                            <tr>
                                <th>Page Name</th>
                                <th>Meta Title</th>
                                <th>Meta Keywords</th>
                                <th>Meta Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataArr['metaTagArr'] as $metaTag)
                                <tr>
                                    <td title="Page Name">
                                        {{ $metaTag->page_name }}
                                    </td>
                                    <td title="Meta Title">
                                        {{ $metaTag->meta_title }}
                                    </td>
                                    <td title="Meta Keywords">
                                        {{ $metaTag->meta_keywords }}
                                    </td>
                                    <td title="Meta Description">
                                        {{ $metaTag->meta_description }}
                                    </td>
                                    <td title="Action">
                                        <a href="{{ route('admin.meta.tag.edit', $metaTag->id) }}" title="Edit">
                                            <i class="fa fa-edit listing"></i>
                                        </a>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
