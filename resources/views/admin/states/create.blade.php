@extends('admin.layouts.design')
@section('body')

<style>
    .error {
        color: red;
    }
</style>

<form action="{{ route('admin.states.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
    @csrf
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">State</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Country <span class="req-field">*</span></label>


                                <select class="form-select" name="country_id" id="country_id" value="{{old('country_id')}}">
                                    <option value="" disabled selected>Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country}}</option>

                                    @endforeach

                                </select>
                                @if ($errors->has('country_id'))
                                <p class="fs-6 text-danger"> {{ $errors->first('country_id') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">State <span class="req-field">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter State Name" name="state" id="state" value="{{old('state')}}">
                                @if ($errors->has('state'))
                                <p class="fs-6 text-danger"> {{ $errors->first('state') }} </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Code <span class="req-field">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter code Name" name="code" id="code" value="{{old('code')}}">
                                @if ($errors->has('code'))
                                <p class="fs-6 text-danger"> {{ $errors->first('code') }} </p>
                                @endif
                            </div>

                        </div>


                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="0">
                                        <label class="form-check-label" for="inlineRadio3">Inactive</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- Row end -->
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{route('admin.states.index')}}"> <button type="button" class="btn btn-outline-secondary">
                                Cancel
                            </button></a>

                        <button type="submit" class="btn btn-success">
                            Submit
                        </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div id="errors"></div>
@endsection
<!-- Include jQuery -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myForm').on('submit', function(e) {
            var isValid = true;

            // Clear previous error messages
            $('.form-control, .form-select').removeClass('is-invalid');
            $('.fs-6.text-danger').remove();

// country
            // Validate country_id
            if ($('#country_id').val().trim() === '') {
                $('#country_id').addClass('is-invalid');
                $('#country_id').after('<p class="fs-6 text-danger">country Id  is required.</p>');
                isValid = false;
            }

            // Validate state
            if ($('#state').val().trim() === '') {
                $('#state').addClass('is-invalid');
                $('#state').after('<p class="fs-6 text-danger">State name is required.</p>');
                isValid = false;
            }

            // Validate code
            if ($('#code').val().trim() === '') {
                $('#code').addClass('is-invalid');
                $('#code').after('<p class="fs-6 text-danger">Code is required.</p>');
                isValid = false;
            }


            // Prevent form submission if invalid
            if (!isValid) {
                e.preventDefault();
            }
        });


    });
</script>
