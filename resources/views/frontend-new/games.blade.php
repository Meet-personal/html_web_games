@extends('frontend-new.layouts.main')
@section('body')
    @include('frontend-new.common.banner')

    <section class="tournament-section pb-5 keywords">
        <div class="tournament-wrapper alt">
            <div class="container-fluid">
                <div class="row">
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
                                <span class="badge bgp-1 me-2 " id="keyword">{{ $uniqueKeyword }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tournament-section pb-120">
        <div class="tournament-wrapper alt">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between mb-15">
                    <div class="col-6">
                        <h2 class="display-four tcn-1 cursor-scale growUp title-anim">Games List </h2>
                    </div>
                    <div class="col-6 text-end">
                        <dvi class="row">
                        <form method="GET" action="{{ route('frontend.game') }}" class="form-dropdown">
                            <select name="sort" id="sort" onchange="updateURL()" style=""
                                class="btn-1 btn-light dropdown-toggle div-form">
                                <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>A-Z</option>
                                <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Z-A</option>
                            </select>
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
                <div class="singletab tournaments-tab">
                    <div class="tabcontents">
                        <div class="tabitem active">
                            <div class="row justify-content-md-start justify-content-center  g-6">
                                @if ($games->count())
                                    @foreach ($games as $game)
                                        <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">
                                            <div class="tournament-card p-3 bgn-4">
                                                <div class="tournament-img position-relative trending_game_detail_page" data-url="{{ route('frontend.game_detail_page', ['slug' => $game->slug]) }}">
                                                    <div class="img-area overflow-hidden">
                                                        <img class="w-100" src="{{ asset('storage/' . $game->image) }}"
                                                            alt="{{ $game->keyword }}" id="limit">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($games->total() > 20)
                                        <div class="justify-content-center pagination">
                                            {{ $games->appends(['limit' => request()->get('limit', 20)])->links('pagination::bootstrap-5') }}
                                        </div>
                                    @endif
                                @else
                                    <div>
                                        <h3 class="text-center">No games found.</h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const trendingGameElements = document.querySelectorAll(".trending_game_detail_page");

            trendingGameElements.forEach(element => {
                element.addEventListener("click", function () {
                    const url = this.getAttribute("data-url");
                    if (url) {
                        window.location.href = url;
                    }
                });
            });

            function updateUrl(newLimit) {
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('limit', newLimit);
                window.location.href = newUrl.toString();
            }

            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('limit')) {
                updateUrl(20);
            }
        });

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

            window.location.href = url;
        }

        $(document).ready(function() {
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
        });
    </script>
@endpush
