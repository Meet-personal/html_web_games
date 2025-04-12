@extends('admin.layouts.design')
@section('body')

<style>
    .error {
        color: red;
    }
</style>

<form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
    @csrf
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Faqs</h5>
                </div>



                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">
                    <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Country Id<span class="req-field">*</span></label>

                                <select class="form-select" name="country_id" id="country_id" value="{{old('country_id')}}">
                                <option value="0" disabled {{ old('country_id') ? '' : 'selected' }}>Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Question<span class="req-field">*</span></label>
                                <textarea class="form-control" placeholder="Enter question" rows="3" name="question" id="question">{{ old('question') }}</textarea>
                                @error('question')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Answer <span class="req-field">*</span></label>
                                <textarea class="form-control" rows="3" placeholder="Enter Answer"  name="answer" id="answer">{{ old('answer') }}</textarea>
                                @error('answer')
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



                    <!-- Row end -->
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                     <a href="{{route('admin.faqs.index')}}">   <button type="button" class="btn btn-outline-secondary">
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
<!-- @dump($errors); -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#country_id').select2({
            placeholder: "Choose tags...",

        });

    $('#myForm').on('submit', function(e) {
        var isValid = true;

        // Clear previous error messages
        $('.form-control, .form-select').removeClass('is-invalid');
        $('.fs-6.text-danger').remove();






        // Validate question
        if ($('#question').val().trim() === '') {
            $('#question').addClass('is-invalid');
            $('#question').after('<p class="fs-6 text-danger">Question is required.</p>');
            isValid = false;
        }

        // Validate answer
        if ($('#answer').val().trim() === '') {
            $('#answer').addClass('is-invalid');
            $('#answer').after('<p class="fs-6 text-danger">Answer is required.</p>');
            isValid = false;
        }

        //country_id validation
        if ($('#country_id').val().trim() === '') {
            $('#country_id').addClass('is-invalid');
            $('#country_id').after('<p class="fs-6 text-danger">country Id is required.</p>');
            isValid = false;
        }



        // Prevent form submission if invalid
        if (!isValid) {
            e.preventDefault();
        }
    });


});
</script>
@endpush
