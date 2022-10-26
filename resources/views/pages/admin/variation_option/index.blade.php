@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec variation-list-sec">
            <div class="category-list-hdn">
                <h2>Variation Option Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.variation.option.add') }}">Add new variation Option</a>
                </h3>
            </div>

            <div class="variation-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Variation Option Name</th>
                                    <th>Variation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['VariationOptionArr'] as $variationOpt)
                                    <tr>
                                        <td title="Variation Option">
                                            {{ $variationOpt->name }}
                                        </td>
                                        <td title="Variation">
                                            {{ @$variationOpt->getVariation->name ? $variationOpt->getVariation->name : '---' }}
                                        </td>
                                        <td title="Action">
                                            <a href="{{ route('admin.variation.option.edit', $variationOpt->id) }}"
                                                title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>
                                            <a href="{{ route('admin.variation.option.remove', $variationOpt->id) }}"
                                                title="Delete" class="delete-confirm">
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
