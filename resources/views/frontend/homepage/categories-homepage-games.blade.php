<style>
    .category-game {
        padding: 15px;
        position: relative;
        /* left: 15px; */
    }
</style>
<section class="tournament-section pb-5">
    <div class="tournament-wrapper alt">
        <div class="container-fluid category-game">
            @foreach ($categoriesGames as $categoryGame)
                @if (count($categoryGame->games) > 0)
                    <div class="row align-items-center justify-content-between mb-5 ">
                        <div class="col-6">
                            <h2 class="display-four tcn-1 cursor-scale growUp title-anim category"
                                style=" font-family: 'Merriweather', serif;">{{ $categoryGame->title }}</h2>
                        </div>
                        <div class="col-6 text-end">
                            <div class="px-6">
                                <a href="{{ route('frontend.game', ['category' => $categoryGame->slug]) }}"
                                    class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill">View
                                    More</a>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-start justify-content-center  g-6">
                        @foreach ($categoryGame->games as $homepageGame)
                            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">
                                <div class="tournament-card p-xl-4 p-3 pb-xl-8">
                                    <div class="tournament-img mb-8 position-relative">
                                        <div class="img-area overflow-hidden">
                                            <a
                                                href="{{ route('frontend.game_detail_page', ['slug' => $homepageGame->slug]) }}">
                                                <img class="img-fluid"
                                                    src="{{ asset('storage/' . $homepageGame->image) }}"
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
            @endforeach
        </div>
    </div>
</section>
