 @extends('admin.layouts.design')
 @section('body')

 <form action="{{ route('admin.cities.update', ['id' => $cities->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
     @csrf
     <div class="row gx-3">
         <div class="col-xxl-12">
             <div class="card mb-3">
                 <div class="card-header">
                     <h5 class="card-title">City</h5>
                 </div>
                 <div class="card-body">
                     <!-- Row start -->
                     <div class="row gx-3">
                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Country<span class="req-field">*</span></label>
                                 <select class="form-select" name="country_id" id="country_id" value="{{ old('country_id', $cities->country_id)? 'selected' : '' }}">
                                     <option value="0">Select</option>
                                     @foreach($countries as $country)
                                     <option value="{{ $country->id }}" {{ old('country_id', $cities->country_id) == $country->id ? 'selected' : '' }}>
                                         {{ $country->country }}
                                     </option>
                                     @endforeach
                                 </select>
                                 @if ($errors->has('country_id'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('country_id') }} </p>
                                 @endif
                             </div>

                         </div>
                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">State<span class="req-field">*</span></label>
                                 <select class="form-select" name="state_id" id="state_id" value="{{ old('state_id', $cities->state_id)? 'selected' : '' }}">
                                     @foreach($states as $state)
                                     <option value="{{ $state->id }}" {{ old('state_id', $cities->state_id) == $state->id ? 'selected' : '' }}>
                                         {{ $state->state }}
                                     </option>
                                     @endforeach
                                 </select>
                                 @if ($errors->has('state_id'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('state_id') }} </p>
                                 @endif
                             </div>

                         </div>

                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">City<span class="req-field">*</span></label>
                                 <input type="text" class="form-control" placeholder="Enter City Name" name="city" id="city" value="{{ old('city', $cities->city) }}">
                                 @if ($errors->has('city'))
                                 <p class="fs-6 text-danger"> {{ $errors->first('city') }} </p>
                                 @endif

                             </div>
                         </div>



                         <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked >
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


                     <div class="card-footer">
                         <div class="d-flex gap-2 justify-content-end">
                             <a href="{{route('admin.cities.index')}}"> <button type="button" class="btn btn-outline-secondary">
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
             $('.form-control, .form-select').removeClass('is-invalid');
             $('.fs-6.text-danger').remove();

             // Validate city
             if ($('#city').val().trim() === '') {
                 $('#city').addClass('is-invalid');
                 $('#city').after('<p class="fs-6 text-danger">City name is required.</p>');
                 isValid = false;
             }
             // country id
             if ($('#country_id').val().trim() === '') {
                 $('#country_id').addClass('is-invalid');
                 $('#country_id').after('<p class="fs-6 text-danger">City name is required.</p>');
                 isValid = false;
             }
             // state id
             if ($('#state_id').val().trim() === '') {
                 $('#state_id').addClass('is-invalid');
                 $('#state_id').after('<p class="fs-6 text-danger">City name is required.</p>');
                 isValid = false;
             }

             // Prevent form submission if invalid
             if (!isValid) {
                 e.preventDefault();
             }
         });


     });
 </script>
