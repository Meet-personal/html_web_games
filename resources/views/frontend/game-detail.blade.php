<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
@extends('frontend.layouts.main')
@section('body')


    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->





    <style>
        .btn-half-border {
            font-size: 15px;
            margin-top: 80px;
            background-color: #FF4F00;
            position: relative;
            display: inline;
        }

        /* .related-game{
                                    padding: 15px;
                                    position: relative;
                                    left: 15px;
                                }

                            .text {
                                font-weight: 600;
                            }*/

        @media only screen and (min-width: 320px) and (max-width: 767px) {

            body,
            html {
                height: 100%;
                width: 100% !important;
            }

        }
    </style>

    <!----------------------------------------------- multiple game images------------------------------ -->


    <!-- <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-end back" style=" padding:15px; position:relative;">
                                                        <a href="{{ route('frontend.game') }}" class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill bg-orange" style="font-size: 10px;">Back to Games List</a>

                                                    </div> -->
    <!----------------------------------------------- end section -------------------------------------------->

    <!-- ----------------------------------------------game images carousel---------------------------------- -->
    <section class="tournament-section pb-10">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 text-end back">
                    <div class="px-6">
                        <a href="{{ route('frontend.game') }}"
                            class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill">Back To
                            Game List</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 video">
                    <div class="iframe-container" style="text-align: center; position: relative;">
                        <!-- Game Image and Name -->


                        <!-- Game Iframe -->
                        <iframe id="myvideo" class="fullscreen" src="{{ $game->url }}" allowfullscreen></iframe>

                        <!-- Play Button -->
                        <button id="playButton" onclick="handlePlayButtonClick();" class="btn btn-success"
                            style="margin-top: 10px;">
                            <div class="game-info" style="margin-bottom: 10px;">
                                <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->name }}"
                                    style="width: 150px; height: auto; border-radius: 10px;" />
                                <h3 style="margin: 10px 0; font-size: 18px; color: #6c0000;">{{ $game->name }}</h3>
                            </div>
                            Play Now
                        </button>
                    </div>

                    <footer class="text-center mb-5 footer-1">
                        <div>

                            @if ($game->flag == 1)
                                <span class="bg bg-success"
                                    style="color: rgb(11, 241, 11);font-family: 'Merriweather', serif;text-emphasis: triangle;">TRENDING</span>
                            @endif
                        </div>

                        <div>
                            <i class="fa fa-thumbs-up icon" aria-hidden="true" title="Like"></i>
                            <span class="text-white">19K</span>
                        </div>
                        <div>
                            <i class="fa fa-thumbs-down icon" aria-hidden="true" title="UnLike"></i>
                            <span class="text-white">2.4K</span>
                        </div>

                        <div>
                            <button onclick="openFullscreen();" class="btn btn-link text-fullscreen">
                                <i class="fa fa-expand icon " title="Full Screen"></i>
                            </button>
                        </div>
                    </footer>

                    <!-- <div class="footer-1" style="text-align:center; margin-bottom:130px;margin: 0; padding: 0; width:98%">
                                                                        <button onclick="openFullscreen();" class="button fullscreen-button "><i class="fas fa-expand" title="Full Screen"></i></button>
                                                                        <div class="lbl-show-full-screen">Show Full Screen</div>
                                                                        <i class="fa fa-thumbs-up icon" aria-hidden="true"></i>
                                                                        <i class="fa fa-thumbs-down icon" aria-hidden="true"></i>
                                                                    </div> -->

                </div>
                <!-- <div class="row"> -->
                <div class="col-md-2 footer-game-text">
                    <h6 class="text"><span style="color: orange;font-family: 'Merriweather', serif;">Game Name : </span>
                    </h6>
                    <h6>
                        <span style="color: white;font-family: 'Merriweather', serif;">{{ $game->name }}</span>
                    </h6>
                    <h6 class="text"><span style="color: orange;font-family: 'Merriweather', serif;">Description :
                        </span>
                    </h6>
                    <h6>
                        <span style="color: white;font-family: 'Merriweather', serif;">{{ $game->description }}</span>
                    </h6>
                    <h6 class="text"><span style="color: orange;font-family: 'Merriweather', serif;">Keywords :
                    </h6>
                    </span>
                    <h6>

                        <span style="color: white;font-family: 'Merriweather', serif;">{{ $game->keyword }}
                        </span>
                    </h6>


                </div>

                <!-- <div class="col-md-6 text-end">
                                                                            <a href="{{ $game->url }}" class="btn-half-border position-relative d-inline-block py-2 bgp-1 px-6 rounded-pill">Play Now</a>
                                                                        </div> -->
            </div>
        </div>

    </section>
    <!-- -------------------------------end section------------------------------------------------------------------ -->

    <!-- ---------------------------multiple game images ----------------------------------------------------------------- -->





    <!-- -------------------------------------end section--------------------------------------------------------------- -->
    <!-- -------------------------------------------games section ------------------------------------------------------------- -->
    <section class="tournament-section pb-10 pt-10 ">
        <div class="tournament-wrapper alt">
            <div class="container-fluid related-game-list">
                <div class="row align-items-center justify-content-between ms-1 mb-15">
                    <div class="col-6 related-text">
                        <p class="display-four tcn-1 cursor-scale growUp title-anim related-game"
                            style="font-family: 'Merriweather', serif;">Related Games</p>
                    </div>

                    @if ($relatedGames->count())
                        <div class="row justify-content-md-start justify-content-center g-6 ">
                            @foreach ($relatedGames as $relatedGame)
                                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">
                                    <div class="tournament-card p-xl-4 p-2 pb-xl-4 bgn-4">
                                        <div class="tournament-img mb-1 position-relative">
                                            <div class="img-area overflow-hidden">
                                                <a
                                                    href="{{ route('frontend.game_detail_page', ['slug' => $relatedGame->slug]) }}">
                                                    <img class="img-fluid-related"
                                                        src="{{ asset('storage/' . $relatedGame->image) }}"
                                                        alt="tournament" style="">
                                                </a>
                                            </div>
                                            <!-- <span class="card-status position-absolute start-0 py-2 px-6 tcn-1 fs-sm">
                                                                                <span class="dot-icon alt-icon ps-3">Playing</span>
                                                                            </span> -->
                                        </div>
                                        <!-- <div class="tournament-content px-xxl-4"> -->
                                        <!-- <div class="tournament-info mb-5">
                                                                                        <a href="{{ route('frontend.game_detail_page', ['slug' => $relatedGame->slug]) }}" class="d-block">
                                                                                            <h4 class="tournament-title tcn-1 mb-1 cursor-scale growDown title-anim">{{ $relatedGame->name }}</h4>
                                                                                            <h4 class="tournament-title tcn-1 mb-1 cursor-scale growDown title-anim">{{ $relatedGame->keyword }}</h4>
                                                                                            <h5><span class="tcn-6 fs-sm"> {{ $relatedGame->description }}</span></h5>

                                                                                        </a>
                                                                                    </div> -->
                                        <!-- <div class="hr-line line3"></div> -->
                                        <!-- <div class="card-more-info d-between mt-6"> -->
                                        <!-- <a href="{{ route('frontend.game_detail_page', ['slug' => $relatedGame->slug]) }}" class="btn2">
                                                                                            <i class="ti ti-arrow-right fs-2xl"></i>
                                                                                        </a> -->
                                        <!-- </div> -z -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                            @endforeach
                            @if ($relatedGames->total() > 20)
                                <div class="pagination">
                                    {{ $relatedGames->appends(['limit' => request()->get('limit', 20)])->links('pagination::bootstrap-5') }}
                                </div>
                            @endif
                        </div>
                    @else
                        <div>
                            <h3 class="text-center mb-50">No games found.</h3>
                        </div>
                    @endif
                </div>
            </div>
    </section>
    <!-- ---------------------------------------end section----------------------------------------------------------------- -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // limit 20
        document.addEventListener("DOMContentLoaded", function() {

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
        // end limit 20

        // full scrin video script

        function lockOrientation(orientation) {
            if (screen.orientation && screen.orientation.lock) {
                screen.orientation.lock(orientation).catch((error) => {
                    console.error('Orientation lock failed:', error.message);
                });
            } else {
                console.warn('Screen orientation lock is not supported on this device/browser.');
            }
        }

        function handlePlayButtonClick() {
            const iframe = document.getElementById('myvideo');
            const playButton = document.getElementById('playButton');
            const isMobile = window.innerWidth <= 900;

            if (!iframe || !playButton) {
                console.error('Iframe or Play Button not found');
                return;
            }

            // Remove blur and hide the button
            iframe.style.filter = 'none';
            iframe.style.pointerEvents = 'auto';
            playButton.classList.add('hidden');

            // Open fullscreen
            openFullscreen(iframe);

            if (isMobile) {
                lockOrientation('landscape'); // Rotate to landscape for mobile
            }
        }

        function openFullscreen(element) {
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen(); // Safari
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen(); // Firefox
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen(); // IE/Edge
            } else {
                console.warn('Fullscreen API not supported');
            }
        }

        function handleFullscreenChange() {
            const iframe = document.getElementById('myvideo');
            const playButton = document.getElementById('playButton');

            if (!iframe || !playButton) {
                console.error('Iframe or Play Button not found');
                return;
            }

            const isFullscreen = document.fullscreenElement ||
                document.webkitFullscreenElement ||
                document.mozFullScreenElement ||
                document.msFullscreenElement;

            if (!isFullscreen) {
                // Reapply blur and show "Continue Playing" button with controller icon
                iframe.style.filter = 'blur(10px)';
                iframe.style.pointerEvents = 'none';
                playButton.classList.remove('hidden');
                playButton.innerHTML = 'Continue Playing <i class="fa fa-gamepad"></i>';

                // Unlock orientation on mobile
                unlockOrientation();
            }
        }

        function unlockOrientation() {
            if (screen.orientation && screen.orientation.unlock) {
                screen.orientation.unlock().catch((error) => {
                    console.error('Orientation unlock failed:', error.message);
                });
            } else {
                console.warn('Screen orientation unlock is not supported.');
            }
        }

        // Add event listeners for fullscreen changes
        document.addEventListener('fullscreenchange', handleFullscreenChange);
        document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
        document.addEventListener('mozfullscreenchange', handleFullscreenChange);
        document.addEventListener('msfullscreenchange', handleFullscreenChange);
    </script>
@endpush
