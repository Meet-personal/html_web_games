


@extends('frontend.layouts.main')
@section('body')
<section class="tournament-section pb-5">
    <div class="tournament-wrapper alt">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between mb-15">
            </div>
            @if ($carouselGames->count())
            <div class="row justify-content-md-start justify-content-center  g-6">
                @foreach($carouselGames as $game)
                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">

                    <div class="tournament-card p-xl-4 p-3 pb-xl-8 bgn-4">

                        <div class="tournament-img mb-8 position-relative">
                            <div class="img-area overflow-hidden">

                                <img class="w-100" src="{{asset('storage/'.$game->image)}}"
                                    alt="tournament" alt="{{ $game->keyword }}">
                            </div>
                            <!-- <span
                                class="card-status position-absolute start-0 py-2 px-6 tcn-1 fs-sm">
                                <span class="dot-icon alt-icon ps-3" id="openUrlButton" role="button">Playing</span>
                            </span> -->
                        </div>
                        <div class="tournament-content px-xxl-4">
                            <!-- <div class="tournament-info mb-5">
                                <a href="{{route('frontend.game_detail_page',  ['slug' => $game->slug])}}" class="d-block">
                                    <h4
                                        class="tournament-title tcn-1 mb-1 cursor-scale growDown title-anim">
                                        {{$game->name}}

                                    </h4>
                                </a>
                                <span class="tcn-6 fs-sm">  {{$game->keyword}}</span>
                            </div> -->
                            <!-- <div class="hr-line line3"></div> -->
                            <!-- <div class="card-more-info d-between mt-6">

                                <a href="{{route('frontend.game_detail_page',  ['slug' => $game->slug])}}" class="btn2">
                                    <i class="ti ti-arrow-right fs-2xl"></i>
                                </a>

                            </div> -->
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="pagination">
                    {{ $carouselGames->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @else
            <div>
                <h3 class="text-center">No games found.</h3>
            </div>
            @endif
            <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('frontend.homepage.index') }}" class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill bg-orange mb-10">Back to Home page</a>

        </div>
        </div>

</section>

<!----------------------------------------------- end section -------------------------------------------->
@endsection
