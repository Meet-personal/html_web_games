 @extends('admin.layouts.design')
 @section('body')
 <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
 <form action="{{ route('admin.game.update', ['id' => $game->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
     @csrf
     <div class="row gx-3">
         <div class="col-xxl-12">
             <div class="card mb-3">
                 <div class="card-header">
                     <h5 class="card-title">Edit Games</h5>
                 </div>
                 <div class="card-body">
                     <!-- Row start -->
                     <div class="row gx-3">
                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Category <span class="req-field">*</span></label>
                                 <select class="form-select" name="category_id" value="{{ old('category_id', $game->category_id)? 'selected' : ''}}"id="category_id">
                                     <option value="0" {{ $game->category_id == 0 ? 'selected' : '' }}>Select</option>
                                     @foreach($categories as $category)
                                     <option value="{{ $category->id }}" {{ ($game->category_id == $category->id) ? 'selected' : '' }}>
                                         {{ $category->title }}
                                     </option>
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
                                 <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $game->name) }}">
                                 @if ($errors->has('name'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('name') }} </p>
                                 @endif
                             </div>
                         </div>
                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">URL<span class="req-field">*</span></label>
                                 <input type="text" class="form-control" placeholder="Enter URL" name="url" id="url" value="{{old('url', $game->url)}}">
                                 @if ($errors->has('url'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('url') }} </p>
                                 @endif
                             </div>
                         </div>


                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Description <span class="req-field">*</span></label>
                                 <textarea class="form-control" placeholder="Enter Description" rows="3" name="description">{{ old('description', $game->description) }}</textarea>
                                 @if ($errors->has('description'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('description') }} </p>
                                 @endif

                             </div>
                         </div>
                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label for="formFile" class="form-label">Image<span class="req-field">*</span></label>
                                 <input class="form-control" type="file" id="frame" name="image" onchange="preview()">

                                 <img id="imagePreview" src="{{asset('storage/'.$game->image)}}" width="100px">
                                 <!-- @if($game->image)
                                 <img src="{{asset('storage/'.$game->image)}}" width="100px">
                                 @else
                                 <img src="{{asset('no-image.png')}}" width="100px">
                                 @endif -->
                                 @if ($errors->has('image'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('image') }} </p>
                                 @endif
                             </div>
                         </div>
                         <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Vertical Image<span class="req-field">*</span></label>
                                <input class="form-control" type="file" id="frame" name="vertical_image" onchange="preview()">

                                <img id="imagePreview" src="{{asset('storage/'.$game->vertical_image)}}" width="100px">

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
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ old('status', $game->status) == '1' ? 'checked' : '' }}>
                                         <label class="form-check-label" for="inlineRadio1">Active</label>
                                     </div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="0" {{ old('status', $game->status) == '0' ? 'checked' : '' }}>
                                         <label class="form-check-label" for="inlineRadio3">Inactive</label>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Is Category Display On Home</label>
                                 <div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="checkbox" value="1" id="inlineCheckbox1" name="display_on_home" @checked($game->display_on_home)>
                                         <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!-- <div class="col-sm-3 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Is Category Display On Home</label>
                                 <div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name=" display_on_home">
                                         <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                     </div>
                                 </div>
                             </div>
                         </div> -->

                         <div class="col-sm-6 col-3">
                             <div class="mb-2">
                                 <label class="form-label">Sort Order</label>
                                 <input type="number" name="sort_order" class="form-control" id="statusOptions" value="{{($game->sort_order) }}" min="1" oninput="validateInput(this)">
                             </div>
                             @if (session('error'))
                             <div style="color: red;">
                                 {{ session('error') }}
                             </div>
                             @endif
                         </div>
                         <div class="col-sm-6 col-4">
                             <label class="form-label">Select Game Keyword <span class="req-field">*</span> </label>
                             ` <select class="form-control choices-multiple" name="keyword[]" id="keyword" size="10" multiple="multiple">
                                 @foreach($unqKeywords as $unqKeyword)
                                 @foreach(explode(',',$unqKeyword) as $item)
                                 <option value="{{$item}}"
                                     {{ in_array($item, explode(',', $game->keyword)) ? 'selected' : '' }}>{{$item}}</option>
                                 @endforeach
                                 @endforeach
                             </select>
                             </select>`
                             @if ($errors->has('keyword'))
                             <p class="fs-6 text-danger"> {{ $errors->first('keyword') }} </p>
                             @endif
                         </div>
                         <!-- <div class="row"> -->
                         <div class="col-sm-6 col-3 mt-3">
                             <div class="mb-3">
                                 <label class="form-label">Need To trending?</label>
                                 <div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name=" flag" @checked($game->flag)>
                                         <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!-- </div> -->
                         <div class="row ">
                             <div class="col-md-12 d-flex justify-content-end mb-3">
                                 <button type="button" class="btn btn-primary " onclick="append_form(event)">
                                     Add More Image
                                 </button>
                             </div>
                         </div>
                     </div>

                     <!-- Row end -->
                     <div id="append_form">

                         @foreach($game->gameImages as $key => $gameImage)
                         <input type="hidden" name="game_image_id[]" value="{{$gameImage->id}}" />
                         <div class="card-body" id="card-{{$gameImage->id}}">
                             <div class="row gx-3">
                                 <div class="col-sm-6 col-12">
                                     <div class="mb-3">
                                         <label for="formFile_{{$key}}" class="form-label">Image</label>
                                         <input class="form-control" type="file" id="formFile_{{$key}}" name="game_images[]">
                                         @if(!empty($gameImage->image))
                                         <img src="{{common_image($gameImage->image)}}" width="100" height="100">
                                         @else
                                         <img id="frame" src="{{ get_no_image() }}" alt="No Image" width="100px" height="100px" />
                                         @endif
                                     </div>
                                 </div>
                                 <div class="col-sm-4 col-3">
                                     <div class="mb-2">
                                         <label class="form-label">Sort Order</label>
                                         <input type="number" name="game_sort_order[]" class="form-control" id="statusOptions" value="{{$gameImage->sort_order}}">
                                     </div>
                                 </div>
                                 <div class="col-sm-2 col-3 ">
                                     <div class="d-flex justify-content-end">
                                         <button type="button" class="btn btn-danger btn-rmv-game-img" onclick="deleteGameImage({{$gameImage->id}})">Remove</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endforeach

                     </div>
                     <div class="card-footer">
                         <div class="d-flex gap-2 justify-content-end">
                             <a href="{{route('admin.game.index')}}">
                                 <button type="button" class="btn btn-outline-secondary">
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
     </div>
 </form>
 @endsection

 @push('scripts')



 <script>
     function deleteGameImage(id) {
         let deleteGameUrl = "{{ route('admin.game-images.delete', ['id' => 'ID']) }}";
         let url = deleteGameUrl.replace('ID', id);
         Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             if (result.isConfirmed) {
                 $.ajax({
                     url: url,
                     type: 'DELETE',
                     data: {
                         _token: '{{ csrf_token() }}'
                     },
                     success: function(response) {
                         if (response.success) {
                             Swal.fire(
                                 'Deleted!',
                                 response.message,
                                 'success'
                             );
                             $(`#card-${id}`).remove();
                         } else {
                             Swal.fire(
                                 'Failed!',
                                 response.message,
                                 'error'
                             );
                         }
                     },
                     error: function() {
                         Swal.fire(
                             'Error!',
                             'An error occurred while deleting the item.',
                             'error'
                         );
                     }
                 });
             }
         });
     }



     //      function preview() {
     //     frame.src=URL.createObjectURL(event.target.files[0]);
     // }
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

     function validateInput(element) {
         element.value = element.value.replace(/[^0-9.]/g, '');
         if (element.value !== '' && parseFloat(element.value) <= 0) {
             element.value = '';
         }
     }

     //  =================================================================================================

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
                     <input type="number" name="game_sort_order" class="form-control" id="sort_order_${formCount}" value="{{old('sort_order')}}">
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
