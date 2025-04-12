@extends('admin.layouts.design')
@section('body')
<style>
    #cms_table_paginate,
    #cms_table_filter {
        display: flex;
        justify-content: end;
        margin-top: 10px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header">
                <h5 class="card-title"> CMS</h5>

            </div>

            <div class="card-body">
                <table id="cms_table" class="table align-middle table-hover m-0">
                    <thead>

                        <tr>
                            <th>Country</th>
                            <th>Title</th>
                            <th>Content</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#cms_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.cms.data') }}",
            columns: [

                {
                    data: 'country_id'
                },
                {
                    data: 'title'
                },
                {
                    data: 'content'
                },

                // {
                //     data: 'status'
                // },

                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });





    // =================================update data==================================
    function editItem(id) {

        // alert(1);

        let editCityUrl = "{{ route('admin.cms.edit', ['id' => 'ID']) }}";

        // console.log('1234', editCityUrl);
        let url = editCityUrl.replace('ID', id);

        // Redirect to the edit page
        window.location.href = url;
    }
</script>
@endpush
