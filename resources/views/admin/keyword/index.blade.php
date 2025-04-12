@extends('admin.layouts.design')
@section('body')
<style>
    #keywords_table_paginate,
    #keywords_table_filter {
        display: flex;
        justify-content: end;
        margin-top: 10px;
    }
</style>

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h5 class="card-title"> Game Keyword</h5>
                </div>
                <div class="d-flex justify-content-end mb-1">
                    <a id="btn-add-country" class="btn btn-primary" href="{{route('admin.keyword.create')}}"> <i class="fa fa-plus" aria-hidden="true"></i>
                        Create </a>
                </div>
            </div>

            <div class="card-body">
                <table id="countries_table" class="table align-middle table-hover m-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Game Id</th>
                            <th>Keyword</th>
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
        $('#keywords_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.keyword.data') }}",
            columns: [{
                    data: 'game_id'
                },

                {
                    data: 'game_keyword'
                },
                {
                    data: 'code'
                },



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

        let editkeywordUrl = "{{ route('admin.keyword.edit', ['id' => 'ID']) }}";

        console.log('1234', editkeywordUrl);
        let url = editkeywordUrl.replace('ID', id);

        // Redirect to the edit page
        window.location.href = url;
    }
</script>
@endpush
