@extends('admin.layouts.design')
@section('body')
    <div class="container mt-4">
        <div class="row d-flex justify-content-around">
            <div class="card shadow-lg mb-4"
                style="width: 22rem; border-radius: 15px; background: linear-gradient(135deg, #ff7e5f, #feb47b); color: white;">
                <a href="{{ route('admin.categories.index') }}" class="text-decoration-none text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-th-list"></i>&nbsp; Categories
                            </h5>
                            <h4 class="text-white font-weight-bold">{{ $categories }}</h4>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card shadow-lg mb-4"
                style="width: 22rem; border-radius: 15px; background: linear-gradient(135deg, #43cea2, #185a9d); color: white;">
                <a href="{{ route('admin.game.index') }}" class="text-decoration-none text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-gamepad"></i> &nbsp;Games
                            </h5>
                            <h4 class="text-white font-weight-bold">{{ $games }}</h4>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card shadow-lg mb-4"
                style="width: 22rem; border-radius: 15px; background: linear-gradient(135deg, #ff6a00, #ee0979); color: white;">
                <a href="{{ route('admin.banners.index') }}" class="text-decoration-none text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-flag"></i> &nbsp;Banners
                            </h5>
                            <h4 class="text-white font-weight-bold">{{ $banners }}</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
