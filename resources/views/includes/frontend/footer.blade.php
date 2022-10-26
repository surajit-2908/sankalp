<div class="footer">
    <div class="container">
        <div class="footerRow">
            <div class="footerCol1">
                <img class="logo" alt="HeroFit" title="HeroFit"
                    src="{{ asset('assets/images/footer-logo.png') }}" />
                <p>Enter your email address to join our mailing list.</p>
                <div class="subsSec">
                    <form id="footer-form" action="javascript:void(0)">
                        <input class="formcontrol" placeholder="Email address" type="email" id="footer-email" />
                        <input type="button" id="submit-footer-form"/>
                        <input type="button" class="d-none"id="footer-form-loader"/>
                    </form>
                    <span class="text-danger d-none" id="footer-email-err">Please provide a valid email address</span>
                    <span class="text-success d-none" id="footer-email-suc">Successfully added to our mailing list</span>
                </div>
            </div>
            <div class="footerCol2">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Me</a></li>
                    <li><a href="{{ route('online.training') }}">Online Training</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('contact') }}">Contact Me</a></li>
                </ul>
            </div>
            <div class="footerCol2">
                <h4>Support</h4>
                <ul>
                    <li><a href="javascript:void(0)">FAQ</a></li>
                    <li><a href="javascript:void(0)">Support Center</a></li>
                    <li><a href="javascript:void(0)">News & Blog</a></li>
                </ul>
            </div>
            <div class="footerCol2 footerCol3">
                <h4>Partner</h4>
                <ul>
                    <li><a href="javascript:void(0)">Our Partner</a></li>
                    <li><a href="javascript:void(0)">Become a Partner</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="copyTextSec">
        <div class="container">
            <div class="flexSec">
                <p>
                    Copyright &copy; 2022 HeroFit. <span>|</span>
                    <a href="javascript:void(0)">Terms & Agreements</a> <span>|</span>
                    <a href="javascript:void(0)">Privacy Policy</a>
                </p>
                <ul>
                    <li>
                        <a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
