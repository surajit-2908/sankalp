@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec variation-list-sec">
            <div class="category-list-hdn">
                <h2>Variation Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.variation.add') }}">Add new variation</a>
                </h3>
            </div>

            <div class="variation-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Variation Name</th>
                                    {{-- <th>Category</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['variationArr'] as $variation)
                                    <tr>
                                        <td title="Variation Name">
                                            {{ $variation->name }}
                                        </td>
                                        {{-- <td title="Category">
                                            {{ @$variation->getCat->name ? $variation->getCat->name : '---' }}
                                        </td> --}}
                                        <td title="Action">
                                            <a href="{{ route('admin.variation.edit', $variation->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>
                                            <a href="{{ route('admin.variation.remove', $variation->id) }}" title="Delete"
                                                class="multi-delete-confirm">
                                                <i class="fa fa-trash chat"></i>
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

    </div>
    <!-- Booking Status Section Start -->
@stop
