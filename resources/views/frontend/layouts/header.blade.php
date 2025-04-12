<div class="preloader">
    <div class="loader">
        <span></span>
    </div>
</div>

<div class="cursor"></div>

<header class="header-section bgn-4 w-100 game-header">
    <div class="py-sm-6 py-3 mx-xxl-20 mx-md-15 mx-3">
    <div class="d-between gap-xxl-10 gap-lg-6 " >
    <div class="top-bar alt d-flex align-items-center gap-6">
        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle-btn" type="button">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-4 w-100" href="/">
            <!-- Favicon Logo Hidden on Mobile -->
            {{-- <!-- <img class="w-100 logo1 d-block" src="{{asset('/assets/frontend/images/favicon.png')}}" alt="favicon"> --> --}}
            <!-- Main Logo Visible on All Screens -->
            <img class="web-logo logo2 d-block" src="{{asset('/assets/frontend/images/freewebsgames.webp')}}" alt="logo">
        </a>
    </div>

    <div class="header-btn-area d-flex align-items-center gap-6 w-100 position-relative">
        <!-- Search Bar Start -->
        <div class="search-bar w-100">
            <form action="{{ route('frontend.game') }}" method="GET">
                <div class="input-area d-flex align-items-center gap-3">

                    <i class="ti ti-search"></i>
                    <!-- <i class="fa fa-search"></i> -->
                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        placeholder="Search..."
                        value="{{ request()->get('search', '') }}">
                    <a id="clearSearch"
                        href="{{route('frontend.game')}}"
                        style="position: absolute; right: 19px; top: 49%; transform: translateY(-50%); display: none; background-color: black; color: white; font-size: 24px; padding: 10px; text-decoration: none;">
                        X
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- <div class="d-between gap-xxl-10 gap-lg-6">
            <div class="top-bar alt d-flex align-items-center gap-6">
                <button class="sidebar-toggle-btn" type="button">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <a class="navbar-brand d-flex align-items-center gap-4 w-100" href="/">
                    <img class="web-logo logo2 d-sm-block d-none" src="{{asset('/assets/frontend/images/freewebsgames.webp')}}" alt="logo">
                </a>
            </div>
            <div class="header-btn-area d-between gap-6 w-100 position-relative">

                <div class="search-bar w-100">
                    <form action="{{ route('frontend.game') }}" method="GET">
                        <div class="input-area d-flex align-items-center gap-3">
                            <i class="ti ti-search"></i>

                            <input
                                type="text"
                                name="search"
                                id="searchInput"
                                placeholder="Search..."
                                value="{{ request()->get('search', '') }}{{ request()->get('keyword', '') }}">
                            <a id="clearSearch"
                                href="{{route('frontend.game')}}"
                                style="position: absolute; right: 19px; top: 49%; transform: translateY(-50%); display: none; background-color: black; color: white; font-size: 24px; padding: 10px; text-decoration: none;">
                                X
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div> -->
    </div>
</header>


<script>
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const getCleanUrl = function(url) {
        return url.replace(/#.*$/, '').replace(/\?.*$/, '');
    };

    function fetchResults() {
        const query = searchInput.value.trim();
        console.log(`Fetching results for: ${query}`);
    }

    function toggleClearButton() {
        clearSearch.style.display = searchInput.value ? 'block' : 'none';
    }
    clearSearch.addEventListener('click', () => {
        searchInput.value = '';
        clearSearch.style.display = 'none';
        const url = new URL(window.location);
        url.searchParams.delete('search');
        url.searchParams.delete('keyword');
        // url.searchParams.delete('sort');
        url.searchParams.delete('category');
        window.history.replaceState({}, '', url.toString());
        fetchResults();
    });
    window.addEventListener('DOMContentLoaded', () => {
        toggleClearButton();
        fetchResults();
    });
    searchInput.addEventListener('input', () => {
        toggleClearButton();
        fetchResults();
    });




</script>
