 <!-- banner section start -->
 <style>
     @media (max-width: 480px) {

         .hero-content h2,
         ul,
         a {
             font-size: medium;
         }
     }
 </style>
 <section class="banner-section pb-120 pt-lg-20 pt-sm-10">
     <div class="container-fluid">
         <div class="row g-4">
             <div class="col-xxl-12">
                 <div class="swiper banner-swiper position-relative">
                     {{-- <div class="banner-bg-img position-absolute w-100">
                         <img class="w-100 h-100 rounded-3" src="{{ asset('frontend-new/img/hero-banner-bg.png') }}"
                             alt="banner">
                     </div> --}}
                     <div class="banner-swiper-pagination"></div>
                     <div class="swiper-wrapper">
                         @foreach ($banners as $banner)
                             <div class="swiper-slide overflow-hidden w-100 h-100 rounded-3"
                                 style="background-image: url('{{ asset('storage/' . $banner->image) }}'); background-size:cover;">
                                 <div class="banner-content pt-lg-0 pt-6">
                                     <div class="row">
                                         <div class="col-7">
                                             <div class="hero-content p-lg-20">
                                                 <ul
                                                     class="d-flex gap-3 fs-2xl
                                                      heading-font mb-5 list-icon  p-3">
                                                     <li>Play</li>
                                                     <li>Earn</li>
                                                     <li>Enjoy</li>
                                                 </ul>
                                                 <h2
                                                     class="hero-title display-two tcn-1 cursor-scale growUp mb-lg-10 mb-sm-8 mb-6 m-3 p-3 pb-0">
                                                     {{ $banner->title }}
                                                     </h3>
                                                     <div
                                                         class="d-flex align-items-center flex-wrap gap-xl-6 gap-3 m-3 pb-0">
                                                         @if ($banner->game_id !== null && isset($banner->game))
                                                             <a href="{{ route('frontend.game_detail_page', ['slug' => $banner->game->slug]) }}"
                                                                 class="btn-half-border position-relative d-inline-block py-2 small px-6 bgp-1 rounded-pill ">Play
                                                                 Now</a>
                                                         @elseif($banner->category_id !== null && isset($banner->category))
                                                             <a href="{{ route('frontend.category-true-game', ['id' => $banner->category->id]) }}"
                                                                 class="btn-half-border position-relative d-inline-block py-2 small px-6 bgp-1 rounded-pill ">Play
                                                                 Now</a>
                                                         @elseif ($banner->url)
                                                             <a href="{{ $banner->url }}" target="_blank"
                                                                 class="btn-half-border position-relative d-inline-block py-2 small px-6 bgp-1 rounded-pill ">Play
                                                                 Now</a>
                                                         @else
                                                             <a href=""
                                                                 class="btn-half-border position-relative py-2 small px-6 bgp-1 rounded-pill"
                                                                 style="display: none">Play
                                                                 Now</a>
                                                         @endif
                                                     </div>
                                             </div>
                                         </div>
                                         {{-- <div class="col-5" style="align-self: self-end;">
                                             <div class="banner-inner-img">
                                                 <img class="w-100" src="{{ asset('storage/' . $banner->image) }}"
                                                     alt="img">
                                             </div>
                                         </div> --}}
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
 <!-- banner section end -->
