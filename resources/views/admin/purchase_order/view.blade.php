@extends('layouts.admin')
@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="purchase-order-dtls-view">
                            <h4>supplier detail</h4>
                            <ul class="dtls-view">
                                <li>
                                    <div class="dtls-head-name">Supplier Name</div>
                                    <div class="dtls-dsec-name">{{ $data['purchase_order']->supplier_dtl->sup_name }}</div>
                                </li>
                                <li>
                                    <div class="dtls-head-name">Supplier Code</div>
                                    <div class="dtls-dsec-name">{{ $data['purchase_order']->supplier_dtl->sup_code }}
                                    </div>
                                </li>
                                <li>
                                    <div class="dtls-head-name">Supplier Reference</div>
                                    <div class="dtls-dsec-name">{{ $data['purchase_order']->supplier_ref }}</div>
                                </li>
                                {{-- <li>
                                    <div class="dtls-head-name">Supplier Invoice Date</div>
                                    <div class="dtls-dsec-name">
                                        {{ date('d-m-Y', strtotime($data['purchase_order']->supplier_invoice_date)) }}
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="purchase-order-dtls-view">
                            <h4>Delivery Detail</h4>
                            <ul class="dtls-view">
                                <li>
                                    <div class="dtls-head-name">Delivery Name</div>
                                    <div class="dtls-dsec-name">{{ $data['purchase_order']->delivery_name }}</div>
                                </li>
                                <li>
                                    <div class="dtls-head-name">Delivery Date</div>
                                    <div class="dtls-dsec-name">
                                        {{ date('d-m-Y', strtotime($data['purchase_order']->delivery_date)) }}</div>
                                </li>
                                <li>
                                    <div class="dtls-head-name">Address</div>
                                    <div class="dtls-dsec-name">{{ $data['purchase_order']->address_one }}
                                        {{ $data['purchase_order']->address_two }}, {{ $data['purchase_order']->city }},
                                        {{ $data['purchase_order']->state }}, {{ $data['purchase_order']->post_code }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="purchase-order-dtls-view">
                            <h4>Order Detail</h4>
                            <ul class="dtls-view">
                                <li>
                                    <div class="dtls-head-name">Order No</div>
                                    <div class="dtls-dsec-name">{{ $data['purchase_order']->order_no }}</div>
                                </li>
                                <li>
                                    <div class="dtls-head-name">Order Date</div>
                                    <div class="dtls-dsec-name">
                                        {{ date('d-m-Y', strtotime($data['purchase_order']->order_date)) }}</div>
                                </li>
                                <li>
                                    <div class="dtls-head-name">Delivery Charge</div>
                                    <div class="dtls-dsec-name">{{ $data['purchase_order']->delivery_charge }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="invoice-page-table">
                            <div class="table-head-title">
                                <h4>product detail</h4>
                            </div>
                            <div class="invoice-page suppliers-table table-responsive">
                                <table class="table thead-bg">
                                    <thead class="text-nowrap">
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Product Desc</th>
                                            <th>Price</th>
                                            <th>Qty.</th>
                                            <th>Discount (%)</th>
                                            <th>Disc. Price</th>
                                            <th>Tax Rate (%)</th>
                                            <th>Total</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $item_count = 0;
                                            $purchase_product_total = 0;
                                        @endphp
                                        @foreach ($data['purchase_order']->purchase_product as $item)
                                            @php
                                                $item_count += $item->qty;
                                                $purchase_product_total += $item->total;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $item->product_dtl->product_code }}
                                                </td>
                                                <td>
                                                    {{ $item->product_dtl->product_desc }}
                                                </td>
                                                <td>
                                                    {{ $item->price }}
                                                </td>
                                                <td>
                                                    {{ $item->qty }}
                                                </td>
                                                <td>
                                                    {{ $item->discount }}
                                                </td>
                                                <td>
                                                    {{ ($item->price * $item->qty * $item->discount) / 100 }}
                                                </td>
                                                <td>
                                                    {{ $item->tax_rate }}
                                                </td>
                                                <td>
                                                    {{ $item->total }}
                                                </td>
                                                <td>
                                                    {{ $item->comments }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <div class="invoice-page-table">
                            <div class="table-head-title">
                                <h4>cost detail</h4>
                            </div>
                            <div class="invoice-page suppliers-table table-responsive">
                                <table class="table thead-bg">
                                    <thead class="text-nowrap">
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Supplier Product Code</th>
                                            <th>Product Desc</th>
                                            <th>Price</th>
                                            <th>Qty.</th>
                                            <th>Discount (%)</th>
                                            <th>Disc. Price</th>
                                            <th>Tax Rate (%)</th>
                                            <th>Total</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>POD2368</td>
                                            <td>SP-POD2368</td>
                                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic cumque,
                                                voluptatibus ea adipisci repellendus aut architecto</td>
                                            <td>3500</td>
                                            <td>5</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>10</td>
                                            <td>4000</td>
                                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem praesentium
                                                quaerat, reiciendis error dolores cupiditate voluptates?</td>
                                        </tr>
                                        <tr>
                                            <td>POD2368</td>
                                            <td>SP-POD2368</td>
                                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic cumque,
                                                voluptatibus ea adipisci repellendus aut architecto</td>
                                            <td>3500</td>
                                            <td>5</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>10</td>
                                            <td>4000</td>
                                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem praesentium
                                                quaerat, reiciendis error dolores cupiditate voluptates?</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="invoice-total-wrap">
                            <ul>
                                <li>
                                    <div class="total-wrap-lft">Item Count</div>
                                    <div class="total-wrap-rgt">{{ $item_count }}</div>
                                </li>
                                <li>
                                    <div class="total-wrap-lft">Sub Total</div>
                                    <div class="total-wrap-rgt">{{ $purchase_product_total }}</div>
                                </li>
                                <li>
                                    <div class="total-wrap-lft">Delivery Charge</div>
                                    <div class="total-wrap-rgt">{{ $data['purchase_order']->delivery_charge }}</div>
                                </li>
                            </ul>
                            <ul class="total-ftr">
                                <li>
                                    <div class="total-wrap-lft">Total</div>
                                    <div class="total-wrap-rgt">{{ $data['purchase_order']->sub_total }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
