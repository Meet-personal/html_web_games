@extends('admin.layouts.design')
@section('body')
    <style>
        #faqs_table_paginate,
        #faqs_table_filter {
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
                        <a id="btn-add-faqs" class="btn btn-primary" href="{{ route('admin.faqs.create') }}"> <i class="fa fa-plus"
                                aria-hidden="true"></i>
                            Create </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="faqs_table" class="table align-middle table-hover m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Country</th>
                                <th>Question</th>
                                <th>Answer</th>

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
            $('#faqs_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.faqs.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false

                     },

                    {
                        data: 'country_id'
                    },
                    {
                        data: 'question'
                    },
                    {
                        data: 'answer'
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
            let deleteFaqsUrl = "{{ route('admin.faqs.delete', ['id' => 'ID']) }}";
            let url = deleteFaqsUrl.replace('ID', id);
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
                                $('#faqs_table').DataTable().ajax.reload();
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

            let editFaqsUrl = "{{ route('admin.faqs.edit', ['id' => 'ID']) }}";

            console.log('1234', editFaqsUrl);
            let url = editFaqsUrl.replace('ID', id);

            // Redirect to the edit page
            window.location.href = url;
        }
    </script>
@endpush
