<div class="app-header d-flex align-items-center">

				<!-- Toggle buttons start -->
				<div class="d-flex">
					<button class="toggle-sidebar" id="toggle-sidebar">
						<i class="bi bi-list lh-1"></i>
					</button>
					<button class="pin-sidebar" id="pin-sidebar">
						<i class="bi bi-list lh-1"></i>
					</button>
				</div>
				<!-- Toggle buttons end -->

				<!-- App brand starts -->
				<div class="app-brand py-2 ms-3">
					<a href="{{route('admin.dashboard')}}" class="d-sm-block d-none">
                    <img src="/assets/images/admin2.png" class="logo" alt="Bootstrap Gallery" style="color: white; width:150px;"/>
					</a>
					<a href="index.html" class="d-sm-none d-block">
						<img src="/assets/images/logo-sm.svg" class="logo" alt="Bootstrap Gallery" />
					</a>
				</div>
				<!-- App brand ends -->

				<!-- App header actions start -->
				<div class="header-actions col">

					<div class="dropdown ms-2">
						<a id="userSettings" class="dropdown-toggle d-flex py-2 align-items-center text-decoration-none" href="#!"
							role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="/assets/images/user.png" class="rounded-2 img-3x" alt="Bootstrap Gallery" />

							<span class="ms-2 text-truncate d-lg-block d-none">Admin</span>
						</a>
						<div class="dropdown-menu dropdown-menu-end shadow-lg">
							<div class="header-action-links mx-3 gap-2">
								<a class="dropdown-item" href="{{route('admin.profile')}}"><i class="bi bi-person text-primary"></i>Profile</a>
								<a class="dropdown-item" href=""><i class="bi bi-gear text-danger"></i>Settings</a>
							</div>
							<div class="mx-3 mt-2 d-grid">

                            {{-- <a href="{{route('admin.loginForm')}}" class="btn btn-primary btn-sm">Logout</a> --}}
							<form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <a href="{{ route('admin.logout') }}" class="btn btn-primary btn-sm w-100"
                                    onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                            </form>
							</div>
						</div>
					</div>
				</div>
				<!-- App header actions end -->

			</div>
