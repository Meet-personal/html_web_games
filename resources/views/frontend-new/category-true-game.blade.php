@extends('frontend-new.layouts.main')
@section('body')
    @if (count($categoryGames) > 0)
        @foreach ($categoryGames as $categoryGame)
            @if($categoryGame->games->isNotEmpty())
                <section class="tournament-section pb-120 pt-12">
                    <div class="tournament-wrapper alt">
                        <div class="container-fluid">
                            <div class="row align-items-center justify-content-between mb-15">
                                <div class="col-6">
                                    <h2 class="display-four tcn-1 cursor-scale growUp title-anim">{{ $categoryGame->title }}</h2>
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
            @endif
        @endforeach
    @endif
    <div class="col-md-12 d-flex justify-content-end pb-120 pt-12">
        <a href="{{ route('frontend.homepage.index') }}"
            class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill bg-orange mb-10">Back to
            Home page</a>
    </div>

@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const trendingGameElements = document.querySelectorAll(".trending_game_detail_page");

        trendingGameElements.forEach(element => {
            element.addEventListener("click", function () {
                const url = this.getAttribute("data-url");
                if (url) {
                    window.location.href = url;
                }
            });
        });
    });
</script>

@endpush
