@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Product Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.product.add') }}">Add new product</a>
                </h3>
            </div>

            <div class="category-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    {{-- <th>Banner Image</th> --}}
                                    <th>Title</th>
                                    {{-- <th>Brand</th> --}}
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Available Quantity</th>
                                    <th>Product Price</th>
                                    <th>Selling Price</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody width="auto">
                                @foreach ($dataArr['productArr'] as $product)
                                    <tr>
                                        {{-- <td title="Banner Image">
                                            <img src="{{ asset('storage/product_image') . '/' . $product->image }}"
                                                alt="" class="bnr-img">
                                        </td> --}}
                                        <td title="Title">
                                            {{ $product->title }}
                                        </td>
                                        {{-- <td title="Brand">
                                            {{ @$product->getBrand->name }}
                                        </td> --}}
                                        <td title="Category">
                                            {{ $product->getCat->name }}
                                        </td>
                                        <td title="Sub Category">
                                            {{ @$product->getSubCat->name ? $product->getSubCat->name : '---' }}
                                        </td>
                                        <td title="Available Quantity">
                                            {{ $product->quantity }}
                                        </td>
                                        <td title="Product Price">
                                            ${{ number_format($product->selling_price, 2) }}
                                        </td>
                                        <td title="Selling Price">
                                            ${{ number_format($product->selling_offer_price, 2) }}
                                        </td>
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
                                        <td title="Featured Status">
                                            <a href="{{ route('admin.product.featured.status', $product->id) }}"
                                                title="Change Featured Status" class="status-confirm">
                                                @if ($product->featured)
                                                    <i class="fa fa-check text-success"></i>
                                                    Active
                                                @else
                                                    <i class="fa fa-times text-danger"></i>
                                                    Inactive
                                                @endif
                                            </a>
                                        </td>
                                        <td title="Action">
                                            <div class="doted-dropdown">
                                                <p>...</p>
                                                <div class="doted-dropdown-content">
                                                    <a href="{{ route('admin.product.faq', $product->id) }}"
                                                        title="Manage FAQ">
                                                        <i class="fa fa-comments listing"></i>
                                                    </a>
                                                    <a href="{{ route('admin.product.variant', $product->id) }}"
                                                        title="Manage Variants">
                                                        <i class="fa fa-adjust views"></i>
                                                    </a>

                                                    <a href="{{ route('admin.product.detail', $product->id) }}"
                                                        title="Product Details">
                                                        <i class="fa fa-eye views"></i>
                                                    </a>
                                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                                        title="Edit">
                                                        <i class="fa fa-edit listing"></i>
                                                    </a>
                                                    <a href="{{ route('admin.product.remove', $product->id) }}"
                                                        title="Delete" class="delete-confirm">
                                                        <i class="fa fa-trash chat"></i>
                                                    </a>
                                                </div>
                                            </div>
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
