<style>
    .pagination {
        margin-top: 10px;
        margin-left: 40%;
        color: white;
        background-color: black;
    }

</style>


@extends('frontend.layouts.main')
@section('body')
<section class="tournament-section pb-120">
    <div class="tournament-wrapper alt">
        @if ($categoryGames->count())

        <div class="container-fluid">

            @foreach($categoryGames as $categoryGame)
            @if($categoryGame->games->isNotEmpty())
            <div class="row align-items-center justify-content-between mb-5 category-row">

                <div class="col-6" style="margin-top:95px;">
                    <h2 class="display-four tcn-1 cursor-scale growUp title-anim" style="  font-family: 'Merriweather', serif;font-size:50px;">{{$categoryGame->title}}</h2>
                </div>
                <div class="col-6 text-end">
                    <!-- <div class="px-6">
                        <a href="{{route('frontend.category-true-game' , ['id' => $categoryGame->id])}}"
                            class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill">View
                            More</a>
                    </div> -->
                </div>
            </div>

            <div class="row justify-content-md-start justify-content-center  g-6">
                @foreach($categoryGame->games as $homepageGame)
                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">

                    <div class="tournament-card p-xl-4 p-3 pb-xl-8 bgn-4">

                        <div class="tournament-img mb-8 position-relative">

                            <div class="img-area overflow-hidden">
                                <a href="{{route('frontend.game_detail_page',  ['slug' => $homepageGame->slug])}}">
                                    <img class="img-fluid" src="{{asset('storage/'.$homepageGame->image)}}"
                                        alt="tournament"></a>
                            </div>
                            <!-- <span
                                class="card-status position-absolute start-0 py-2 px-6 tcn-1 fs-sm">
                                <span class="dot-icon alt-icon ps-3">Playing</span>
                            </span> -->
                        </div>
                        <div class="tournament-content px-xxl-4">
                            <!-- <div class="tournament-info mb-5">
                                <a href="{{route('frontend.game_detail_page',  ['slug' => $homepageGame->slug])}}" class="d-block">
                                    <h5
                                        class="tournament-title tcn-1 mb-1 cursor-scale growDown title-anim">
                                        {{$homepageGame->name}}
                                    </h5>
                                </a>

                                <h5 class="tcn-6 fs-sm"> {{$homepageGame->description}}</h5>
                            </div> -->
                            <!-- <div class="hr-line line3"></div> -->
                            <!-- <div class="card-more-info d-between mt-6">

                                <a href="{{route('frontend.game_detail_page',  ['slug' => $homepageGame->slug])}}" class="btn2">
                                    <i class="ti ti-arrow-right fs-2xl"></i>
                                </a>
                            </div> -->
                        </div>
                    </div>

                </div>

                @endforeach

            </div>
            @endif
            @endforeach
            <div class="pagination">
                {{ $categoryGames->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Pagination Links -->
        @else
        <div>
            <h3 class="text-center mb-50">No games found.</h3>
        </div>
        @endif

</section>

<div class="col-md-12 d-flex justify-content-end">
    <a href="{{ route('frontend.homepage.index') }}" class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill bg-orange mb-10">Back to Home page</a>
</div>

<!----------------------------------------------- end section -------------------------------------------->
@endsection
