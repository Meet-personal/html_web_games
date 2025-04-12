@extends('admin.layouts.design')
@section('body')

<style>
    .form-control:disabled {
        background-color: #F9F9F9; /* Light gray background */
        color: #0A0B0C; /* Gray text color */
        cursor: not-allowed; /* Show a not-allowed cursor */
    }
</style>

<form action="{{ route(('admin.categories.view'),['id' => $category->id]) }}" method="get" enctype="multipart/form-data" id="myForm">
    @csrf

    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">View Category</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Parent Category</label>
                                <input type="text" class="form-control" name="category_id" id="category_id" value="{{  $category->parentCategory ? $category->parentCategory->title : "-"}}" disabled>
                            </div>

                        </div>
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Title </label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $category->title)}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Enter Description" rows="3" name="description" disabled>{{ old('description', $category->description) }}</textarea>

                            </div>

                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Category Image</label>
                                <input class="form-control" type="file" id="formFile" name="image" disabled>
                                @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}" width="70px" height="50px" alt="Game Image">
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ $category->status == 1 ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ $category->status == 0 ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Is Category Displayed On Home</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="displayOnHomeCheckbox" name="display_on_home" {{ $category->display_on_home ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="displayOnHomeCheckbox">Yes</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-3">
                            <div class="mb-2">
                                <label class="form-label">Sort Order</label>
                                <input type="text" class="form-control" name="sort_order" id="sort_order" value="{{ old('sort_order', $category->sort_order)}}" disabled>
                            </div>
                        </div>

                    </div>
                    <!-- Row end -->
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{route('admin.categories.index')}}"> <button type="button" class="btn btn-success" onclick="window.history.back();">
                                Back
                            </button>
                        </a>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div id="errors"></div>
@endsection


<!-- @dump($errors); -->
