<style>
    .sidebarMenuScroll {
         height: calc(110vh - 190px) !important;
        /* height: calc(120vh - 190px) !important; */

        overflow: hidden;
    }
</style>
<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar profile starts -->
    <!-- <div class="shop-profile">
						<p class="mb-1 fw-bold text-primary"> Hey Kaushik </p>
						<p class="m-0">Los Angeles, California</p>
					</div> -->
    <!-- Sidebar profile ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
        <ul class="sidebar-menu">



            <li class="{{request()->is('admin/dashboard') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.dashboard')}}"data-title="Dashboard" class="menu-link">
                    <i class="bi bi-pie-chart"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="{{request()->is('admin/categories/*') || request()->is('admin/categories') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.categories.index')}}"data-title="Categories" class="menu-link">
                    <i class="fs-3 bi bi-list-task"></i>
                    <span class="menu-text">Categories</span>
                </a>
            </li>
            <li class="{{request()->is('admin/games/*') || request()->is('admin/games') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.game.index')}}">
                    <i class="fs-3 bi bi-puzzle-fill"></i>
                    <span class="menu-text">Games</span>
                </a>
            </li>
            <!-- <li class="{{request()->is('admin/countries/*') || request()->is('admin/countries') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.countries.index')}}">
                    <i class="bi bi-globe-central-south-asia"></i>
                    <span class="menu-text">Countries</span>
                </a>
            </li> -->

       <!-- <li class="{{request()->is('admin/states/*') || request()->is('admin/states') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.states.index')}}">
                    <i class="fa-solid fa-landmark"></i>
                    <span class="menu-text">States</span>
                </a>
            </li>
            <li class="{{request()->is('admin/cities/*') || request()->is('admin/cities') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.cities.index')}}">
                    <i class="fa-solid fa-city"></i>
                    <span class="menu-text">Cities</span>
                </a>
            </li> -->

            <li class="{{request()->is('admin/banners/*') || request()->is('admin/banners') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.banners.index')}}">
                    <i class="fa-solid fa-image"></i>
                    <span class="menu-text">Banners</span>
                </a>
            </li>
            <li class="{{request()->is('admin/faqs/*') || request()->is('admin/faqs') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.faqs.index')}}">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <span class="menu-text">Faqs</span>
                </a>
            </li>
            <li class="{{request()->is('admin/cms/*') || request()->is('admin/cms') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.cms.index')}}">
                <i class="	fa fa-file" aria-hidden="true"></i>
                    <span class="menu-text">CMS Pages</span>
                </a>
            </li>
            <li class="{{request()->is('admin/feedbacks/*') || request()->is('admin/feedbacks') ? 'active current-page' : NULL }}">
                <a href="{{route('admin.feedbacks.index')}}">

                <i class="fa fa-comments"></i>
                    <span class="menu-text">Feedback</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- Sidebar menu ends -->
</nav>
<script>
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', function() {
            const title = this.getAttribute('data-title');
            document.title = title; // Change the document title
        });
    });
</script>
