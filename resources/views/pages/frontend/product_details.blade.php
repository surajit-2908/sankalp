@extends('layouts.layout')
@section('content')
    <!--========================== Body Right Panel Start ==========================-->
    <div class="bodyRightPanel homeBody">
        <div class="breadcrumbSec">
            <ul class="dFlx alignCenter">
                <li><a href="javascript:void(0)">Product</a></li>
                <li>{{ @$productDetail->getSubCat ? $productDetail->getSubCat->name : $productDetail->getCat->name }}</li>
            </ul>
        </div>



        <div class="prodetailsSec">
            <div class="prodetailsSec-left">
                <img id="zoom_01"
                    src="{{ asset('storage/product_image/') . '/' . $productDetail->getImages[0]->image_name }}"
                    width="400" />
                <div class="proFitureNav">
                    <ul>
                        <li><a data-toggle="modal" data-target="#largeModal" href="javascript:void(0)"><i
                                    class="fa fa-camera"></i>
                                Product Gallery</a> </li>
                        <li><a data-toggle="modal" data-target="#enquirylargeModal" href="{{ route('enquiry') }}"><i
                                    class="fa fa-envelope"></i> Enquiry</a> </li>
                        <li><a href="#youtubeVideo"><i class="fa fa-video-camera"></i> Video</a> </li>
                        <li><a href="{{ asset('storage/brochure/') . '/' . $productDetail->brochure }}" target="_blank"><i
                                    class="fa fa-download"></i> Brochure</a> </li>
                    </ul>
                </div>
            </div>
            <div class="prodetailsSec-right">
                <h1>{{ $productDetail->title }}</h1>
                <p>{!! $productDetail->description !!}</p>
                <a class="hdrYellowBtn" href="{{ route('enquiry') }}"><i class="fa fa-envelope-o"></i> Enquire Now</a>
                <a class="hdrYellowBtn" href="tel:+914027840607"><i class="fa fa-phone"></i> Call Us Now</a>
                <div class="operationSec">
                    <h2>Operation</h2>
                    <p>{!! $productDetail->operation !!}</p>
                </div>
            </div>
        </div>

        <div class="proFitureTabSec">
            <div class="container">
                <ul id="tabs" class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-1" class="nav-link active" data-toggle="tab" role="tab">Features &
                            Benefits</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-2" class="nav-link" data-toggle="tab" role="tab">Special
                            Options</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-C" href="#pane-3" class="nav-link" data-toggle="tab" role="tab">Technical
                            Specifications</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-C" href="#pane-4" class="nav-link" data-toggle="tab" role="tab">Applications</a>
                    </li>
                </ul>


                <div id="content" class="tab-content" role="tablist">
                    <div id="pane-1" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <!-- Note: `data-parent` removed from here -->
                                <a data-toggle="collapse" href="#collapse-A" aria-expanded="true"
                                    aria-controls="collapse-A">
                                    Features & Benefits
                                </a>
                            </h5>
                        </div>

                        <!-- Note: New place of `data-parent` -->
                        <div id="collapse-A" class="collapse show" data-parent="#content" role="tabpanel"
                            aria-labelledby="heading-A">
                            <div class="card-body">
                                {!! $productDetail->features !!}
                            </div>
                        </div>
                    </div>

                    <div id="pane-2" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                    aria-controls="collapse-B">
                                    Special Options
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel"
                            aria-labelledby="heading-B">
                            <div class="card-body">
                                {!! $productDetail->special_options !!}
                            </div>
                        </div>
                    </div>

                    <div id="pane-3" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
                        <div class="card-header" role="tab" id="heading-C">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false"
                                    aria-controls="collapse-C">
                                    Technical Specifications
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-C" class="collapse" role="tabpanel" data-parent="#content"
                            aria-labelledby="heading-C">
                            <div class="card-body">
                                {!! $productDetail->technical_specifications !!}
                            </div>
                        </div>
                    </div>

                    <div id="pane-4" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
                        <div class="card-header" role="tab" id="heading-D">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-D" aria-expanded="false"
                                    aria-controls="collapse-D">
                                    Applications
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-D" class="collapse" role="tabpanel" data-parent="#content"
                            aria-labelledby="heading-C">
                            <div class="card-body">
                                <p>{!! $productDetail->applications !!}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="youtubeVideo">
            <iframe style="border:none;" width="100%" height="500" src="https://www.youtube.com/embed/{{ $productDetail->youtube_link }}">
            </iframe>
        </div>
    </div>
    <!--========================== Body Right Panel Start ==========================-->


    <!-- Product Gallery Modal -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- carousel -->
                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                        <ol class='carousel-indicators'>
                            @foreach ($productDetail->getImages as $key => $img)
                                <li data-target='#carouselExampleIndicators' data-slide-to='{{ $key }}'
                                    @if ($key === 0) class='active' @endif></li>
                            @endforeach
                        </ol>
                        <div class='carousel-inner'>
                            @foreach ($productDetail->getImages as $key => $img)
                                <div class='carousel-item {{ $key === 0 ? 'active' : '' }}'>
                                    <img class='img-size'
                                        src='{{ asset('storage/product_image/') . '/' . $img->image_name }}'
                                        alt='{{ $key }} slide' />
                                </div>
                            @endforeach
                        </div>
                        <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button'
                            data-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Previous</span>
                        </a>
                        <a class='carousel-control-next' href='#carouselExampleIndicators' role='button'
                            data-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Next</span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop
@push('scripts')
    <!-- EZ Zoom js -->
    <script src='{{ asset('assets/js/jquery.ez-plus.js') }}'></script>
    <script>
        $("#zoom_01").ezPlus();
    </script>
@endpush
