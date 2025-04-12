@extends('admin.layouts.design')
@section('body')
<style>

</style>



<form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data" id="profileForm">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Update Profile</h5>
                </div>
                <div class="card-body">
                    <div class="row gx-3">
                        <!-- First Name -->
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name', auth()->guard('admin')->user()->first_name) }}">
                            @if ($errors->has('first_name'))
                            <p class="fs-6 text-danger">{{ $errors->first('first_name') }}</p>
                            @endif
                        </div>

                        <!-- Last Name -->
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name', auth()->guard('admin')->user()->last_name) }}">
                            @if ($errors->has('last_name'))
                            <p class="fs-6 text-danger">{{ $errors->first('last_name') }}</p>
                            @endif
                        </div>

                        <!-- Email -->
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->guard('admin')->user()->email) }}">
                            @if ($errors->has('email'))
                            <p class="fs-6 text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <!-- Country Code -->
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="countryCode" class="form-label">Country Code</label>
                            <input type="text" class="form-control" id="countryCode" name="country_code" value="{{ old('country_code', auth()->guard('admin')->user()->country_code) }}">
                            @if ($errors->has('country_code'))
                            <p class="fs-6 text-danger">{{ $errors->first('country_code') }}</p>
                            @endif
                        </div>

                        <!-- Mobile Number -->
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="mobileNumber" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mobileNumber" name="mobile_number" value="{{ old('mobile_number', auth()->guard('admin')->user()->mobile_number) }}">
                            @if ($errors->has('mobile_number'))
                            <p class="fs-6 text-danger">{{ $errors->first('mobile_number') }}</p>
                            @endif
                        </div>

                        <!-- Profile Photo -->
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="profilePhoto" class="form-label">Profile Photo</label>
                            <input class="form-control" type="file" id="profilePhoto" name="profile_photo" onchange="previewPhoto()">
                            @if (old('profile_photo') || (auth()->guard('admin')->user()->profile_photo))
                            <img id="photoPreview" src="{{ asset('storage/' . auth()->guard('admin')->user()->profile_photo ?: 'no-image.png') }}" alt="Profile Photo" width="100px" height="100px" />
                            @else
                            <p class="fs-6 text-muted">No profile photo selected</p>
                            @endif
                            <!-- <img id="photoPreview" src="{{ asset(auth()->guard('admin')->user()->profile_photo ?: 'no-image.png') }}" alt="Profile Photo" width="100px" height="100px" /> -->
                            @if ($errors->has('profile_photo'))
                            <p class="fs-6 text-danger">{{ $errors->first('profile_photo') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer with Buttons -->
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.dashboard') }}">
                            <button type="button" class="btn btn-primary">
                                Back
                            </button>
                        </a>
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
<script>
    function previewPhoto() {
        const photo = document.getElementById('profilePhoto').files[0];
        const preview = document.getElementById('photoPreview');
        const reader = new FileReader();

        reader.addEventListener('load', function() {
            preview.src = reader.result;
        }, false);

        if (photo) {
            reader.readAsDataURL(photo);
        }
    }
</script>
