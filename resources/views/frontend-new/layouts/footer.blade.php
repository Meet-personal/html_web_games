        <!-- footer section start  -->
        <footer class="footer bgn-4 bt">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-3 col-sm-6 br py-lg-20 pt-sm-15 pt-10 footer-card-area">
                        <div class="py-lg-10">
                            <div class="footer-logo mb-8">
                                <a href="#" class="d-grid gap-6">
                                    {{-- <div class="flogo-1">
                                        <img class="w-100" src="{{ asset('/assets/frontend/images/freewebsgames.webp') }}" alt="favicon">
                                    </div> --}}
                                    <div class="flogo-2">
                                        <img class="w-100" src="{{ asset('/assets/frontend/images/freewebsgames.webp') }}" alt="logo">
                                    </div>
                                </a>
                            </div>
                            <div class="social-links">
                                <ul class="d-flex align-items-center gap-3 flex-wrap">
                                    <li>
                                        <a target="_blank" href="{{ $settings['facebook'] }}" ><i class="ti ti-brand-facebook fs-2xl"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ $settings['twitter'] }}" ><i class="ti ti-brand-twitter fs-2xl"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ $settings['thread'] }}" ><i class="ti ti-brand-threads fs-2xl"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ $settings['instagram'] }}" ><i class="ti ti-brand-instagram fs-2xl"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 br br-res py-lg-20 pt-sm-15 pt-10 footer-card-area">
                        <div class="py-lg-10">
                            <h4 class="footer-title mb-8 title-anim">Quick Links</h4>
                            <ul class="footer-list d-grid gap-4">
                                <li>
                                    <a href="{{ route('frontend.homepage.index') }}" class="footer-link d-flex align-items-center tcn-6">
                                        <i class="ti ti-chevron-right"></i> Home
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.game') }}" class="footer-link d-flex align-items-center tcn-6">
                                        <i class="ti ti-chevron-right"></i> Games
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 br py-lg-20 pt-sm-15 pt-10 footer-card-area">
                        <div class="py-lg-10">
                            <h4 class="footer-title mb-8 title-anim">Explore</h4>
                            <ul class="footer-list d-grid gap-4">
                                <li>
                                    <a href="{{ route('frontend.game', ['is_trending' => '1']) }}" class="footer-link d-flex align-items-center tcn-6">
                                        <i class="ti ti-chevron-right"></i> Top Games
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.category-game-list') }}" class="footer-link d-flex align-items-center tcn-6">
                                        <i  class="ti ti-chevron-right"></i> Categories
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-lg-20 pt-sm-15 pt-10 footer-card-area">
                        <div class="py-lg-10">
                            <h4 class="footer-title mb-8 title-anim">Follow Us</h4>
                            <ul class="footer-list d-grid gap-4">
                                <li><a href="{{ $settings['facebook'] }}" class="footer-link d-flex align-items-center tcn-6"> <i
                                            class="ti ti-chevron-right"></i> Facebook</a></li>
                                <li><a href="{{ $settings['instagram'] }}" class="footer-link d-flex align-items-center tcn-6"> <i
                                            class="ti ti-chevron-right"></i> Instagram</a></li>
                                <li><a href="{{ $settings['twitter'] }}" class="footer-link d-flex align-items-center tcn-6"> <i
                                            class="ti ti-chevron-right"></i> Twitter</a></li>
                                <li><a href="{{ $settings['thread'] }}" class="footer-link d-flex align-items-center tcn-6"> <i
                                            class="ti ti-chevron-right"></i> Thread</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row pb-4 pt-lg-4 pt-8">
                    <div class="col-xxl-4 offset-xxl-3 col-lg-6 order-last order-lg-first">
                        <span>Copyright © <span class="currentYear"></span> Free Webs Games | Designed by <a
                                href="{{ route('frontend.homepage.index') }}" class="tcp-1">Free Webs Games </a></span>
                    </div>
                    <div class="col-xxl-3 offset-md-1 col-lg-5">
                        <ul class="d-flex align-items-center gap-lg-10 gap-sm-6 gap-4">
                            @foreach (get_cms() as $cms)
                                <li>
                                    <a href="{{ route('frontend.cms', ['slug' => $cms->slug]) }}">{{ $cms->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- footer banner img  -->
            <div class="footer-banner-img" id="faa">
                <img class="w-100" src="{{ asset('frontend-new/img/fbanner.png') }}" alt="banner">
            </div>
        </footer>
        <!-- footer section end  -->
