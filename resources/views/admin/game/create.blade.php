@extends('admin.layouts.design')
@section('body')
    <form action="{{ route('admin.game.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
        @csrf
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Games</h5>
                    </div>
                    <div class="card-body">
                        <!-- Row start -->
                        <div class="row gx-3">



                            <div class="col-lg-6 col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="req-field">*</span> </label>
                                    <select class="form-select" name="category_id" id="category_id"
                                        value="{{ old('category_id') }}">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <p class="fs-6 text-danger"> {{ $errors->first('category_id') }} </p>
                                    @endif
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Name <span class="req-field">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                        id="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <p class="fs-6 text-danger"> {{ $errors->first('name') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">URL <span class="req-field">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter URL" name="url"
                                        id="url" value="{{ old('url') }}">
                                    @if ($errors->has('url'))
                                        <p class="fs-6 text-danger"> {{ $errors->first('url') }} </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Description <span class="req-field">*</span></label>
                                    <textarea class="form-control" placeholder="Enter Description" rows="3" name="description" id="description">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <p class="fs-6 text-danger"> {{ $errors->first('description') }} </p>
                                    @endif
                                </div>

                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label"> Image <span class="req-field">*</span></label>
                                    <input class="form-control" type="file" id="image" name="image"
                                        value="{{ old('image') }}" onchange="preview()">
                                    <img id="frame" src="{{ get_no_image() }}" alt="No Image" width="100px"
                                        height="100px" />
                                    @if ($errors->has('image'))
                                        <p class="fs-6 text-danger"> {{ $errors->first('image') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Vertical Image <span class="req-field">*</span></label>
                                    <input class="form-control" type="file" id="vertical_image" name="vertical_image"
                                        value="{{ old('vertical_image') }}" onchange="preview()">
                                    <img id="frame" src="{{ get_no_image() }}" alt="No Image" width="50px"
                                        height="100px" />
                                    @if ($errors->has('vertical_image'))
                                        <p class="fs-6 text-danger"> {{ $errors->first('vertical_image') }} </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-3 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                                value="1" checked {{ old('status', 1) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="inlineRadio3" value="0"
                                                {{ old('status') === '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio3">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Is Game Display On Home ?</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="1" name=" display_on_home"
                                                {{ old('display_on_home') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-3">
                                <div class="mb-2">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" id="statusOptions"
                                        value="{{ old('sortorder', $sortorder) }}" min="1"
                                        oninput="validateInput(this)">
                                </div>
                            </div>
                            @if (session('error'))
                                <div style="color: red;">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="col-sm-6 col-3">
                                <div class="mb-2 ">
                                    <label class="form-label">Select Game Keyword <span class="req-field">*</span>
                                    </label>
                                    <select class="form-control choices-multiple" name="keyword[]" id="keyword"
                                        size="10" multiple="multiple">

                                        @foreach ($unqKeywords as $keyword)
                                            <option value="{{ $keyword }}"
                                                {{ in_array($keyword, old('keyword', [])) ? 'selected' : '' }}>
                                                {{ $keyword }}</option>
                                        @endforeach

                                    </select>

                                    @if ($errors->has('keyword'))
                                        <p class="fs-6 text-danger"> {{ $errors->first('keyword') }} </p>
                                    @endif
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-sm-6 col-3 mt-3">
                                    <div class="mb-3">
                                        <label class="form-label">Need To Trending?</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    value="1" name=" flag" {{ old('flag') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row ">

                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary " onclick="append_form(event)">
                                        Add More Image
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                    </div>
                    <div id="append_form">
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.game.index') }}"> <button type="button"
                                    class="btn btn-outline-secondary">
                                    Cancel
                                </button>
                            </a>
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="req-field"></div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#category_id').select2({
                placeholder: "Select Category...",
            });
            $(".choices-multiple").select2({
                tags: true, // Enable tagging
                tokenSeparators: [',', ' '], // Allow tagging with commas and spaces
                placeholder: "Enter a keyword" // Placeholder text
            });
        });

        function refresh() {
            location.reload();
        }

        $('#myForm').on('submit', function(e) {
            var isValid = true;

            // Clear previous error messages
            $('.form-control, .form-select').removeClass('is-invalid');
            $('.fs-6.text-danger').remove();

            // Validate category
            if ($('#category_id').val().trim() === '') {
                $('#category_id').addClass('is-invalid');
                $('#category_id').after('<p class="fs-6 text-danger">Category is required.</p>');
                isValid = false;
            }

            // Validate name
            if ($('#name').val().trim() === '') {
                $('#name').addClass('is-invalid');
                $('#name').after('<p class="fs-6 text-danger">Name is required.</p>');
                isValid = false;
            }

            // Validate URL
            if ($('#url').val().trim() === '') {
                $('#url').addClass('is-invalid');
                $('#url').after('<p class="fs-6 text-danger">URL is required.</p>');
                isValid = false;
            }

            // Validate description
            if ($('#description').val().trim() === '') {
                $('#description').addClass('is-invalid');
                $('#description').after('<p class="fs-6 text-danger">Description is required.</p>');
                isValid = false;
            }

            // Validate image
            if ($('#image')[0].files.length === 0) {
                $('#image').addClass('is-invalid');
                $('#image').after('<p class="fs-6 text-danger">Image is required.</p>');
                isValid = false;
            }

            // Validate keywords
            if ($('#keyword').val().length === 0) {
                $('#keyword').addClass('is-invalid');
                $('#keyword').after('<p class="fs-6 text-danger">At least one keyword is required.</p>');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
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

        // ===============================web games images=======================================================



        let formCount = 0;

        function append_form() {
            formCount++;
            let htmlDynamicContent = getDynamicHTML(formCount);
            $('#append_form').append(htmlDynamicContent);
        }

        function getDynamicHTML(formCount) {
            return `
    <div class="card-body" id="card-${formCount}">
        <div class="row gx-3">
            <div class="col-sm-6 col-12">
                <div class="mb-3">
                    <label for="formFile_${formCount}" class="form-label">Image</label>
                    <input class="form-control" type="file" id="formFile_${formCount}" name="game_images[]">
                </div>
            </div>
            <div class="col-sm-4 col-3">
                <div class="mb-2">
                    <label class="form-label">Sort Order</label>
                     <input type="number" name="game_sort_order[]" class="form-control" id="sort_order_${formCount}" value="{{ old('game_sort_order') }}">
                </div>
            </div>
            <div class="col-sm-2 col-3 ">
                <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-danger btn-rmv-game-img" onclick="removeForm(${formCount})">Remove</button>
                </div>
            </div>
        </div>
    </div>
`;

        }

        function removeForm(formId) {
            $(`#card-${formId}`).remove();
        }
    </script>
@endpush
