@extends('admin.layouts.design')

@section('body')

<style>
    .error {
        color: red;
    }


</style>


<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
    @csrf
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Banners</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Category </label>
                                <select class="form-select" name="category_id" id="category_id" >
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->title}}</option>
                                    <!-- <option value="{{$category->id}}">{{$category->title}}</option> -->
                                    @endforeach
                                </select>
                              
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Game </label>
                                <select class="form-select" name="game_id" id="game_id" value="{{old('game_id')}}">
                                    <option value="">Select</option>
                                    @foreach($games as $game)
                                    <option value="{{$game->id}}" {{ old('game_id') == $game->id ? 'selected' : '' }}>{{$game->name}}</option>
                                    <!-- <option value="{{$game->id}}">{{$game->name}}</option> -->
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Type<span class="req-field">*</span></label>





                                <select class="form-select" name="type" id="type" value="{{old('type')}}" >
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select Type</option>
                                    <option value="home" {{ old('type') == 'home' ? 'selected' : '' }}>home</option>
                                    <option value="games" {{ old('type') == 'games' ? 'selected' : '' }}>games</option>
                                </select>
                                @error('type')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror" placeholder="Enter Type" name="type" id="type" value="{{ old('type') }}">
                                @error('type')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> -->

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Title <span class="req-field">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title" name="title" id="title" value="{{ old('title') }}">
                                @error('title')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Description <span class="req-field">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description" rows="3" name="description" id="description">{{ old('description') }}</textarea>
                                @error('description')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Image<span class="req-field">*</span> </label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"  onchange="preview()" value="{{old('image')}}">
                                <img id="frame" src="{{ get_no_image() }}" width="100px" height="100px"  value="{{old('image')}}" />
                                @error('image')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
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
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">URL </label>
                                <input type="text" class="form-control" placeholder="Enter URL" name="url" id="url" value="{{old('url')}}">

                            </div>
                        </div>



                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" id="statusOptions" value="{{ old('sort_order', $sortorder) }}" oninput="validateInput(this)">
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
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
@push('scripts')




<script>
    $(document).ready(function() {

        $('#type').select2({
            placeholder: "Choose Type...",

        });

        $('#game_id').select2({
            placeholder: "Select Game ...",

        });

        $('#category_id').select2({
            placeholder: "Select Category...",

        });
        $('#myForm').on('submit', function(e) {
            var isValid = true;

            // Clear previous error messages
            $('.form-control, .form-select').removeClass('is-invalid');
            $('.fs-6.text-danger').remove();





            // Validate type
            if ($('#type').val().trim() === '') {
                $('#type').addClass('is-invalid');
                $('#type').after('<p class="fs-6 text-danger">type is required.</p>');
                isValid = false;
            }

            // Validate title
            if ($('#title').val().trim() === '') {
                $('#title').addClass('is-invalid');
                $('#title').after('<p class="fs-6 text-danger">Title is required.</p>');
                isValid = false;
            }

            // Validate description
            if ($('#description').val().trim() === '') {
                $('#description').addClass('is-invalid');
                $('#description').after('<p class="fs-6 text-danger">Description is required.</p>');
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
