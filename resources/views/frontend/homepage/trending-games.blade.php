{{-- <style>
    .tranding-game {
        padding: 15px;
        margin-right: 7px;

    }
</style> --}}
<section class="tournament-section ">
    <div class="tournament-wrapper alt">
        <div class="container-fluid tranding-game">
            @if ($trendingGames->count())
                <div class="row align-items-center justify-content-between mb-10 category-row">
                    <!-- <div class="col-12 col-md-6"> -->
                    <div class="col-6">
                        <h6 class="display-four tcn-1 cursor-scale growUp title-anim trending-text"
                            style=" font-family: 'Merriweather', serif;">Trending</h6>
                    </div>

                    <div class="col-6 text-end">
                        <div class="px-6">
                            <a href="{{ route('frontend.game', ['is_trending' => '1']) }}"
                                class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill">View
                                More</a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-start justify-content-center  g-6">
                    @foreach ($trendingGames as $trendingGame)
                        <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="tournament-card p-xl-4 p-3 pb-xl-8">
                                <div class="tournament-img mb-8 position-relative">
                                    <div class="img-area overflow-hidden">
                                        <a
                                            href="{{ route('frontend.game_detail_page', ['slug' => $trendingGame->slug]) }}">
                                            <img class="img-fluid" src="{{ asset('storage/' . $trendingGame->image) }}"
                                                alt="tournament">
                                        </a>
                                    </div>
                                </div>
                                <div class="tournament-content px-xxl-4">
                                    <div class="card-more-info d-between mt-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
