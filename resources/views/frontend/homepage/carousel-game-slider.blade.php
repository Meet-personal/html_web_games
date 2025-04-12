 <section class="game-section pb-5 pt-5">
     <div class="container-fluid">
         @if ($carouselGameSliders->count())
             <div class="row align-items-center justify-content-between mb-15">
                 <div class="col-6">
                     <h2 class="display-four tcn-1 cursor-scale growUp title-anim arrival"
                         style="  font-family: 'Merriweather', serif;">New Arrival</h2>
                 </div>

             </div>
             <div class="row">
                 <div class="col">
                     <div class="swiper game-swiper2">
                         <div class="swiper-wrapper mb-lg-15 mb-10">
                             @foreach ($carouselGameSliders as $carouselGameSlider)
                                 <div class="swiper-slide">
                                     <div class="game-card-wrapper mx-auto">
                                         <div class="game-card mb-5 p-2">
                                             <div class="game-card-border"></div>
                                             <div class="game-card-border-overlay"></div>
                                             <div class="game-img">
                                                 {{-- <a
                                                     href="{{ route('frontend.game_detail_page', ['slug' => $carouselGameSlider->slug]) }}"> --}}
                                                 <img class="swiper-card-1 w-100 h-100"
                                                     src="{{ asset('storage/' . $carouselGameSlider->image) }}"
                                                     alt="game">
                                                 {{-- </a> --}}
                                             </div>
                                             <div class="game-link d-center">
                                                 <a href="{{ route('frontend.game_detail_page', ['slug' => $carouselGameSlider->slug]) }}"
                                                     class="btn2">
                                                     {{-- <i class="ti ti-arrow-right fs-2xl"></i> --}}
                                                 </a>
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
         @endif
     </div>
     </div>
 </section>
