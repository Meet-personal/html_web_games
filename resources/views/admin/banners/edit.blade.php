 @extends('admin.layouts.design')
 @section('body')
<!-- select 2 -->

 <form action="{{ route('admin.banners.update', ['id' => $banners->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
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
                                 <label class="form-label">Category Id</label>

                                 <select class="form-select" name="category_id" id="category_id">
                                     <option value="">Select</option>
                                     @foreach($categories as $category)
                                     <option value="{{ $category->id }}" {{ old('category_id', $banners->category_id) == $category->id ? 'selected' : '' }}>
                                         {{ $category->title }}
                                     </option>
                                     @endforeach
                                 </select>
                               
                             </div>

                         </div>

                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Game Id</label>
                                 <select class="form-select" name="game_id" id="game_id">
                                     <option value="">Select</option>
                                     @foreach($games as $game)
                                     <option value="{{ $game->id }}" {{ old('game_id', $banners->game_id) == $game->id ? 'selected' : '' }}>
                                         {{ $game->name }}
                                     </option>
                                     @endforeach
                                 </select>

                             </div>
                         </div>


                         <!-- <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Game Id</label>
                                 <select class="form-select" name="game_id" id="game_id">
                                     <option value="0" {{ old('game_id', $banners->game_id) == 0 ? 'selected' : '' }}>Select</option>
                                     @foreach($games as $game)
                                     <option value="{{ $game->id }}" {{ old('game_id', $banners->game_id) == $game->id ? 'selected' : '' }}>
                                         {{ $game->name }}
                                     </option>
                                     @endforeach
                                 </select>
                             </div>

                         </div> -->

                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Type<span class="req-field">*</span> </label>
                                 <select class="form-select" name="type" id="type">
                                     <option value="" disabled selected>Select Type</option>
                                     <option value="home"{{ old('type', $banners) === 'home' ? 'selected' : '' }}>home</option>
                                     <option value="games" {{ old('type', $banners) === 'games' ? 'selected' : '' }}>games</option>
                                 </select>


                                 @error('type')
                                 <p class="fs-6 text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                         </div>

                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Title <span class="req-field">*</span></label>
                                 <input type="text" class="form-control" placeholder="Enter Title Name" name="title" id="title" value="{{ old('title', $banners->title) }}">
                                 @if ($errors->has('title'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('title') }} </p>
                                 @endif
                             </div>
                         </div>
                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Description <span class="req-field">*</span></label>
                                 <textarea class="form-control" placeholder="Enter Description" rows="3" name="description" id="Description">{{ old('description', $banners->description) }}</textarea>
                                 @if ($errors->has('description'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('description') }} </p>
                                 @endif
                             </div>

                         </div>
                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label for="formFile" class="form-label">Image<span class="req-field">*</span></label>
                                 <input class="form-control" type="file" id="image" name="image" accept=".jpeg, .jpg, .png, .gif" onchange="preview()">

                                 <img id="imagePreview" src="{{asset('storage/'.$banners->image)}}" width="100px">
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
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ old('status', $banners->status) == '1' ? 'checked' : '' }}>
                                         <label class="form-check-label" for="inlineRadio1">Active</label>
                                     </div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="0" {{ old('status', $banners->status) == '0' ? 'checked' : '' }}>
                                         <label class="form-check-label" for="inlineRadio3">Inactive</label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-6 col-3">
                             <div class="mb-2">
                                 <label class="form-label">Sort Order</label>
                                 <input type="number" name="sort_order" class="form-control" id="statusOptions" value="{{ old('sort_order', $banners->sort_order) }}">

                             </div>
                             <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">URL </label>
                                <input type="text" class="form-control" placeholder="Enter URL" name="url" id="url" value="{{old('url', $banners->url)}}">
                                @if ($errors->has('url'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('url') }} </p>
                                 @endif
                            </div>
                        </div>
                             @if (session('error'))
                             <div style="color: red;">
                                 {{ session('error') }}
                             </div>
                             @endif
                         </div>

                     </div>
                     <!-- Row end -->
                 </div>
                 <div class="card-footer">
                     <div class="d-flex gap-2 justify-content-end">
                         <a href="{{route('admin.banners.index')}}"><button type="button" class="btn btn-outline-secondary">
                                 Cancel
                             </button>
                         </a>
                         <button type="submit" class="btn btn-success">
                             Update
                         </button>
                         </a>
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
            placeholder: "Select Game...",

        });

        $('#category_id').select2({
            placeholder: "Select Category...",

        });
         $('#editForm').on('submit', function(e) {


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
     // image preview
     function preview() {
         var fileInput = document.getElementById('image');
         var imagePreview = document.getElementById('imagePreview');

         // Ensure there's a file selected
         if (fileInput.files && fileInput.files[0]) {
             var reader = new FileReader();

             // Define what happens when the file is read
             reader.onload = function(e) {
                 imagePreview.src = e.target.result;
                 imagePreview.style.display = 'block'; // Show the image
             }

             // Read the file as a data URL
             reader.readAsDataURL(fileInput.files[0]);
         }
     }
 </script>
@endpush
