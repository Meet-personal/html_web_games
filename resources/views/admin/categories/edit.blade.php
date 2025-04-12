 @extends('admin.layouts.design')
 @section('body')

 <form action="{{ route('admin.categories.update', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
     @csrf
     <div class="row gx-3">
         <div class="col-xxl-12">
             <div class="card mb-3">
                 <div class="card-header">
                     <h5 class="card-title">Edit Category</h5>
                 </div>
                 <div class="card-body">
                     <!-- Row start -->

                     <div class="row gx-3">

                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Parent Category</label>
                                 <select class="form-select" name="category_id" id="category_id">
                                     <option value="0" {{ $category->category_id == 0 ? 'selected' : '' }}>Select</option>
                                     @foreach($categories as $categoryItem)
                                     <option value="{{ $categoryItem->id }}" {{ ($categoryItem->id == $category->category_id) ? 'selected' : '' }}>
                                         {{ $categoryItem->title }}
                                     </option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Title <span class="req-field">*</span></label>
                                 <input type="text" class="form-control" placeholder="Enter Category Name" name="title" id="title" value="{{ old('title', $category->title) }}">
                                 @if ($errors->has('title'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('title') }} </p>
                                 @endif
                             </div>
                         </div>

                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Description </label>

                                 <textarea class="form-control" placeholder="Enter Description" rows="3" name="description">{{ old('description', $category->description) }}</textarea>


                             </div>
                         </div>
                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label for="formFile" class="form-label">Category Image</label>
                                 <input class="form-control" type="file" id="frame" name="image"  onchange="preview()">
                                 <img id="imagePreview" src="{{asset('storage/'.$category->image)}}" width="100px">
                                 <!-- @if(!empty($category->image))
                                 <img src="{{asset('storage/'.$category->image)}}" width="70px" height="50px">
                                 @else
                                 <img src="{{get_no_image()}}" width="70px" height="50px">
                                 @endif -->
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
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ old('status', $category->status) == '1' ? 'checked' : '' }}>
                                         <label class="form-check-label" for="inlineRadio1">Active</label>
                                     </div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="0" {{ old('status', $category->status) == '0' ? 'checked' : '' }}>
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
                                         <input class="form-check-input" type="checkbox" value="1" id="inlineCheckbox1" name="display_on_home" @checked($category->display_on_home)>
                                         <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-6 col-3">
                             <div class="mb-2">
                                 <label class="form-label">Sort Order</label>
                                 <input type="number" class="form-control" name="sort_order" id="sort_order" value="{{$category->sort_order}}" oninput="validateInput(this)">
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



             // Prevent form submission if invalid
             if (!isValid) {
                 e.preventDefault();
             }
         });
     });

     function validateInput(element) {
        element.value = element.value.replace(/[^0-9.]/g, '');
        if (element.value !== '' && parseFloat(element.value) <= 0) {
            element.value = '';
        }
    }






     function preview() {
         var fileInput = document.getElementById('frame');
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
