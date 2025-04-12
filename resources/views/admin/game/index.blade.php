@extends('admin.layouts.design')
@section('body')
    <style>
        #games_table_paginate,
        #games_table_filter {
            display: flex;
            justify-content: end;
            margin-top: 10px;
        }

        #games_table {
            text-align: center;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"> Games</h5>
                    </div>
                    <div>
                        <a id="btn-add-games" class="btn btn-primary" href="{{ route('admin.game.create') }}"> <i class="fa fa-plus"
                            aria-hidden="true"></i>
                        Create </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="games_table" class="table align-middle table-hover m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Category Title</th>
                                <th>Name</th>
                                <!-- <th>Description</th> -->

                                <th>Status</th>
                                <th>Display On Home</th>
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
            $('#games_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.game.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false

                     },
                    {
                        data: 'image'
                    },
                    {
                        data: 'category_id'
                    },
                    {
                        data: 'name'
                    },
                    // {
                    //     data: 'description'
                    // },

                    {
                        data: 'status'
                    },

                    {
                        data: 'display_on_home',
                        render: function(data, type, row) {
                            return data == 1 ? 'Yes' : 'No';
                        }
                    },
                    {
                        data: 'keyword'
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
            let deleteGameUrl = "{{ route('admin.game.delete', ['id' => 'ID']) }}";
            let url = deleteGameUrl.replace('ID', id);
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
                                $('#games_table').DataTable().ajax.reload();
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
            let editGameUrl = "{{ route('admin.game.edit', ['id' => 'ID']) }}";
            let url = editGameUrl.replace('ID', id);
            // Redirect to the edit page
            window.location.href = url;
        }

        function viewItem(id) {
            let viewGameUrl = "{{ route('admin.game.view', ['id' => 'ID']) }}";
            let url = viewGameUrl.replace('ID', id);
            // Redirect to the edit page
            window.location.href = url;
        }

    </script>
@endpush
