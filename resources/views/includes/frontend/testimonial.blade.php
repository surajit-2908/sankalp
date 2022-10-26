@if (count($testimonialArr))
    <div class="testimonialSec">
        <div class="testimonialBgimg">
            <img alt="img" src="{{ asset('assets/images/testimonial-bg.png') }}" />
        </div>
        <div class="testimonialSecBg">
            <div class="container">
                <h2>What our customer says</h2>
                <div id="testimonial_scroller" class="owl-carousel">
                    @foreach ($testimonialArr as $testimonial)
                        <div class="item">
                            <div class="testiCon">
                                <img class="imgAuto" alt="icon" src="{{ asset('assets/images/quote.png') }}" />
                                <p>
                                    {!! $testimonial->comment !!}
                                </p>
                                <div class="autherSec">
                                    <div class="testiUserSec">
                                        <img alt="icon"
                                            src="{{ asset('storage/testimonial_image') . '/' . $testimonial->image }}" />
                                    </div>
                                    <div class="testiUserSectext">
                                        <h3>{{ $testimonial->name }}</h3>
                                        <p class="autherTitle">{{ $testimonial->designation }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
