<section class="headerSec">
    <div class="container-fluid">
        <div class="dFlx spaceBet alignCenter">
            <div class="hdrLogo">
                <a href="{{ route('enquiry') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="" /></a>
            </div>
            <div class="hdrRightPrt">
                <ul class="dFlx alignCenter">
                    <li>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#headerSearchModal"><img
                                src="{{ asset('assets/images/search-icon.png') }}" alt="" /></a>
                    </li>
                    <li><a class="hdrLightBtn" href="javascript:void(0)" data-toggle="modal" data-target="#order_track_modal">Track</a></li>
                    <li><a class="hdrYellowBtn" href="{{ route('enquiry') }}">Enquire</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
