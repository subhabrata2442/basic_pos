@extends('layouts.admin')
@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="tab-design">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Purchases</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                                aria-selected="false">Returns</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <x-alert />
                                        <div class="search-panel">
                                            <div class="row align-items-end">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="">Status:</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="">All</option>
                                                            <option value="0">Pending</option>
                                                            <option value="2">Placed</option>
                                                            <option value="3">Receipt</option>
                                                            <option value="1">Complete</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="">Date Range:</label>
                                                        <input type="text" id="purchase_order_date_range"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <button type="button"
                                                            class="commonBtn-btnTag search-order">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#purchase_order_date_range').daterangepicker({
                startDate: '01/01/2022',
                endDate: new Date(),
                locale: {
                    format: 'MM/DD/YYYY'
                }
            });

            var table = $('#purchase_order_list_table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 350,
                // ajax: "{{ route('admin.stock.supplier.orders', [$data['id']]) }}",
                ajax: {
                    url: "{{ route('admin.stock.supplier.orders', [$data['id']]) }}",
                    data: function(d) {
                        d.status = $('#status').val(),
                            d.date_range = $('#purchase_order_date_range').val()
                    }
                },
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

            $('.search-order').click(function() {
                table.draw();
            });

        });
    </script>
@endsection
