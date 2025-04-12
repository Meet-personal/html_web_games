@extends('frontend-new.layouts.main')
@section('body')
    @include('frontend-new.common.banner')
    <style>
        @media (max-width: 767px) {
            .new-arrival img {
                width: 290px !important;
                height: 400px !important;
            }

            .slide-card {
                height: 200px !important;
            }
        }

        .new-arrival img {
            /* width: 250px; */
            height: 400px;
        }

        /* .swiper-wrapper .swiper-slide .tournament-card:hover {
            border-radius: 20px !important;
            border: none !important;
        } */

        .game-section .tournament-section .tournament-wrapper {
            border-radius: 15px !important;
        }

        .slide-card {
            height: 124.63px;
        }
    </style>
    @if (count($trendingGames) > 0)
        <!-- Trending section start -->
        <section class="tournament-section pb-5">
            <div class="tournament-wrapper alt">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-between mb-3">
                        <div class="col-6">
                            <h2 class="display-four tcn-1 cursor-scale growUp title-anim">Trendings </h2>
                        </div>
                        <div class="col-6 text-end">
                            <div class="">
                                <a href="{{ route('frontend.game', ['is_trending' => '1']) }}"
                                    class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill">View
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <div class="singletab tournaments-tab">
                        <div class="tabcontents">
                            <div class="tabitem active">
                                <div class="row justify-content-md-start justify-content-center  g-6">
                                    @foreach ($trendingGames as $trendingGame)
                                        <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">
                                            <div class="tournament-card p-3 bgn-4">
                                                <div class="tournament-img position-relative trending_game_detail_page"
                                                    data-url="{{ route('frontend.game_detail_page', ['slug' => $trendingGame->slug]) }}">
                                                    <div class="img-area overflow-hidden">
                                                        <img class="w-100"
                                                            src="{{ asset('storage/' . $trendingGame->image) }}"
                                                            alt="tournament">
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
            </div>
        </section>
        <!-- Trending section end -->
    @endif

    @if (count($carouselGameSliders) > 0)
        <!-- game section start  -->
        <section class="game-section pb-5 pt-120">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-6">
                        <h2 class="display-four tcn-1 cursor-scale growUp title-anim">New Arrival </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="swiper game-swiper2 tournament-section">
                            <div class="swiper-wrapper mb-lg-15 mb-3">
                                @foreach ($carouselGameSliders as $carouselGameSlider)
                                    <div class="swiper-slide tournament-wrapper">
                                        <div class="tournament-card bgn-4">
                                            <div class="tournament-img position-relative trending_game_detail_page"
                                                data-url="{{ route('frontend.game_detail_page', ['slug' => $carouselGameSlider->slug]) }}">
                                                <div class="img-area">
                                                    <img class="w-100 slide-card"
                                                        src="{{ asset('storage/' . $carouselGameSlider->image) }}"
                                                        alt="tournament">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center d-center">
                                <div class="game-swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- game section end  -->
    @endif

    @if (count($categoriesGames) > 0)
        @foreach ($categoriesGames as $categoryGame)
            <section class="tournament-section pb-5">
                <div class="tournament-wrapper alt">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-6">
                                <h2 class="display-four tcn-1 cursor-scale growUp title-anim">{{ $categoryGame->title }}
                                </h2>
                            </div>
                            <div class="col-6 text-end">
                                <div class="">
                                    <a href="{{ route('frontend.game', ['category' => $categoryGame->slug]) }}"
                                        class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="singletab tournaments-tab">
                            <div class="tabcontents">
                                <div class="tabitem active">
                                    <div class="row justify-content-md-start justify-content-center  g-6">
                                        @foreach ($categoryGame->games as $homepageGame)
                                            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">
                                                <div class="tournament-card p-3 bgn-4">
                                                    <div class="tournament-img position-relative trending_game_detail_page"
                                                        data-url="{{ route('frontend.game_detail_page', ['slug' => $homepageGame->slug]) }}">
                                                        <div class="img-area overflow-hidden">
                                                            <img class="w-100"
                                                                src="{{ asset('storage/' . $homepageGame->image) }}"
                                                                alt="tournament">
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
                </div>
            </section>
        @endforeach
    @endif

@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const trendingGameElements = document.querySelectorAll(".trending_game_detail_page");

            trendingGameElements.forEach(element => {
                element.addEventListener("click", function() {
                    const url = this.getAttribute("data-url");
                    if (url) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endpush
