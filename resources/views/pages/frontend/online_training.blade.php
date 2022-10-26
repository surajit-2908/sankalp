@extends('layouts.layout')
@section('content')

    <div class="shopPagemain pb-50">
        <div class="container">
            <div class="breadcamp">
                Home > Online Training
            </div>
        </div>


        @php
            $i = 1;
        @endphp
        @foreach ($onlineTrainingArr as $onlineTraining)
            @php
                $ratingCount = onlineTrainingRatingCal($onlineTraining->id)['ratingCount'];
                if ($ratingCount) {
                    $ratingCountStr = $ratingCount . ($ratingCount > 1 ? ' reviews' : ' review');
                } else {
                    $ratingCountStr = '';
                }
                $avgRating = round(onlineTrainingRatingCal($onlineTraining->id)['avgRating']);
                $empty_star = 5 - round(onlineTrainingRatingCal($onlineTraining->id)['avgRating']);
            @endphp
            @if ($i)
                <div class="container">
                    <div class="onlineMain">
                        <div class="onlineMainCol">
                            <div class="guideImgsec">
                                <img alt="guide" title="guide"
                                    src="{{ asset('storage/online_training_file') . '/' . $onlineTraining->image }}" />
                                <div class="guideCaption">
                                    <h2>{{ $onlineTraining->title }}</h2>
                                </div>
                            </div>

                        </div>
                        <div class="onlineMainCol">
                            @if ($avgRating)
                                <div class="reviewsSec">
                                    <ul>
                                        @for ($i = 0; $i < $avgRating; $i++)
                                            <li class="active"><i class="fa fa-star"></i></li>
                                        @endfor
                                        @for ($i = 0; $i < $empty_star; $i++)
                                            <li><i class="fa fa-star"></i></li>
                                        @endfor
                                    </ul>
                                    <p>{{ $avgRating ? $ratingCountStr : @$product->getBrand->name }}</p>
                                </div>
                            @endif
                            <h2>{{ $onlineTraining->title }}</h2>
                            <p class="supPtext">{{ $onlineTraining->sub_title }}</p>
                            <div class="durationSec">
                                <p><i class="fa fa-clock-o"></i> Duration : <span>{{ $onlineTraining->hours }} hrs</span>
                                </p>
                            </div>
                            <p class="greyPtext">{{ $onlineTraining->description }}</p>
                            <p class="price"><del>${{ number_format($onlineTraining->price, 2) }} /</del>
                                ${{ number_format($onlineTraining->selling_price, 2) }}</p>
                            @auth
                                <a class="shopBtn submitBtn" href="javascript:void(0)"
                                    data-id="{{ $onlineTraining->id }}">Purchase</a>
                            @else
                                <a class="shopBtn" href="{{ route('user.login', 'online-training') }}">Purchase</a>
                            @endauth

                        </div>
                    </div>
                </div>
            @else
                <div class="heroSec">
                    <div class="heroSecBg">
                        <div class="heroSecImg"><img alt="img"
                                src="{{ asset('storage/online_training_file') . '/' . $onlineTraining->image }}">
                        </div>
                        <div class="heroTextSec">
                            <div class="container">
                                <div class="heroTextcols onlineVideoText">
                                    <div>
                                        @if ($avgRating)
                                            <div class="reviewsSec">
                                                <ul>
                                                    @for ($i = 0; $i < $avgRating; $i++)
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                    @endfor
                                                    @for ($i = 0; $i < $empty_star; $i++)
                                                        <li><i class="fa fa-star"></i></li>
                                                    @endfor
                                                </ul>
                                                <p>{{ $avgRating ? $ratingCountStr : @$product->getBrand->name }}</p>
                                            </div>
                                        @endif
                                        <h2>{{ $onlineTraining->title }}</h2>
                                        <p class="supPtext">{{ $onlineTraining->sub_title }}</p>
                                        <div class="durationSec">
                                            <p><i class="fa fa-clock-o"></i> Duration :
                                                <span>{{ $onlineTraining->hours }} hrs</span>
                                            </p>
                                        </div>
                                        <p class="elpText">{{ $onlineTraining->description }}</p>
                                        <p class="price">
                                            <del>${{ number_format($onlineTraining->price, 2) }} /</del>
                                            ${{ number_format($onlineTraining->selling_price, 2) }}
                                        </p>
                                        @auth
                                            <a class="shopBtn submitBtn" href="javascript:void(0)"
                                                data-id="{{ $onlineTraining->id }}">YES! I want TO BUY</a>
                                        @else
                                            <a class="shopBtn" href="{{ route('user.login', 'online-training') }}">YES! I want
                                                TO BUY</a>
                                        @endauth
                                    </div>
                                    @if ($onlineTraining->video)
                                        <div class="playIconCol"
                                            data-video="{{ asset('storage/online_training_file') . '/' . $onlineTraining->video }}">
                                            <img alt="img" src="{{ asset('assets/images/play-icon-big.png') }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @php
                if ($i == 2) {
                    $i = 0;
                } else {
                    $i++;
                }
            @endphp
        @endforeach


    </div>

    <div class="whiteBg">

        <div class="includedSec ">
            <div class="container">
                <h2>WHAT'S INCLUDED</h2>
                <ul>
                    <li>
                        <div class="iconCol"><img alt="icon" src="{{ asset('assets/images/included-icon1.png') }}" />
                        </div>
                        <p>Download and access on any<span></span>
                            smart device</p>
                    </li>
                    <li>
                        <div class="iconCol"><img alt="icon" src="{{ asset('assets/images/included-icon2.png') }}" />
                        </div>
                        <p>Exercise video demonstrations</p>
                    </li>
                    <li>
                        <div class="iconCol"><img alt="icon" src="{{ asset('assets/images/included-icon3.png') }}" />
                        </div>
                        <p>Detailed exercise plan designed</p>
                    </li>
                    <li>
                        <div class="iconCol"><img alt="icon" src="{{ asset('assets/images/included-icon4.png') }}" />
                        </div>
                        <p>80 pages packed with info</p>
                    </li>
                    <li>
                        <div class="iconCol"><img alt="icon" src="{{ asset('assets/images/included-icon5.png') }}" />
                        </div>
                        <p>Key exercises, rep ranges, <span></span>
                            number of sets</p>
                    </li>
                    <li>
                        <div class="iconCol"><img alt="icon" src="{{ asset('assets/images/included-icon6.png') }}" />
                        </div>
                        <p>Annotated diagrams of muscle<span></span>
                            anatomy</p>
                    </li>
                    <li>
                        <div class="iconCol"><img alt="icon" src="{{ asset('assets/images/included-icon7.png') }}" />
                        </div>
                        <p>Essential tips and tricks to<span></span>
                            build abs</p>
                    </li>
                    <li>
                        <div class="iconCol"><img alt="icon" src="{{ asset('assets/images/included-icon8.png') }}" />
                        </div>
                        <p>Essential nutrition guidelines</p>
                    </li>
                </ul>
            </div>
        </div>


    </div>


    <div class="shapeSec">
        <div class="container">
            <h2>GET IN THE BEST SHAPE OF <span></span>
                YOUR LIFE</h2>

            <div class="dFlex">
                @foreach ($onlineTrainingBtmArr as $onlineTrainingBtm)
                    @php
                        $ratingCount = onlineTrainingRatingCal($onlineTrainingBtm->id)['ratingCount'];
                        if ($ratingCount) {
                            $ratingCountStr = $ratingCount . ($ratingCount > 1 ? ' reviews' : ' review');
                        } else {
                            $ratingCountStr = '';
                        }
                        $avgRating = round(onlineTrainingRatingCal($onlineTrainingBtm->id)['avgRating']);
                        $empty_star = 5 - round(onlineTrainingRatingCal($onlineTrainingBtm->id)['avgRating']);
                    @endphp
                    <div class="shapeCol">
                        <img alt="img"
                            src="{{ asset('storage/online_training_file') . '/' . $onlineTrainingBtm->image }}" />
                        <div class="reviewsSec">
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
                        <h3>{{ $onlineTrainingBtm->title }}</h3>
                        <p class="supPtext">{{ $onlineTrainingBtm->sub_title }}</p>
                        <div class="durationSec">
                            <p><i class="fa fa-clock-o"></i> Duration :
                                <span>{{ $onlineTrainingBtm->hours }} hrs</span>
                            </p>
                        </div>
                        <p class="greyPtext elpText">{{ $onlineTrainingBtm->description }}</p>
                        <p class="price">
                            <del>${{ number_format($onlineTrainingBtm->price, 2) }} /</del>
                            ${{ number_format($onlineTrainingBtm->selling_price, 2) }}
                        </p>
                        @auth
                            <a class="shopBtn submitBtn mt40" href="javascript:void(0)"
                                data-id="{{ $onlineTrainingBtm->id }}">Purchase</a>
                        @else
                            <a class="shopBtn" href="{{ route('user.login', 'online-training') }}">Purchase</a>
                        @endauth
                    </div>
                @endforeach
            </div>

        </div>
    </div>


