<aside class="sidebar">
    <div class="sidebar-wrapper d-flex">
        {{-- <div class="sidebar-game-list-wrapper py-xxl-15 py-sm-10 py-4 px-xxl-7 px-lg-4 px-md-3 px-2">
            <div class="sidebar-game-list" data-lenis-prevent>
                <ul class="d-grid gap-xxl-6 gap-lg-4 gap-3">
                    @if (count($carouselGameSliders) > 0)
                        @foreach ($carouselGameSliders as $carouselGameSlider)
                            <li class="game-list-link">
                                <a href="{{ route('frontend.game_detail_page', ['slug' => $carouselGameSlider->slug]) }}"  class="w-30 h-100" ><img src="{{ asset('storage/' . $carouselGameSlider->image) }}" alt=""></a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

        </div> --}}
        <div class="sidebar-menu py-xxl-15 py-sm-10 py-4 px-xxl-5 px-md-3 px-2">
            <div class="d-grid gap-sm-8 gap-4 sidebar-menu-items">
                <div class="p-lg-2 p-1">
                    <a href="{{ route('frontend.homepage.index') }}" class="home-btn box-style {{ request()->is('/') ? 'active ' : '' }}">
                        <i class="ti ti-home fs-2xl"></i>
                    </a>
                </div>
                <ul class="d-grid gap-sm-6 gap-3 p-lg-2 p-1">
                    <li><a href="{{ route('frontend.game') }}" class="menu-link box-style {{ request()->is('games/*') || request()->is('game/*') || request()->is('games') ? 'active ' : '' }}"><i class="ti ti-device-gamepad fs-2xl"></i></a></li>
                    @foreach (get_cms() as $cms)
                        @php
                            $iconMap = [ 'Privacy Policy' => 'ti ti-receipt', 'Terms & Conditions' => 'ti ti-file-description'];
                        @endphp
                        <li><a href="{{ route('frontend.cms', ['slug' => $cms->slug]) }}" class="menu-link box-style {{ request()->is($cms->slug) ? 'active' : '' }}"><i class="{{ $iconMap[$cms->title] }} fs-2xl"></i></a></li>
                    @endforeach
                    <li><a href="{{ route('feedbacks.index') }}" class="menu-link box-style {{ request()->is('feedbacks') ? 'active' : '' }}"><i class="ti ti-message-circle-question fs-2xl"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</aside>
