@extends('frontend-new.layouts.main')
@section('body')
    <style>
        .btn-half-border {
            font-size: 15px;
            margin-top: 80px;
            background-color: #FF4F00;
            position: relative;
            display: inline;
        }


        .iframe-container {
            position: relative;
            width: 100%;
            height: 100vh;
            /* Full height for responsiveness */
            background-color: #000;
            /* Black background */
            display: flex;
            flex-direction: column;
            /* Stack game info and iframe */
            justify-content: center;
            align-items: center;
        }

        /* Game Info Section Styling */
        .game-info {
            text-align: center;
            margin-bottom: 10px;
        }

        .game-image {
            width: 120px;
            height: auto;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .game-name {
            font-size: 20px;
            color: #fff;
            margin: 0;
        }

        /* Iframe Styling */
        #myvideo {
            width: 100%;
            /* Adjust as needed */
            height: 100%;
            /* Adjust as needed */
            max-width: 1200vh;
            /* Prevent overly large iframe */
            max-height: 720px;
            border: none;
            filter: blur(10px);
            /* Initially blurred */
            pointer-events: none;
            /* Prevent interaction before play */
            transition: filter 0.3s ease;
        }

        /* Play Button Styling */
        #playButton {
            position: absolute;
            z-index: 2;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Button Hover Effect */
        #playButton:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /* Hidden Button Class */
        #playButton.hidden {
            display: none;
        }


        @media only screen and (min-width: 320px) and (max-width: 767px) {

            .iframe-container {
                position: relative;
                width: 100%;
                height: 300px;
                /* Adjust the height as needed */
                overflow: hidden;
                background: #000;
            }

            /* General Container Styling */


            /* Game Info Section Styling */
            .iframe-container {
                text-align: center;
                position: relative;
            }

            .game-info img {
                max-width: 100%;
                height: auto;
                display: block;
                margin: 0 auto;
                border-radius: 10px;
            }

            .game-info h3 {
                margin: 10px 0;
                font-size: 18px;
                color: #333;
                text-align: center;
            }

            #playButton {
                margin-top: 10px;
                padding: 10px 20px;
                font-size: 16px;
                font-weight: bold;
                color: #fff;
                background-color: #28a745;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }


            /* Button Hover Effect */
            #playButton:hover {
                background-color: #218838;
                transform: scale(1.05);
            }

            /* Hidden Button Class */
            #playButton.hidden {
                display: none;
            }

            .display-four {
                font-size: 23px !important;
            }
        }
    </style>
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
                <div class="col-md-8 video">
                    <div class="iframe-container mb-3" style="text-align: center; position: relative;">
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

                    <div class="footer-bar"
                        style="display: flex; justify-content: space-between; align-items: center; padding-top: 20px; border-top: 1px solid #ddd;">
                        <!-- Trending -->
                        @if ($game->flag == 1)
                            <span class="badge bg-success" style="font-size: 14px;">TRENDING</span>
                        @endif

                        <!-- Like and Dislike -->
                        <div>
                            <i class="fa fa-thumbs-up icon" aria-hidden="true" title="Like"
                                style="margin-right: 10px;"></i>
                            <span class="text-white" style="margin-right: 20px;">19K</span>
                            <i class="fa fa-thumbs-down icon" aria-hidden="true" title="Dislike"
                                style="margin-right: 10px;"></i>
                            <span class="text-white">2.4K</span>
                        </div>

                        <!-- Fullscreen Button -->
                        {{-- <button onclick="openFullscreen();" class="btn btn-primary"
                            style="font-size: 14px; padding: 5px 15px;">
                            <i class="fa fa-expand" title="Full Screen"></i> Full Screen
                        </button> --}}
                    </div>
                </div>
                <div class="col-md-4 footer-game-text">
                    <h6 class="text"><span style="color: orange;font-family: 'Merriweather', serif;">Game Name : </span>
                    </h6>
                    <h6 class="mb-3">
                        <span style="color: white;font-family: 'Merriweather', serif;">{{ $game->name }}</span>
                    </h6>
                    <h6 class="text"><span style="color: orange;font-family: 'Merriweather', serif;">Description :
                        </span>
                    </h6>
                    <h6 class="mb-3">
                        <span style="color: white;font-family: 'Merriweather', serif;">{{ $game->description }}</span>
                    </h6>
                    <h6 class="text"><span style="color: orange;font-family: 'Merriweather', serif;">Keywords :
                    </h6>
                    </span>
                    <h6 class="mb-3">

                        <span style="color: white;font-family: 'Merriweather', serif;">{{ $game->keyword }}
                        </span>
                    </h6>
                </div>
            </div>
        </div>

    </section>

    <!-- -------------------------------------------games section ------------------------------------------------------------- -->
    <section class="tournament-section pb-120">
        <div class="tournament-wrapper alt">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between mb-15">
                    <div class="col-6">
                        <h2 class="display-four tcn-1 cursor-scale growUp title-anim">Related Games </h2>
                    </div>
                </div>
                <div class="singletab tournaments-tab">
                    <div class="tabcontents">
                        <div class="tabitem active">
                            <div class="row justify-content-md-start justify-content-center  g-6">
                                @if ($relatedGames->count())
                                    @foreach ($relatedGames as $game)
                                        <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-8">
                                            <div class="tournament-card p-3 bgn-4">
                                                <div class="tournament-img position-relative trending_game_detail_page"
                                                    data-url="{{ route('frontend.game_detail_page', ['slug' => $game->slug]) }}">
                                                    <div class="img-area overflow-hidden">
                                                        <img class="w-100" src="{{ asset('storage/' . $game->image) }}"
                                                            alt="{{ $game->keyword }}" id="limit">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($relatedGames->total() > 20)
                                        <div class="justify-content-center pagination">
                                            {{ $relatedGames->appends(['limit' => request()->get('limit', 20)])->links('pagination::bootstrap-5') }}
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
    <!-- ---------------------------------------end section----------------------------------------------------------------- -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // limit 20
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
