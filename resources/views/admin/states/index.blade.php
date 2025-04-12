@extends('admin.layouts.design')
@section('body')
    <style>
        #states_table_paginate,
        #states_table_filter {
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
                        <h5 class="card-title"> States </h5>
                    </div>
                    <div class="d-flex justify-content-end mb-1">
                        <a id="btn-add-states" class="btn btn-primary" href="{{ route('admin.states.create') }}"> <i class="fa fa-plus"
                                aria-hidden="true"></i>
                            Create </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="states_table" class="table align-middle table-hover m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>Code</th>
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
            $('#states_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.states.data') }}",
                columns: [{
                        data: 'id'
                    },

                    {
                        data: 'country_id'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'code'
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
            let deleteStateUrl = "{{ route('admin.states.delete', ['id' => 'ID']) }}";
            let url = deleteStateUrl.replace('ID', id);
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
                                $('#states_table').DataTable().ajax.reload();
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

            let editStateUrl = "{{ route('admin.states.edit', ['id' => 'ID']) }}";

            console.log('1234', editStateUrl);
            let url = editStateUrl.replace('ID', id);

            // Redirect to the edit page
            window.location.href = url;
        }
    </script>
@endpush
