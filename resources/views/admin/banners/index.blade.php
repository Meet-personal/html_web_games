@extends('admin.layouts.design')
@section('body')
    <style>
        #banners_table_paginate,
        #banners_table_filter {
            display: flex;
            justify-content: end;
            margin-top: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/2.1.4/dataTables.bootstrap5.css"
        integrity="sha512-d0jyKpM/KPRn5Ys8GmjfSZSN6BWmCwmPiGZJjiRAycvLY5pBoYeewUi2+u6zMyW0D/XwQIBHGk2coVM+SWgllw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"> Banners </h5>
                    </div>
                    <div class="d-flex justify-content-end mb-1">
                        <a id="btn-add-banner" class="btn btn-primary" href="{{ route('admin.banners.create') }}"> <i
                                class="fa fa-plus" aria-hidden="true"></i>
                            Create </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="banners_table" class="table align-middle table-hover m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Game Name</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
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
            $('#banners_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.banners.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false

                     },
                    {
                        data: 'category_id'
                    },
                    {
                        data: 'game_id'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'image'
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
            let deleteCategoryUrl = "{{ route('admin.banners.delete', ['id' => 'ID']) }}";
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
                                $('#banners_table').DataTable().ajax.reload();
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

            let editbannerUrl = "{{ route('admin.banners.edit', ['id' => 'ID']) }}";

            console.log('1234', editbannerUrl);
            let url = editbannerUrl.replace('ID', id);

            // Redirect to the edit page
            window.location.href = url;
        }
    </script>
@endpush
