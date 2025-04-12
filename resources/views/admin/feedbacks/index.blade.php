@extends('admin.layouts.design')
@section('body')
    <style>
        #feedbacks_table_paginate,
        #feedbacks_table_filter {
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
                        <h5 class="card-title"> Faqs</h5>
                    </div>
                    <div class="d-flex justify-content-end mb-1">
                        <a id="btn-add-faqs" class="btn btn-primary" href="{{ route('admin.faqs.create') }}"> <i
                                class="fa fa-plus" aria-hidden="true"></i>
                            Create </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="feedbacks_table" class="table align-middle table-hover m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Create Date/Time</th>
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
            $('#feedbacks_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.feedbacks.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false

                    },

                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'subject'
                    },

                    {
                        data: 'message'
                    },
                    {
                        data: 'created_at'
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
            let deleteFeedbacksUrl = "{{ route('admin.feedbacks.delete', ['id' => 'ID']) }}";
            let url = deleteFeedbacksUrl.replace('ID', id);
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
                                $('#feedbacks_table').DataTable().ajax.reload();
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
    </script>
@endpush
