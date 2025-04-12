    <!-- header-section start -->
    <header class="header-section bgn-4 w-100">
        <div class="py-sm-6 py-3 mx-xxl-20 mx-md-15 mx-3">
            <div class="d-between gap-xxl-10 gap-lg-6">
                <div class="top-bar alt d-flex align-items-center gap-6">
                    <button class="sidebar-toggle-btn" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <a class="navbar-brand d-flex align-items-center gap-4 w-100" href="{{ route('frontend.homepage.index') }}">
                        <img class="w-100 logo2 d-sm-block d-block" src="{{ asset('assets/frontend/images/freewebsgames.webp') }}" alt="favicon">
                        {{-- <img class="w-100 logo2 d-sm-block d-none" src="{{ asset('/assets/frontend/images/freewebsgames.webp') }}" alt="logo"> --}}
                    </a>
                </div>
                <div class="header-btn-area gap-6 w-100 position-relative">
                    <!-- search bar start  -->
                    <div class="search-bar w-100">
                        <form action="#">
                            <div class="input-area d-flex align-items-center gap-3">
                                <i class="ti ti-search"></i>
                                <input type="text" name="search" id="searchInput" placeholder="Search......" value="{{ request()->get('search', '') }}">
                            </div>
                        </form>
                    </div>
                    <!-- search bar end  -->

                    <div
                        class="header-btns d-flex align-items-center justify-content-end gap-lg-6 gap-sm-4 gap-2 w-100">
                        <button class="search-toggle-btn toggle-btn box-style fs-2xl d-block d-lg-none">
                            <i class="ti ti-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-section end -->
