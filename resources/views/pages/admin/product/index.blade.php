@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">Product Management</h1>
    <a class="addNew" href="{{ route('admin.product.add') }}"><i class="fa fa-plus"></i> Add New product</a>

    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">

            <div class="booking-status-sec order-list-sec">
                <div class="category-list-area" id="showFilter">

                    <!-- User List Area -->
                    <div class="datatable table1">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    {{-- <th>Available Quantity</th>
                                    <th>Product Price</th>
                                    <th>Selling Price</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody width="auto">
                                @foreach ($dataArr['productArr'] as $product)
                                    <tr>
                                        <td title="Title">
                                            {{ $product->title }}
                                        </td>
                                        <td title="Category">
                                            {{ $product->getCat->name }}
                                        </td>
                                        <td title="Sub Category">
                                            {{ @$product->getSubCat->name ? $product->getSubCat->name : '---' }}
                                        </td>
                                        {{-- <td title="Available Quantity">
                                            {{ $product->quantity }}
                                        </td>
                                        <td title="Product Price">
                                            ${{ number_format($product->selling_price, 2) }}
                                        </td>
                                        <td title="Selling Price">
                                            ${{ number_format($product->selling_offer_price, 2) }}
                                        </td> --}}
                                        <td title="Status">
                                            <a href="{{ route('admin.product.status', $product->id) }}"
                                                title="Change Status" class="status-confirm">
                                                @if ($product->status)
                                                    <i class="fa fa-check text-success"></i>
                                                    Active
                                                @else
                                                    <i class="fa fa-times text-danger"></i>
                                                    Inactive
                                                @endif
                                            </a>
                                        </td>
                                        <td title="Action">
                                            <a href="{{ route('admin.product.detail', $product->id) }}"
                                                title="Product Details">
                                                <i class="fa fa-eye views"></i>
                                            </a>
                                            <a href="{{ route('admin.product.edit', $product->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>
                                            <a href="{{ route('admin.product.remove', $product->id) }}" title="Delete"
                                                class="delete-confirm">
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
