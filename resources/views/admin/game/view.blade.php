@extends('admin.layouts.design')
@section('body')
<style>
    .form-control:disabled {
        background-color: #F9F9F9; /* Light gray background */
        color: #0A0B0C; /* Gray text color */
        cursor: not-allowed; /* Show a not-allowed cursor */
    }
</style>

<form action="{{ route('admin.game.view', ['id' => $game->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
    @csrf
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">View Games</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" name="category_id" id="category_id" value="{{ $game->category->title }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $game->name }}"disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">URL<span class="req-field">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter URL" name="url" id="url" value="{{$game->url}}" disabled>
                                @if ($errors->has('url'))
                                <p class="fs-6 text-danger"> {{ $errors->first('url') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Description <span class="req-field">*</span></label>
                                <textarea class="form-control" placeholder="Enter Description" rows="3" name="description"disabled>{{ $game->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image <span class="req-field">*</span></label>
                                <input class="form-control" type="file" id="formFile" name="image"disabled>
                                @if($game->image)
                                    <img src="{{ asset('storage/'.$game->image) }}" width="70px" height="50px" alt="Game Image">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ $game->status == 1 ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ $game->status == 0 ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Is Category Displayed On Home</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="displayOnHomeCheckbox" name="display_on_home" {{ $game->display_on_home ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="displayOnHomeCheckbox">Yes</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-3">
                            <div class="mb-2">
                            <label class="form-label">Sort Order</label>
                            <input type="text" class="form-control" name="sort_order" id="sort_order" value="{{ old('sort_order', $game->sort_order) }}"disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                            <div class="col-sm-6 col-3 mt-3">
                                <div class="mb-3">
                                    <label class="form-label">Need To trending?</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name=" flag" {{ $game->flag ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Row end -->
                    <hr />
                    @foreach($game->gameImages as $key => $gameImage)
                        <div class="row gx-3">
                            <div class="col-sm-3 col-12">
                                <div class="mb-3">
                                    <label for="formFile_{{$key}}" class="form-label">Image</label>
                                    <img src="{{common_image($gameImage->image)}}" width="100" height="100">
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <div class="mb-2">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="game_sort_order" class="form-control" id="statusOptions" value="{{$gameImage->sort_order}}" disabled>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                      <a href="{{route('admin.game.index')}}">  <button type="button" class="btn btn-success" onclick="window.history.back();">
                            Back
                        </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
