@extends('layouts.layout')
@section('content')
    <!--========================== Body Right Panel Start ==========================-->
    <div class="bodyRightPanel homeBody">
        <div class="breadcrumbSec">
            <ul class="dFlx alignCenter">
                <li><a href="#">Product</a></li>
                <li>{{ $category->name }}</li>
            </ul>
        </div>

        <div class="homeTopHdnArea">
            <h1>{{ @$category->getPcat->name ? $category->getPcat->name : $category->name }}</h1>
            <p>Guided and custom solutions to help you reach your production goals.</p>
        </div>

        <div class="productListSec dFlx spaceBet">
            @forelse ($products as $product)
                <div class="productItem">
                    <img src="{{ asset('storage/product_image/') . '/' . $product->getImages[0]->image_name }}"
                        alt="">
                    <div class="productTitleOverlay">
                        <h2><a href="{{ route('product.details', $product->slug) }}">{{ $product->title }}</a></h2>
                        <ul class="dFlx alignCenter">
                            <li><a class="yellowBtn" href="{{ route('enquiry') }}">ENQUIRE</a></li>
                            <li>
                                <p>REQUEST <a href="tel:+914027840607">CALL BACK</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            @empty
                No products found
            @endforelse
        </div>

    </div>
    <!--========================== Body Right Panel Start ==========================-->
@stop
