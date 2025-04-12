@extends('admin.layouts.design')
@section('body')

<style>
    .error {
        color: red;
    }

    #imagePreview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #ddd;
    }
</style>

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
    @csrf
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Categories</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Parent Category</label>
                                <select class="form-select" name="category_id" id="category_id">
                                    <option value="" disabled selected {{ old('category_id') ? '' : 'selected' }}>Select category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    <!-- <option value="{{$category->id}}">{{$category->title}}</option> -->
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Title <span class="req-field">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Title Name" name="title" id="title" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                <p class="fs-6 text-danger"> {{ $errors->first('title') }} </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Enter Description" rows="3" name="description" id="Description">{{ old('description') }}</textarea>

                            </div>

                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Category Image</label>
                                <input class="form-control" type="file" id="image" name="image" onchange="preview()">
                               


                                <img id="frame" src="{{ get_no_image() }}" alt="No Image" width="100px" height="100px" />
                                @if ($errors->has('image'))
                                <p class="fs-6 text-danger"> {{ $errors->first('image') }} </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked {{ old('status', 1) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="0" {{ old('status') === '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio3">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Do you want to show category in home?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name=" display_on_home" {{ old('display_on_home') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-3">
                            <div class="mb-2">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" name="sort_order" id="statusOptions" value="{{ old('sortorder', $sortorder) }}" oninput="validateInput(this)">
                            </div>
                        </div>
                        @if (session('error'))
                        <div style="color: red;">
                            {{ session('error') }}
                        </div>
                        @endif

                    </div>
                    <!-- Row end -->
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{route('admin.categories.index')}}"> <button type="button" class="btn btn-outline-secondary">
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
@push('scripts')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<script>
    $(document).ready(function() {
        $('#category_id').select2({
            placeholder: "Select Category...",

        });
        $('#myForm').on('submit', function(e) {
            var isValid = true;

            // Clear previous error messages
            $('.form-control, .form-select').removeClass('is-invalid');
            $('.fs-6.text-danger').remove();

            // Validate title
            if ($('#title').val().trim() === '') {
                $('#title').addClass('is-invalid');
                $('#title').after('<p class="fs-6 text-danger">Title is required.</p>');
                isValid = false;
            }


            // Prevent form submission if invalid
            if (!isValid) {
                e.preventDefault();
            }
        });
    });





    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }


    function validateInput(element) {
        element.value = element.value.replace(/[^0-9.]/g, '');
        if (element.value !== '' && parseFloat(element.value) <= 0) {
            element.value = '';
        }
    }
</script>
@endpush

<!-- @dump($errors); -->
