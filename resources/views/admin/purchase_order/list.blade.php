@extends('layouts.admin')
@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-alert />
                <div class="table-responsive dataTable-design">
                    <table id="purchase_order_list_table" class="table table-bordered">
                        <thead>
                            <th>Order Number</th>
                            <th>Supplier Code</th>
                            <th>Supplier Name</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Delivery Name</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Post Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {

            var table = $('#purchase_order_list_table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 350,
                ajax: "{{ route('admin.stock.purchase-order.list') }}",
                columns: [{
                        data: 'order_no',
                        name: 'order_no',
                    },
                    {
                        data: 'sup_code',
                        name: 'sup_code',
                    },
                    {
                        data: 'sup_name',
                        name: 'sup_name'
                    },
                    {
                        data: 'order_date',
                        name: 'order_date'
                    },
                    {
                        data: 'delivery_date',
                        name: 'delivery_date',
                    },
                    {
                        data: 'delivery_name',
                        name: 'delivery_name'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'state',
                        name: 'state'
                    },
                    {
                        data: 'post_code',
                        name: 'post_code'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });

        // $(document).on('click', '#delete_product', function() {
        //     var url = $(this).data('url');
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {

        //             window.location = url;
        //         }
        //     })
        // });
    </script>
@endsection
