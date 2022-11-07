<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fire Fighter</title>
</head>

<body style="width:100%; font-family:'Open Sans', sans-serif ; padding:0; Margin:0">
    <table cellpadding="0" cellspacing="0"
        style="width: 100%; max-width: 800px; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
        <thead>
            <tr>
                <td colspan="3"
                    style="border-bottom: 1px dashed #999; border-top: 4px solid #f99d39; padding: 8px 0; text-align: center">
                    <img src="{{ asset('assets/img/firefighter_logo.png') }}" alt="Petshop logo" title="Petshop logo"
                        width="118">
                </td>
            </tr>
        </thead>
    </table>

    <table cellpadding="0" cellspacing="0"
        style="width: 100%; max-width: 800px; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
        <tbody>
            <tr>
                <td colspan="2" style="vertical-align: top; padding-top: 10px;">
                    <table cellpadding="0" cellspacing="0"
                        style="width: 100%; border-spacing: 0px; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="padding: 0 0 6px 0;">
                                    <h4 style="padding: 0; margin: 0; font-size: 16px; color: #ec8b16;">Supplier Details
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0;">Supplier Name: </td>
                                <td style="padding: 3px 0; width: 400px;">
                                    <strong>{{ $data['purchase_order']->supplier_dtl->sup_name }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0;">Supplier Code: </td>
                                <td style="padding: 3px 0; width: 400px;">
                                    <strong>{{ $data['purchase_order']->supplier_dtl->sup_code }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0;">Supplier Reference: </td>
                                <td style="padding: 3px 0; width: 400px;">
                                    <strong>{{ $data['purchase_order']->supplier_ref }}</strong>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td style="padding: 3px 0;">Supplier Invoice Date: </td>
                                <td style="padding: 3px 0; width: 400px;">
                                    <strong>{{ date('d-m-Y', strtotime($data['purchase_order']->supplier_invoice_date)) }}</strong>
                                </td>
                            </tr> --}}
                            <tr>
                                <td style="padding: 10px 0 6px 0;">
                                    <h4 style="padding: 0; margin: 0; font-size: 16px; color: #ec8b16;">
                                        Delivery Details</h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0;">Delivery Name: </td>
                                <td style="padding: 3px 0; width: 400px;">
                                    <strong>{{ $data['purchase_order']->delivery_name }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0;">Delivery Date: </td>
                                <td style="padding: 3px 0; width: 400px;">
                                    <strong>{{ date('d-m-Y', strtotime($data['purchase_order']->delivery_date)) }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0;">Address: </td>
                                <td style="padding: 3px 0; width: 400px;">
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
                <td style="vertical-align: top; padding-top: 10px;">
                    <table cellpadding="0" cellspacing="0"
                        style="width: 100%; border-spacing: 0px; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="padding: 0 0 6px 0;">
                                    <h4 style="padding: 0; margin: 0; font-size: 16px; color: #ec8b16;">Order Details
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0">Order No.: </td>
                                <td style="padding: 3px 0"><strong>{{ $data['purchase_order']->order_no }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0">Order Date: </td>
                                <td style="padding: 3px 0">
                                    <strong>{{ date('d-m-Y', strtotime($data['purchase_order']->order_date)) }}</strong>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td style="padding: 3px 0">Discount (%): </td>
                                <td style="padding: 3px 0"><strong>{{ $data['purchase_order']->discount }}</strong>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </td>
            </tr>
            {{-- <tr>
                <td colspan="3" style="vertical-align: top; width: 100%; padding-top: 10px;">
                    <table cellpadding="0" cellspacing="0"
                        style="width: 100%; border-spacing: 0px; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td>
                                    <h4 style="padding: 0; margin: 0; font-size: 16px; color: #ec8b16;">Delivery Detail
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0">Delivery Name: </td>
                                <td style="padding: 3px 0">
                                    <strong>{{ $data['purchase_order']->delivery_name }}</strong></td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0">Delivery Date: </td>
                                <td style="padding: 3px 0">
                                    <strong>{{ date('d-m-Y', strtotime($data['purchase_order']->delivery_date)) }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 0">Address: </td>
                                <td style="padding: 3px 0">
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
            </tr> --}}
            <tr colspan="3">
                <td colspan="3">
                    <table style="width: 100%; border-collapse: collapse; margin: 30px 0 0 0;">
                        <thead>
                            <tr>
                                <th align="left"
                                    style="border-bottom: 2px solid #dee2e6; padding: 7px; font-size: 15px; white-space: nowrap">
                                    Product Desc</th>
                                <th
                                    style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: center; font-size: 15px; white-space: nowrap">
                                    Price</th>
                                <th
                                    style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: center; font-size: 15px; white-space: nowrap">
                                    Qty.</th>
                                <th
                                    style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: center; font-size: 15px; white-space: nowrap">
                                    Discount (%)</th>
                                <th
                                    style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: center; font-size: 15px; white-space: nowrap">
                                    Tax Rate (%)</th>
                                <th
                                    style="border-bottom: 2px solid #dee2e6; padding: 7px; text-align: right; font-size: 15px; white-space: nowrap">
                                    Total</th>
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
                                        <p style="padding: 0; margin: 0; font-size: 15px;">Product Code:
                                            <strong>{{ $item->product_dtl->product_code }}</strong>
                                        </p>
                                        <p style="padding: 0; margin: 0; font-size: 14px; color: #999;">
                                            {{ $item->product_dtl->product_desc }}</p>
                                    </td>
                                    <td
                                        style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: center;">
                                        {{ $item->price }}</td>
                                    <td
                                        style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: center;">
                                        {{ $item->qty }}</td>
                                    <td
                                        style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: center;">
                                        {{ $item->discount }}</td>
                                    <td
                                        style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: center;">
                                        {{ $item->tax_rate }}</td>
                                    <td
                                        style="border-bottom: 1px solid #dee2e6; padding: 7px; width: 150px; text-align: right;">
                                        {{ $item->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td align="right" colspan="4" style="padding: 20px 0px 10px 10px;"><strong>Item Count
                                        :</strong></td>
                                <td align="right" colspan="2" style="padding: 20px 0px 10px 10px;">
                                    <strong>{{ $item_count }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4"><strong>Sub Total:</strong></td>
                                <td align="right" colspan="2"><strong>{{ $purchase_product_total }}</strong></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4"><strong>Delivery Charge:</strong></td>
                                <td align="right" colspan="2">
                                    <strong>{{ $data['purchase_order']->delivery_charge }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4"
                                    style="color: #f99d39; padding: 10px 0px 20px 10px; font-size: 18px;"><strong>Order
                                        Total:</strong></td>
                                <td align="right" colspan="2"
                                    style="color: #f99d39; padding: 10px 0px 20px 10px; font-size: 18px;">
                                    <strong>{{ $data['purchase_order']->sub_total }}</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
