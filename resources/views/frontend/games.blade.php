@extends('frontend.layouts.main')
@section('body')
    <style>
         .game-list-img{
                border-radius: 12px !important;
            }
        @media only screen and (min-width: 320px) and (max-width: 767px) {
            body {
                overflow-x: hidden;
            }

        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />



<!-- new banner -->
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

    <!-- ------------------------------------------------------------------------------------------ -->
    <section class="tournament-section pb-5 keywords">
        <div class="tournament-wrapper alt">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 gap-2">

                        <div class="col-md-12 gap-2">
                            @php
                                $allKeywords = [];
                                foreach ($keywords as $keyword) {
                                    $items = explode(',', $keyword->keyword);
                                    $allKeywords = array_merge($allKeywords, $items);
                                }
                                $uniqueKeywords = array_unique(array_map('trim', $allKeywords));
                            @endphp

                            @foreach ($uniqueKeywords as $uniqueKeyword)
                                <a href='#' onclick='uniqueKeywordSearch("{{ $uniqueKeyword }}")'>
                                    <span class="badge bg-orange me-2 " id="keyword">{{ $uniqueKeyword }}</span>
                                </a>
                            @endforeach
                        </div>

                        <!-- <div class="col-md-12 gap-2">
                                                @php
                                                    $allKeywords = [];
                                                    foreach ($keywords as $keyword) {
                                                        $items = explode(',', $keyword->keyword);
                                                        $allKeywords = array_merge($allKeywords, $items);
                                                    }
                                                    $uniqueKeywords = array_unique(array_map('trim', $allKeywords));
                                                @endphp

                                                @foreach ($uniqueKeywords as $uniqueKeyword)
    <a href="{{ route('frontend.game', ['keyword' => $uniqueKeyword]) }}">
                                                    <span class="badge bg-orange me-2">{{ $uniqueKeyword }}</span>
                                                </a>
    @endforeach
                                            </div> -->
                    </div>
                </div>
    </section>
    <section class="tournament-section">
        <div class="tournament-wrapper alt">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between dropdown mb-10 ">
                    <div class="col-8">
                        <h1 class="h1" style="color: white; font-family: 'Merriweather', serif;">Games List</h1>
                    </div>
                    <div class="col-4 d-flex justify-content-end">


                        <form method="GET" action="{{ route('frontend.game') }}" class="form-dropdown">

                            <select name="sort" id="sort" onchange="updateURL()" style=""
                                class="btn-1 btn-light dropdown-toggle div-form">
                                <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>A-Z</option>
                                <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Z-A</option>
                            </select>
                            <!-- Category Form -->
                            <select name="category" onchange="updateURL()" style=""
                                class="custom-select dropdown-toggle  div-form" id="category_search_id">
                                <option value="" disabled selected>Category</option>
                                <option value="all">All Category</option>
                                @foreach ($categoriesList as $game)
                                    <option value="{{ $game->slug }}"
                                        {{ old('category', request()->get('category')) == $game->slug ? 'selected' : '' }}>
                                        {{ $game->title }}</option>
                                @endforeach
                            </select>

                        </form>
                    </div>
                </div>

                @if ($games->count())
                    <div class="row justify-content-md-start justify-content-center  g-6">
                        @foreach ($games as $game)
                            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8 ">
                                <div class="tournament-card p-xl-4 p-3 pb-xl-8">
                                    <div class="tournament-img mb-8 position-relative ">
                                        <div class="img-area overflow-hidden">
                                            <a href="{{ route('frontend.game_detail_page', ['slug' => $game->slug]) }}">
                                                <img class="game-list-img" src="{{ asset('storage/' . $game->image) }}"
                                                    alt="tournament" alt="{{ $game->keyword }}" id="limit"></a>
                                        </div>
                                    </div>
                                    <div class="tournament-content px-xxl-4">
                                        <div class="card-more-info d-between mt-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($games->total() > 20)
                            <div class="pagination">
                                {{ $games->appends(['limit' => request()->get('limit', 20)])->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                @else
                    <div>
                        <h3 class="text-center">No games found.</h3>
                    </div>
                @endif
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{ route('frontend.homepage.index') }}"
                        class="btn-half-border-1 position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill  mb-20"
                        style="background-color: #FF4F00;">Back to Home page</a>
                </div>
            </div>
        </div>
    </section>


    <!-- ===========================new section Racing=============================== -->




    <!-- select2 -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $('#category_search_id').select2({
            placeholder: "Select Category...",
            closeOnSelect: true
        });


        // limit 20
        document.addEventListener("DOMContentLoaded", function() {

            function updateUrl(newLimit) {
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('limit', newLimit);
                window.location.href = newUrl.toString(); // Navigate to the new URL
            }

            // Set the default limit in the URL if not present
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('limit')) {
                updateUrl(20);
            }
        });
        // end limit 20



        // for sort

        function uniqueKeywordSearch(keywordData) {
            const category = $('#category_search_id').val();
            const search = $('#searchInput').val();
            const sort = $('#sort').val();

            const url = new URL(window.location.href);
            if (keywordData) {
                let urlKeyword = url.searchParams.get('keyword');
                let foundKeywordInURL = "";
                if (urlKeyword) {
                    foundKeywordInURL = urlKeyword.indexOf(keywordData);
                } else {
                    urlKeyword = keywordData;
                }

                if (foundKeywordInURL < 0) {
                    urlKeyword = urlKeyword + "," + keywordData
                }
                url.searchParams.set('keyword', urlKeyword);
            }
            if (category) {
                url.searchParams.set('category', category);
            }
            if (search) {
                url.searchParams.set('search', search);
            }
            if (sort) {
                url.searchParams.set('sort', sort);
            }

            // Redirect to the new URL
            window.location.href = url;
        }

        function updateURL() {
            const category = $('#category_search_id').val();
            const search = $('#searchInput').val();
            const sort = $('#sort').val();

            const url = new URL(window.location.href);
            if (category) {
                url.searchParams.set('category', category);
            }
            if (search) {
                url.searchParams.set('search', search);
            }
            if (sort) {
                url.searchParams.set('sort', sort);
            }

            // Redirect to the new URL
            window.location.href = url;
        }

        $(document).ready(function() {
            // Function to update the URL parameters
            function updateURL() {
                const category = $('#category').val();
                const search = $('#search').val();
                const sort = $('#sort').val();

                const url = new URL(window.location.href);
                url.searchParams.set('category', category);
                url.searchParams.set('search', search);
                url.searchParams.set('sort', sort);
                window.location.href = url;
            }

            // Event listeners for the dropdowns and search box
            // $('#category, #sort').on('change', updateURL);
            // $('#search').on('input', updateURL);
        });


        // multiple keywords
    </script>
@endpush
