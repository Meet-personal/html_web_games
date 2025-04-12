@extends('admin.layouts.design')
@section('body')

<style>
    .error {
        color: red;
    }
</style>

<form action="{{ route('admin.countries.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
    @csrf
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Country</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Country <span class="req-field">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Country Name" name="country" id="country" value="{{old('country')}}">
                                @if ($errors->has('country'))
                                <p class="fs-6 text-danger"> {{ $errors->first('country') }} </p>
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
                                <label for="formFile" class="form-label">Flag</label>
                                <input class="form-control" type="file" id="flag" name="flag" value="{{old('flag')}}" onchange="preview()">
                                <img id="frame" src="{{ get_no_image() }}" alt="No Image" width="100px" height="100px"/>
                                @if ($errors->has('flag'))
                                <p class="fs-6 text-danger"> {{ $errors->first('flag') }} </p>
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
                        <a href="{{route('admin.countries.index')}}"><button type="button" class="btn btn-outline-secondary">
                                Cancel
                            </button>
                        </a>
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myForm').on('submit', function(e) {
            var isValid = true;

            // Clear previous error messages
            $('.form-control').removeClass('is-invalid');
            $('.form-select').removeClass('is-invalid');
            $('.fs-6.text-danger').remove();

            // Validate country
            if ($('#country').val().trim() === '') {
                $('#country').addClass('is-invalid');
                $('#country').after('<p class="fs-6 text-danger">Country name is required.</p>');
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

    function preview() {
        frame.src=URL.createObjectURL(event.target.files[0]);
}

</script>
