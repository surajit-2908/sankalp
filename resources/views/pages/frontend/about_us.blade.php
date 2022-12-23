@extends('layouts.layout')
@section('content')
    <!--========================== Body Right Panel Start ==========================-->
    <div class="bodyRightPanel homeBody">
        <div class="breadcrumbSec">
            <ul class="dFlx alignCenter">
                <li><a href="#">Support</a></li>
                <li>About Us</li>
            </ul>
        </div>

        <div class="homeTopHdnArea">
            <h1>About Us</h1>
            <p class="pb20">Sankalp Corporation, often known as the "House of Process Filters," was
                founded in Hyderabad, Andhra Pradesh, India, in 1991. We are producers
                and providers of machinery and accessories for the industrial, pharmaceutical,
                and chemical industries. </p>
            <p class="pb20">Our business is managed by trained technocrats experienced in food, chemical,
                brewing, aquaculture, mineral water, oil, pesticide, and pharmaceutical
                industries.</p>
            <p>For over 30 years, Sankalp Corporation has delivered world class performance
                to the most demanding of environments, and industries including:</p>
        </div>

        <form class="contactFormArea dFlx spaceBet SKPformField">
            <div class="contactFormLeftClm">
                <ul class="aboutList">
                    <li>Aerospace and Defense</li>
                    <li>food and beverage</li>
                    <li>Gasification</li>
                    <li>Nuclear</li>
                    <li>OEM</li>
                    <li>Oil and petrochemicals</li>
                    <li>Pharmaceutical</li>
                    <li>Printing</li>
                    <li>Process.</li>
                </ul>
                <p class="pt20">Our commitment to technical excellence and top-notch customer service is the
                    foundation of our ongoing success. Our continued investment in new products
                    and R&D enables us to deliver cutting-edge new products that surpass our
                    customers' expectations.</p>
            </div>

            <div class="contactFormRightClm">
                <img src="{{ asset('assets/images/about-img.jpg') }}" alt="">
            </div>
        </form>

    </div>
    <!--========================== Body Right Panel Start ==========================-->
@stop
