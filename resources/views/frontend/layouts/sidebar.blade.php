<aside class="sidebar">
    <div class="sidebar-wrapper d-flex">
        <div class="sidebar-menu py-xxl-15 py-sm-10 py-4 px-xxl-5 px-md-3 px-2">
            <div class="d-grid gap-sm-8 gap-4 sidebar-menu-items">
                <div class="p-lg-2 p-1">
                    <a href="{{ route('frontend.homepage.index') }}"
                        class="home-btn box-style {{ request()->is('/') || request()->is('/') ? 'active ' : null }}">
                        <i class="ti ti-home fs-2xl" style="color: white;"></i>
                    </a>
                </div>
                <ul class="d-grid gap-sm-6 gap-3 p-lg-2 p-1">
                    <li><a href="{{ route('frontend.game') }}"
                            class="menu-link box-style {{ request()->is('games/*') || request()->is('game/*') || request()->is('games') ? 'active ' : null }}"><i
                                class="ti ti-device-gamepad fs-2xl" style="color: white;"></i></a>
                    </li>
                    @foreach (get_cms() as $cms)
                    <li>
                        <a href="{{ route('frontend.cms', ['slug' => $cms->slug]) }}"
                            class="menu-link box-style {{ request()->is($cms->slug . '/') || request()->is($cms->slug) ? 'active' : '' }}">
                            @php
                            $iconMap = [
                            'Privacy Policy' => 'ti ti-receipt',
                            'Terms & Conditions' => 'fa-solid fa-file-contract',
                            ];
                            @endphp

                            @if (array_key_exists($cms->title, $iconMap))
                            <i class="{{ $iconMap[$cms->title] }} fs-2xl" style="color: white;"></i>
                            @else
                            <span>{{ $cms->title }}</span>
                            @endif
                        </a>
                    </li>
                    @endforeach


                    <!-- @foreach (get_cms() as $cms)
                        <li><a href="{{ route('frontend.cms', ['slug' => $cms->slug]) }}"
                                class="menu-link box-style {{ request()->is($cms->slug . '/') || request()->is($cms->slug . '/') || request()->is($cms->slug) ? 'active ' : null }}">
                                @if ($cms->title == 'Privacy Policy')
                                    <i class="ti ti-receipt fs-2xl" style="color: white;"></i>
                                @elseif($cms->title == 'Terms & Conditions')
                                    <i class="fa-solid fa-file-contract fs-2xl" style="color: white;"></i>
                                @endif
                            </a>
                        </li>
                    @endforeach -->
                    <li>
                        <a href="{{ route('feedbacks.index') }}"
                            class="menu-link box-style {{ request()->is('feedbacks') ? 'active' : null }}">
                            <i class="ti ti-message-circle-question fs-2xl" style="color: white;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
