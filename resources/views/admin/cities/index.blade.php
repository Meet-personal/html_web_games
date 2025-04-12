@extends('admin.layouts.design')
@section('body')
    <style>
        #cities_table_paginate,
        #cities_table_filter {
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
                        <h5 class="card-title"> Cities </h5>
                    </div>
                    <div class="d-flex justify-content-end mb-1">
                        <a id="btn-add-cities" class="btn btn-primary" href="{{ route('admin.cities.create') }}"> <i class="fa fa-plus"
                                aria-hidden="true"></i>
                            Create </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="cities_table" class="table align-middle table-hover m-0">
                        <thead>
                            <tr>

                                <th>Country</th>
                                <th>State </th>
                                <th>City</th>
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
            $('#cities_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.cities.data') }}",
                columns: [{
                        data: 'country_id'
                    },
                    {
                        data: 'state_id'
                    },
                    {
                        data: 'city'
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
            let deleteCityUrl = "{{ route('admin.cities.delete', ['id' => 'ID']) }}";
            let url = deleteCityUrl.replace('ID', id);
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
                                $('#cities_table').DataTable().ajax.reload();
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

            let editCityUrl = "{{ route('admin.cities.edit', ['id' => 'ID']) }}";

            console.log('1234', editCityUrl);
            let url = editCityUrl.replace('ID', id);

            // Redirect to the edit page
            window.location.href = url;
        }
    </script>
@endpush
