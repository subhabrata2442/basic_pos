<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fire Fighter</title>
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}"> --}}
    <link rel="stylesheet" href="{{ url('assets/admin/css/app.css') }}">
    <script src="{{ url('assets/admin/js/app.js') }}"></script>
</head>

<body style="width:100%;font-family:'Open Sans', sans-serif ;padding:0;Margin:0">
    <table cellpadding="0" cellspacing="0" style="width: 100%; max-width: 800px; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
        <thead>
            <tr>
                <td colspan="3" style="border-bottom: 1px dashed #999; border-top: 4px solid #f99d39; padding: 8px 0; margin: 0 auto;">
                    <img src="{{ asset('assets/img/firefighter_logo.png') }}" alt="Petshop logo" title="Petshop logo" width="118" style="margin: 0 auto; display: block;">
                </td>
            </tr>
        </thead>
    </table>

    <table cellpadding="0" cellspacing="0" style="width: 100%; max-width: 800px; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
        <tbody>
            <tr>
                <td colspan="2" style="vertical-align: top; width: 400px; padding-top: 10px;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 0px; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td><h4 style="padding: 0; margin: 0; font-size: 16px; color: #ec8b16;">Order Details</h4></td>
                            </tr>
                            <tr>
                                <td>Supplier Name: </td>
                                <td><strong>{{ $data['purchase_order']->supplier_dtl->sup_name }}</strong></td>
                            </tr>
                            <tr>
                                <td>Supplier Code: </td>
                                <td><strong>{{ $data['purchase_order']->supplier_dtl->sup_code }}</strong></td>
                            </tr>
                            <tr>
                                <td>Supplier Reference: </td>
                                <td><strong>{{ $data['purchase_order']->supplier_ref }}</strong></td>
                            </tr>
                            <tr>
                                <td>Supplier Invoice Date: </td>
                                <td><strong>{{ date('d-m-Y', strtotime($data['purchase_order']->supplier_invoice_date)) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align: top; width: 400px; padding-top: 10px;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 0px; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td><h4 style="padding: 0; margin: 0; font-size: 16px; color: #ec8b16;">Order Details</h4></td>
                            </tr>
                            <tr>
                                <td>Order No.: </td>
                                <td><strong>{{ $data['purchase_order']->order_no }}</strong></td>
                            </tr>
                            <tr>
                                <td>Order Date: </td>
                                <td><strong>{{ date('d-m-Y', strtotime($data['purchase_order']->order_date)) }}</strong></td>
                            </tr>
                            <tr>
                                <td>Discount (%): </td>
                                <td><strong>{{ $data['purchase_order']->discount }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="vertical-align: top; width: 100%; padding-top: 10px;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 0px; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td><h4 style="padding: 0; margin: 0; font-size: 16px; color: #ec8b16;">Delivery Detail</h4></td>
                            </tr>
                            <tr>
                                <td>Delivery Name: </td>
                                <td><strong>{{ $data['purchase_order']->delivery_name }}</strong></td>
                            </tr>
                            <tr>
                                <td>Delivery Date: </td>
                                <td><strong>{{ date('d-m-Y', strtotime($data['purchase_order']->delivery_date)) }}</strong></td>
                            </tr>
                            <tr>
                                <td>Address: </td>
                                <td>
                                    <strong>{{ $data['purchase_order']->address_one }} 
                                        {{ $data['purchase_order']->address_two }},
                                        {{ $data['purchase_order']->city }},
                                        {{ $data['purchase_order']->state }},
                                        {{ $data['purchase_order']->post_code }}
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                {{-- <td colspan="2" style="width: 500px; padding-top: 10px;">
                    <h4 style="padding: 0; margin: 0; font-size: 16px; color: #ec8b16;">Shipping Address</h4>
                    <h5 style="padding: 0; margin: 0; font-size: 14px;">Ar Ban</h5>
                    <p style="padding: 0; margin: 0; font-size: 14px;">Kolkata</p>
                    <p style="padding: 0; margin: 0; font-size: 14px;">India, Chandigarh</p>
                    <p style="padding: 0; margin: 0; font-size: 14px;">Chandigarh - 700010</p>
                    <p style="padding: 0; margin: 0; font-size: 14px;">Phone Number - 8902677791</p>
                </td> --}}
            </tr>
            <tr colspan="3">
                <td colspan="3">
                    <table style="width: 100%; border-collapse: collapse; margin: 30px 0 0 0;">
                        <thead>
                            <tr>
                                <th align="left" style="border-bottom: 2px solid #dee2e6; padding: 7px; font-size: 15px; white-space: nowrap">Product Desc</th>
                                <th style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: center; font-size: 15px; white-space: nowrap">Price</th>
                                <th style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: center; font-size: 15px; white-space: nowrap">Qty.</th>
                                <th style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: center; font-size: 15px; white-space: nowrap">Discount (%)</th>
                                <th style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: center; font-size: 15px; white-space: nowrap">Tax Rate (%)</th>
                                <th style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: right; font-size: 15px; white-space: nowrap">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $item_count = 0;
                                $purchase_product_total = 0;
                                $costing_sub_total = 0;
                            @endphp
                            @foreach ($data['purchase_order']->purchase_product as $item)
                                @php
                                    $item_count += $item->qty;
                                    $purchase_product_total += $item->total;
                                @endphp
                                <tr>
                                    <td style="width: 500px; border-bottom: 1px solid #dee2e6; padding: 7px;">
                                        <p style="padding: 0; margin: 0; font-size: 15px;">Product Code: <strong>{{ $item->product_dtl->product_code }}</strong></p>
                                        <p style="padding: 0; margin: 0; font-size: 14px; color: #999;">{{ $item->product_dtl->product_desc }}</p>
                                    </td>
                                    <td style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: center;" >{{ $item->price }}</td>
                                    <td style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: center;" >{{ $item->qty }}</td>
                                    <td style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: center;" >{{ $item->discount }}</td>
                                    <td style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: center;" >{{ $item->tax_rate }}</td>
                                    <td style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: right;" >{{ $item->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td align="right" colspan="4" style="padding: 20px 0px 10px 10px;"><strong>Item Count :</strong></td>
                                <td align="right" colspan="2" style="padding: 20px 0px 10px 10px;"><strong>{{ $item_count }}</strong></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4"><strong>Sub Total:</strong></td>
                                <td align="right" colspan="2"><strong>{{ $purchase_product_total }}</strong></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4"><strong>Costing Sub Total:</strong></td>
                                <td align="right" colspan="2"><strong>$23.00</strong></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4" style="color: #f99d39; padding: 10px 0px 20px 10px; font-size: 18px;"><strong>Order Total:</strong></td>
                                <td align="right" colspan="2" style="color: #f99d39; padding: 10px 0px 20px 10px; font-size: 18px;"><strong>{{ $purchase_product_total }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>



    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="profuct-invoice-page">
                    <div class="row">
                        <div class="col-12">
                            <div class="inv-logo-wrap">
                                <span class="inv-logo"><img class="img-block"
                                        src="{{ asset('assets/img/firefighter_logo.png') }}" alt=""></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="purchase-order-dtls-view">
                                <h4>supplier detail</h4>
                                <ul class="dtls-view">
                                    <li>
                                        <div class="dtls-head-name">Supplier Name</div>
                                        <div class="dtls-dsec-name">
                                            {{ $data['purchase_order']->supplier_dtl->sup_name }}</div>
                                    </li>
                                    <li>
                                        <div class="dtls-head-name">Supplier Code</div>
                                        <div class="dtls-dsec-name">
                                            {{ $data['purchase_order']->supplier_dtl->sup_code }}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dtls-head-name">Supplier Reference</div>
                                        <div class="dtls-dsec-name">{{ $data['purchase_order']->supplier_ref }}</div>
                                    </li>
                                    <li>
                                        <div class="dtls-head-name">Supplier Invoice Date</div>
                                        <div class="dtls-dsec-name">
                                            {{ date('d-m-Y', strtotime($data['purchase_order']->supplier_invoice_date)) }}
                                        </div>
                                    </li>
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
                                            {{ date('d-m-Y', strtotime($data['purchase_order']->delivery_date)) }}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dtls-head-name">Address</div>
                                        <div class="dtls-dsec-name">{{ $data['purchase_order']->address_one }}
                                            {{ $data['purchase_order']->address_two }},
                                            {{ $data['purchase_order']->city }},
                                            {{ $data['purchase_order']->state }},
                                            {{ $data['purchase_order']->post_code }}
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
                                        <div class="dtls-head-name">Discount (%)</div>
                                        <div class="dtls-dsec-name">{{ $data['purchase_order']->discount }}</div>
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
                                                $costing_sub_total = 0;
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
                                        <div class="total-wrap-lft">Costing Sub Total</div>
                                        <div class="total-wrap-rgt">0.00</div>
                                    </li>
                                </ul>
                                <ul class="total-ftr">
                                    <li>
                                        <div class="total-wrap-lft">Total</div>
                                        <div class="total-wrap-rgt">{{ $purchase_product_total }}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
