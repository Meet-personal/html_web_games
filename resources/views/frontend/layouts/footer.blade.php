<!-- call to action section start -->
<!-- <div class="call-to-action pt-120 pb-120 bgn-4 overflow-x-hidden" id="cta">
    <div class="container">
        <div class="row justify-content-between g-6">
            <div class="col-lg-6">
                <span class="display-three tcn-1 cursor-scale growUp mb-8 d-block title-anim">Stay up to
                    date</span>
                <span class="fs-lg tcn-6">
                    Have questions or feedback? We'd love to hear from you. Reach out to our team or use our
                    contact
                    form.
                </span>
            </div>

            <div class="col-xl-5 col-lg-6">
                <form action="#">
                    <div class="single-input mb-6">
                        <input type="email" placeholder="Enter your email">
                    </div>
                    <div
                        class="d-flex align-items-md-center align-items-start justify-content-between gap-lg-8 gap-6 flex-md-row flex-column">
                        <div class="d-flex align-items-center gap-lg-4 gap-2">
                            <label class="custom-checkbox">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <span class="fs-base tcn-6">I agree with <a href="#" class="tcp-1">Privacy
                                    Policy</a>
                                and <a href="terms-condition.html" class="tcp-1">Terms & Conditions</a>
                            </span>
                        </div>
                        <button type="submit"
                            class="bttn py-sm-4 py-3 px-lg-10 px-sm-8 px-6 bgp-1 tcn-1 rounded-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
<!-- call to action section end -->
<!-- footer section start  -->
<footer class="footer bgn-4 bt">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-3 col-sm-6 br py-lg-20 pt-sm-15 pt-10 footer-card-area">
                <div class="py-lg-10">
                    <div class="footer-logo mb-8">
                        <a href="#" class="d-grid gap-6">
                            <div class="flogo-1">
                                <!-- <img class="w-100" src="{{ asset('/assets/frontend/images/logo2.png') }}" alt="favicon"> -->
                            </div>
                            <div class="flogo-2">
                                <img class="w-100 flogo" src="{{ asset('/assets/frontend/images/freewebsgames.webp') }}"
                                    alt="logo">
                            </div>
                        </a>
                    </div>
                    <div class="social-links">
                        <ul class="d-flex align-items-center gap-3 flex-wrap ul-text"style="color:white;">
                            <li>
                                <a target="_blank" href="{{ $settings['facebook'] }}"><i
                                        class="ti ti-brand-facebook fs-2xl"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ $settings['twitter'] }}"><i
                                        class="ti ti-brand-twitter fs-2xl"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ $settings['thread'] }}">
                                    <i class="fa-brands fa-threads fs-2xl"></i>
                                </a>
                            </li>

                            <li>
                                <a target="_blank" href="{{ $settings['instagram'] }}"><i
                                        class="ti ti-brand-instagram fs-2xl"></i></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 br br-res py-lg-20 pt-sm-15 pt-10 footer-card-area" style="color:white;">
                <div class="py-lg-10">
                    <h4 class="footer-title mb-8 title-anim text-1">Quick Links</h4>
                    <ul class="footer-list d-grid gap-4">
                        <li><a href="{{ route('frontend.homepage.index') }}"
                                class="footer-link d-flex align-items-center tcn-6 ">
                                <i class="ti ti-chevron-right"></i>Home</a></li>
                        <li><a href="{{ route('frontend.game') }}" class="footer-link d-flex align-items-center tcn-6">
                                <i class="ti ti-chevron-right "></i> Games </a></li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 br py-lg-20 pt-sm-15 pt-10 footer-card-area" style="color:white;">
                <div class="py-lg-10">
                    <h4 class="footer-title mb-8 title-anim text-1">Explore</h4>
                    <ul class="footer-list d-grid gap-4">
                        <li><a href="{{ route('frontend.game', ['is_trending' => '1']) }}"
                                class="footer-link d-flex align-items-center tcn-6"> <i class="ti ti-chevron-right"></i>
                                Top Games</a></li>
                        <li><a href="{{ route('frontend.category-game-list') }}"
                                class="footer-link d-flex align-items-center tcn-6"> <i
                                    class="ti ti-chevron-right"></i>Categories</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 py-lg-20 pt-sm-15 pt-10 footer-card-area" style="color:white;">
                <div class="py-lg-10">
                    <h4 class="footer-title mb-8 title-anim text-1">Follow Us</h4>
                    <ul class="footer-list d-grid gap-4">
                        <li><a href="{{ $settings['facebook'] }}" class="footer-link d-flex align-items-center tcn-6">
                                <i class="ti ti-chevron-right"></i> Facebook</a></li>
                        <li><a href="{{ $settings['twitter'] }}" class="footer-link d-flex align-items-center tcn-6">
                                <i class="ti ti-chevron-right"></i> Twitter</a></li>
                        <li><a href="{{ $settings['thread'] }}" class="footer-link d-flex align-items-center tcn-6"><i
                                    class="ti ti-chevron-right"></i> Thread</a></li>
                        <li><a href="{{ $settings['instagram'] }}" class="footer-link d-flex align-items-center tcn-6">
                                <i class="ti ti-chevron-right"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row pb-4 pt-lg-4 pt-8 m-0" style="color:white;">
            <div class="col-xxl-4 offset-xxl-3 col-lg-6 order-last order-lg-first">
                <span>Copyright © <span class="currentYear"></span> Free Webs Games | Designed by <a
                        href="{{ route('frontend.homepage.index') }}" class="tcp-1">Free Webs Games</a></span>
            </div>
            <div class="col-xxl-3 offset-md-1 col-lg-5">
                <ul class="d-flex align-items-center gap-lg-10 gap-sm-6 gap-4">
                    <!-- In your Blade view -->
                    @foreach (get_cms() as $cms)
                        <li><a href="{{ route('frontend.cms', ['slug' => $cms->slug]) }}">{{ $cms->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- footer banner img  -->
    <div class="footer-banner-img" id="faa">
        <img class="w-100 banner-img" src="{{ asset('/assets/frontend/images/fbanner.png') }}" alt="banner">
    </div>
</footer>
<!-- footer section end  -->