@stop
@push('modal')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog onTraingPop" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fill your details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('online.training.payment') }}" method="post" id="myform">
                        {{ csrf_field() }}
                        <input type="hidden" name="online_training_id" id="online_training_id" />
                        <div class="formGroup">
                            <input class="formcontrol" placeholder="Name" type="text" name="name" required />
                        </div>
                        <div class="formGroup">
                            <input class="formcontrol" placeholder="Email Address" type="text" name="email"
                                required />
                        </div>
                        <div class="formGroup">
                            <input class="formcontrol" placeholder="Contact Number" type="text" name="phone"
                                required />
                        </div>
                        <div class="formGroup">
                            <input class="formcontrol" placeholder="Location" type="text" name="address" required />
                        </div>
                        <div class="formGroup">
                            <textarea class="textArea" placeholder="Your message here..." name="msg" required></textarea>
                        </div>
                        <div class="formGroup">
                            <input value="Continue" type="submit" />
                        </div>
                        <div class="formGroup">
                            <p><a data-dismiss="modal" href="javascript:void(0)">No thanks, not for me.</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('modal')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog onTraingPop" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding:10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="videoSrc">
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        $("#myform").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 11
                },
                address: {
                    required: true
                },
                msg: {
                    required: true
                },
            },
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address",
                phone: {
                    required: "Please enter your mobile number",
                    number: "Please enter a valid mobile number",
                    minlength: "Please enter a valid mobile number",
                    maxlength: "Please enter a valid mobile number",
                },
                address: "Please enter your address",
                msg: "Please enter your message",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".submitBtn").click(function() {
                $('#online_training_id').val($(this).data('id'));
                $('#exampleModal').modal('toggle');
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".playIconCol").click(function() {
                var video_html = '<video width="400" height="300" controls><source src="' + $(this).data(
                    'video') + '"></video>';
                $('#videoSrc').append(video_html);
                $('#myModal').modal('toggle');
            })
            $("#myModal").on('hidden.bs.modal', function(e) {
                $('#videoSrc').html('');
            });
        })
    </script>
@endpush
