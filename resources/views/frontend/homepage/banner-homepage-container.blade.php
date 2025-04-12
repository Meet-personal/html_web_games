
<!-- ----------------------------start banner image-------------------------------------------------------- -->
<section class="banner-section pb-10 pt-lg-20 pt-sm-5 pb-5">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-xxl-12">
                <div class="swiper banner-swiper position-relative">
                    <div class="banner-swiper-pagination"></div>
                    <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                            <div class="swiper-slide overflow-hidden">
                                <div class="banner-content pt-lg-0 pt-6">
                                    <div
                                        class="row justify-content-lg-between justify-content-center gy-6 align-items-center">
                                        <div class="col-1"></div>
                                        <div class="col-lg-6 col-md-8 col-11">
                                            <div class="hero-content">
                                                <ul class="d-flex gap-3 fs-2xl fw-semibold heading-font mb-5 list-icon">
                                                    <li>Play</li>
                                                    <li>Earn</li>
                                                    <li>Enjoy</li>
                                                </ul>
                                                <h3
                                                    class="hero-title display-two tcn-1 cursor-scale growUp mb-lg-10 mb-sm-8 mb-6 banner-title">
                                                    {{ $banner->title }}
                                                </h3>
                                                <div
                                                    class="d-flex align-items-center flex-wrap gap-xl-6 gap-3 button-game">
                                                    @if ($banner->game_id !== null && isset($banner->game))
                                                        <a href="{{ route('frontend.game_detail_page', ['slug' => $banner->game->slug]) }}"
                                                            class="btn-half-border position-relative d-inline-block py-2 px-6 bgp-1 rounded-pill">Play
                                                            Now</a>
                                                    @elseif($banner->category_id !== null && isset($banner->category))
                                                        <a href="{{ route('frontend.category-true-game', ['id' => $banner->category->id]) }}"
                                                            class="btn-half-border position-relative d-inline-block py-2 px-6 bgp-1 rounded-pill">
                                                            Play Now</a>
                                                    @else
                                                        @if ($banner->url)
                                                            <a href="{{ $banner->url }}" target="_blank"
                                                                class="btn-half-border position-relative d-inline-block py-2 px-6 bgp-1 rounded-pill">Play
                                                                Now</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12  banner-img-swipe">
                                            <div class="banner-inner-img banner-img">
                                                <img class="w-100 h-100" src="{{ asset('storage/' . $banner->image) }}"
                                                    alt="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- ----------------------------------second section start------------------------------------------- -->
