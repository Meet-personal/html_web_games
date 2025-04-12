@extends('admin.layouts.design')
@section('body')
<style>
    #countries_table_paginate,
    #countries_table_filter {
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
                    <h5 class="card-title"> Countries</h5>
                </div>
                <div class="d-flex justify-content-end mb-1">
                    <a id="btn-add-country" class="btn btn-primary" href="{{route('admin.countries.create')}}"> <i class="fa fa-plus" aria-hidden="true"></i>
                        Create </a>
                </div>
            </div>

            <div class="card-body">
                <table id="countries_table" class="table align-middle table-hover m-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Country</th>
                            <th>Code</th>
                            <th>Flag</th>
                            <th>Status</th>
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
        $('#countries_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.countries.data') }}",
            columns: [{
                    data: 'id'
                },

                {
                    data: 'country'
                },
                {
                    data: 'code'
                },

                {
                    data: 'flag'
                },

                {
                    data: 'status'
                },

                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    function deleteItem(id) {
        let deleteCountryUrl = "{{route('admin.countries.delete',['id' => 'ID'])}}";
        let url = deleteCountryUrl.replace('ID', id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            $('#countries_table').DataTable().ajax.reload();
                        } else {
                            Swal.fire(
                                'Failed!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the item.',
                            'error'
                        );
                    }
                });
            }
        });
    }


    // =================================update data==================================
    function editItem(id) {

        // alert(1);

        let editcountryUrl = "{{ route('admin.countries.edit', ['id' => 'ID']) }}";

        console.log('1234', editcountryUrl);
        let url = editcountryUrl.replace('ID', id);

        // Redirect to the edit page
        window.location.href = url;
    }
</script>
@endpush
