 @extends('admin.layouts.design')
 @section('body')
<!-- ck editor -->
 <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
 <form action="{{ route('admin.cms.update', ['id' => $cms->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
     @csrf
     <div class="row gx-3">
         <div class="col-xxl-12">
             <div class="card mb-3">
                 <div class="card-header">
                     <h5 class="card-title">CMS Page</h5>
                 </div>
                 <div class="card-body">
                     <!-- Row start -->

                     <div class="row gx-3">

                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label"> Countries </label>
                                 <select class="form-select" name="country_id">
                                     <option value="0" {{ old('country_id', $cms->country_id) == 0 ? 'selected' : '' }}>Select</option>
                                     @foreach($countries as $country)
                                     <option value="{{ $country->id }}" {{ old('country_id', $cms->country_id) == $country->id ? 'selected' : '' }}>
                                         {{ $country->country }}
                                     </option>
                                     @endforeach
                                 </select>

                             </div>
                         </div>
                         <div class="col-lg-6 col-sm-4 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Title <span class="req-field">*</span></label>
                                 <input type="text" class="form-control" placeholder="Enter Title Name" name="title" id="title" value="{{ old('title', $cms->title) }}">
                             </div>
                         </div>

                         <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Content <span class="req-field">*</span></label>
                                 <textarea class="form-control" placeholder="Enter content" rows="3" name="content" id="editor">{{ old('content', $cms->content) }}</textarea>
                             </div>
                         </div>

                         <!-- <div class="col-sm-6 col-12">
                             <div class="mb-3">
                                 <label class="form-label">Status</label>
                                 <div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio1"  value="1" {{($cms->status == 1) ? 'checked':''}}>
                                         <label class="form-check-label" for="inlineRadio1">Active</label>
                                     </div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="status" id="inlineRadio3"  value="0" {{($cms->status == 0) ? 'checked':''}}>
                                         <label class="form-check-label" for="inlineRadio3">Inactive</label>
                                     </div>
                                 </div>
                             </div>


                         </div> -->


                         <!-- Row end -->
                     </div>
                     <div class="card-footer">
                         <div class="d-flex gap-2 justify-content-end">
                        <a href="{{route('admin.cms.index')}}"><button type="button" class="btn btn-outline-secondary">
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
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
