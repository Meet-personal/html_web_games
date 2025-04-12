@extends('admin.layouts.design')
@section('body')
    <style>
        #categories_table_paginate,
        #categories_table_filter {
            display: flex;
            justify-content: end;
            margin-top: 10px;
        }

        #categories_table {
            text-align: center;
        }
    </style>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"> Categories</h5>
                    </div>
                    <div>
                        <a id="btn-add-category" class="btn btn-primary" href="{{ route('admin.categories.create') }}"> <i
                                class="fa fa-plus" aria-hidden="true"></i>
                            Create </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="categories_table" class="table align-middle table-hover m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Parent Category</th>
                                <th>Title</th>
                                <!-- <th>Description</th> -->
                                <th>Display On Home</th>
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
            $('#categories_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.categories.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false

                     },
                    {
                        data: 'image'

                    },
                    {
                        data: 'parent_category',
                    },
                    {
                        data: 'title'
                    },
                    // {
                    //     data: 'description'
                    // },

                    {
                        data: 'display_on_home',
                        render: function(data, type, row) {
                            return data === 1 ? 'Yes' : 'No';
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            return data === 1 ? 'Active' : 'Inactive';
                        }
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
            let deleteCategoryUrl = "{{ route('admin.categories.delete', ['id' => 'ID']) }}";
            let url = deleteCategoryUrl.replace('ID', id);
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
                                $('#categories_table').DataTable().ajax.reload();
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

        function viewItem(id) {

            // alert(1);

            let viewCategoryUrl = "{{ route('admin.categories.view', ['id' => 'ID']) }}";

            let url = viewCategoryUrl.replace('ID', id);

            // Redirect to the edit page
            window.location.href = url;
        }
    </script>
@endpush
