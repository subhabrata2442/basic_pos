@extends('layouts.admin')
@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-alert />
                <div class="table-responsive dataTable-design">
                    <table id="product_list" class="table table-bordered">
                        <thead>
                            <th>Product Code</th>
                            <th>Description</th>
                            <th>Default Purchase Price</th>
                            <th>Pack Size</th>
                            <th>Min Order Qty.</th>
                            <th>Stock On Hand</th>
                            <th>Allocated Stock</th>
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

            var table = $('#product_list').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 350,
                ajax: "{{ route('admin.stock.product.list') }}",
                columns: [{
                        data: 'prod_code',
                        name: 'prod_code',
                    },
                    {
                        data: 'prod_desc',
                        name: 'prod_desc'
                    },
                    {
                        data: 'def_purchase_price',
                        name: 'def_purchase_price'
                    },
                    {
                        data: 'pack_size',
                        name: 'pack_size',
                    },
                    {
                        data: 'min_order_qty',
                        name: 'min_order_qty'
                    },
                    {
                        data: 'avl_stock',
                        name: 'avl_stock'
                    },
                    {
                        data: 'allocated_stock',
                        name: 'allocated_stock'
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
