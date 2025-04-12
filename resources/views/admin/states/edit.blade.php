@extends('admin.layouts.design')

@section('body')

<form action="{{ route('admin.states.update', ['id' => $states->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
    @csrf

    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title"> State</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">


                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Country Id <span class="req-field">*</span></label>
                                <select class="form-select @error('country_id') is-invalid @enderror" name="country_id" id="country_id" required>
                                    <option value="0">Select</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id', $states->country_id) == $country->id ? 'selected' : '' }}>
                                        {{ $country->country }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">State Name <span class="req-field">*</span></label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" placeholder="Enter State Name" name="state" id="state" value="{{ old('state', $states->state) }}">
                                @error('state')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Code <span class="req-field">*</span></label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Code" name="code" id="code" value="{{ old('code', $states->code) }}">
                                @error('code')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ old('status', $states->status) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ old('status', $states->status) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                    </div>

                                    @error('status')
                                    <p class="fs-6 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Row end -->
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.states.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">Update</button>
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
