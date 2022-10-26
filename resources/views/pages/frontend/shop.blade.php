@extends('layouts.layout')
@section('content')
    <div class="shopPagemain">
        <div class="container">
            <div class="breadcamp">
                Home > Shop {{ $top_link }}
            </div>
            <h2 class="titleText">Shop our collections</h2>
            <p>Etiam non auctor velit. In egestas cursus erat, nec placerat eros dapibus non.
                Pellentesque <span></span>ullamcorper eu orci eu interdum.</p>

            <div class="shopMain">
                <div class="sleftCol">
                    <h3>Product caregories</h3>
                    <ul id="accordion" class="accordion">

                        <li @if (@!$filter_cat) class="active" @endif
                            onclick="window.location='{{ route('shop') }}'">
                            <div class="link">All Items</div>
                        </li>
                        @foreach ($categoryArr as $category)
                            @if (!count($category->getSubcat))
                                <li @if (@$filter_cat->id == $category->id) class="active" @endif
                                    onclick="window.location='{{ route('shop', $category->slug) }}'">
                                    <div class="link">{{ $category->name }}</div>
                                </li>
                            @else
                                <li>
                                    <div class="link">{{ $category->name }}<i class="fa fa-chevron-down"></i>
                                    </div>
                                    <ul class="submenu" @if (@$filter_cat->parent_id == $category->id) style="display: block;" @endif>
                                        @foreach ($category->getSubcat as $subCat)
                                            <li @if (@$filter_cat->id == $subCat->id) class="active" @endif><a
                                                    href="{{ route('shop', $subCat->slug) }}">{{ $subCat->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach

                    </ul>

                </div>
                <div class="srightCol">
                    <ul>
                        @forelse ($productArr as $product)
                            @php
                                $ratingCount = ratingCal($product->id)['ratingCount'];
                                if ($ratingCount) {
                                    $ratingCountStr = $ratingCount . ($ratingCount > 1 ? ' reviews' : ' review');
                                } else {
                                    $ratingCountStr = '';
                                }
                                $avgRating = round(ratingCal($product->id)['avgRating']);
                                $empty_star = 5 - round(ratingCal($product->id)['avgRating']);
                            @endphp
                            <li onclick="window.location='{{ route('product.detail', $product->slug) }}'">
                                <div class="shopImg"><img alt="icon"
                                        src="{{ asset('storage/product_image') . '/' . $product->image }}" /></div>
                                <div class="dFlex reviewsSec">
                                    <ul>
                                        @if ($avgRating)
                                            @for ($i = 0; $i < $avgRating; $i++)
                                                <li class="active"><i class="fa fa-star"></i></li>
                                            @endfor
                                            @for ($i = 0; $i < $empty_star; $i++)
                                                <li><i class="fa fa-star"></i></li>
                                            @endfor
                                        @endif
                                    </ul>
                                    <p>{{ $avgRating ? $ratingCountStr : @$product->getBrand->name }}</p>
                                </div>
                                <h3>{{ $product->title }}</h3>
                                <p class="price">${{ number_format($product->selling_offer_price, 2) }} /
                                    <del>${{ number_format($product->selling_price, 2) }}</del>
                                </p>
                            </li>
                        @empty
                            <div class="noPro">No Product Available</div>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="pagignation">
                {{ $productArr->appends(request()->input())->render('vendor.pagination.default') }}
            </div>

        </div>
    </div>
@stop
