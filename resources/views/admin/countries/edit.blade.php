 @extends('admin.layouts.design')
 @section('body')

 <form action="{{ route('admin.countries.update', ['id' => $country->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
     @csrf
     <div class="row gx-3">
         <div class="col-xxl-12">
             <div class="card mb-3">
                 <div class="card-header">
                     <h5 class="card-title">Countries</h5>
                 </div>
                 <div class="card-body">
                     <!-- Row start -->
                     <div class="row gx-3">

                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                             <label class="form-label">Country <span class="req-field">*</span></label>
                             <input type="text" class="form-control" placeholder="Enter Country Name" name="country" id="country"value="{{ old('country', $country->country) }}">
                             @if ($errors->has('country'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('country') }} </p>
                                 @endif


                            </div>
                         </div>
                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Code<span class="req-field">*</span> </label>
                                 <input type="text" class="form-control" placeholder="Enter Category Name" name="code" id="code" value="{{ old('code', $country->code) }}">
                                 @if ($errors->has('code'))
                                    <p class="fs-6 text-danger"> {{ $errors->first('code') }} </p>
                                 @endif
                                </div>
                         </div>


                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label for="flag" class="form-label">Flag</label>
                                 <input class="form-control" type="file" id="flag" name="flag" onchange="preview()">
                                 <img id="imagePreview" src="{{asset('storage/'.$country->flag)}}" width="100px">
                                 <!-- @if($country->flag)
                                 <img src="{{asset('storage/'. $country->flag)}}" width="70px" height="50px">
                                 @else
                                 <img id="frame" src="{{ get_no_image() }}" alt="No Image" width="100px" height="100px"/>
                                 @endif -->
                             </div>
                         </div>

                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Status</label>
                                 <div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{($country->status == 1) ? 'checked':''}}>
                                         <label class="form-check-label" for="inlineRadio1">Active</label>
                                     </div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="0" {{($country->status == 0) ? 'checked':''}}>
                                         <label class="form-check-label" for="inlineRadio3">Inactive</label>
                                     </div>
                                 </div>
                             </div>


                         </div>


                 <div class="card-footer">
                     <div class="d-flex gap-2 justify-content-end">
                       <a href="{{route('admin.countries.index')}}">  <button type="button" class="btn btn-outline-secondary">
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
 <script>
    $(document).ready(function() {
        $('#editForm').on('submit', function(e) {
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
    var fileInput = document.getElementById('flag');
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

