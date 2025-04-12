@extends('admin.layouts.design')
@section('body')

<style>
    .error {
        color: red;
    }
</style>

<form action="{{ route('admin.keyword.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
    @csrf
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Game Keyword</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Game Id<span class="req-field">*</span></label>
                                <select class="form-select" name="game_id" id="game_id" value="{{old('game_id')}}">
                                    <option value="" disabled selected>Select Game Keyword</option>
                                    @foreach($games as $game)
                                    <option value="{{$game->id}}">{{$game->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('game_id'))
                                <p class="fs-6 text-danger"> {{ $errors->first('game_id') }} </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                            <label class="form-label">Select Game Keyword </label>
                                <select class="form-control choices-multiple" name="game_keyword[]" id="game_keyword" size="10" multiple="multiple">
                                @foreach($games as $game)
                                <option value="noob prank free fire">{{$game->name}}</option>
                                @endforeach
                                    <!-- <option value="squirrel">squirrel</option>
                                    <option value="Ball fake">Ball fake</option>
                                    <option value="magic stone">magic stone</option>
                                    <option value="blaze">blaze</option> -->
                                </select>
                                @if ($errors->has('game_keyword'))
                                <p class="fs-6 text-danger"> {{ $errors->first('game_keyword') }} </p>
                                @endif
                            </div>

                        </div>
                    </div>
                    <!-- Row end -->
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{route('admin.countries.index')}}"><button type="button" class="btn btn-outline-secondary">
                                Cancel
                            </button>
                        </a>
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myForm').on('submit', function(e) {
            var isValid = true;

            // Clear previous error messages
            $('.form-control').removeClass('is-invalid');
            $('.form-select').removeClass('is-invalid');
            $('.fs-6.text-danger').remove();



            // Validate game id
            if ($('#game_id').val().trim() === '') {
                $('#game_id').addClass('is-invalid');
                $('#game_id').after('<p class="fs-6 text-danger">game Id is required.</p>');
                isValid = false;
            }

             // Validate keyword
             if ($('#game_keyword').val().trim() === '') {
                $('#game_keyword').addClass('is-invalid');
                $('#game_keyword').after('<p class="fs-6 text-danger">game_keyword is unique.</p>');
                isValid = false;
            }

            // Prevent form submission if invalid
            if (!isValid) {
                e.preventDefault();
            }
        });


    });
    $(document).ready(function() {
    $(".choices-multiple").select2({
        tags: true,                // Enable tagging
        tokenSeparators: [',', ' '], // Allow tagging with commas and spaces
        placeholder: "Enter a keyword" // Placeholder text
    });
});


</script>
