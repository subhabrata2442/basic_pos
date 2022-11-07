<!doctype html>

<html>
<head>
<meta charset="utf-8">
<title>Invoice</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#333; font-size:13px;">
  <tr>
    <td style="padding:8px 5px;font-size:16px;font-weight:bold; text-align:center;">CASH MEMO</td>
  </tr>
  <tr>
    <td style="padding:8px 7px;font-size:16px;font-weight:bold;">{{$shop_details['name']}}</td>
    {{-- Shop name --}} </tr>
  <tr>
    <td style="padding:8px 7px;">{{$shop_details['address1']}}</td>
  </tr>
  <tr>
    <td style="padding:8px 7px;">{{$shop_details['address2']}}</td>
  </tr>
  <tr>
    <td style="padding:8px 7px;">{{$shop_details['phone']}}</td>
  </tr>
  <tr>
    <td style="padding:18px 5px 6px;font-size:16px;font-weight:bold;">Customer Details</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="13%" style="padding:8px 7px; font-weight:bold; font-size:14px">Customer </td>
          <td width="7%" style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td width="80%" style="padding:8px 7px;font-size:13px; font-weight:normal;">{{$customer_details['name']}}</td>
        </tr>
        <tr>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px">Mobile</td>
          <td width="7%" style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td style="padding:8px 7px;font-size:13px; font-weight:normal;">{{$customer_details['mobile']}}</td>
        </tr>
        {{--
        <tr>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px">Address</td>
          <td width="7%" style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td style="padding:8px 7px;font-size:13px; font-weight:normal;">{{@$customer_details['address']}}</td>
        </tr>
        --}}
      </table></td>
  </tr>
  <tr>
    <td style="padding:18px 5px 6px;font-size:16px;font-weight:bold;">Invoice Details</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17%" style="padding:8px 7px; font-weight:bold; font-size:14px">Bill No. </td>
          <td width="8%" style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td width="15%" style="padding:8px 7px;font-size:13px; font-weight:normal; text-align:right;">#{{$invoice_details['bill_no']}}</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px">Date</td>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td style="font-size:13px; font-weight:normal; text-align:right;">{{$invoice_details['invoice_date']}}</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px">Time</td>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td style="font-size:13px; font-weight:normal; text-align:right;">{{$invoice_details['booking_time']}}</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding:8px 7px; font-weight:bold; font-size:13px">Table No</td>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td style="padding:8px 7px;font-size:13px; font-weight:normal; text-align:right;"># {{$invoice_details['table_no']}}</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px">Branch</td>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td style="padding:8px 7px; font-size:13px; font-weight:normal; text-align:right;">{{$invoice_details['branch']}}</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px">Cashier Name</td>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td style="padding:8px 7px; font-size:13px; font-weight:normal; text-align:right;">{{$invoice_details['cashier_name']}}</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td style="padding:15px 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#777 1px solid;">
        <tr>
          <th width="39%" style="text-align:left;padding:8px 7px; border-bottom:#ccc 1px solid; font-size:13px;" scope="col">Item</th>
          <th width="8%" style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;font-size:13px;" scope="col">Rate</th>
          <th width="7%" style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;font-size:13px;" scope="col">Qty</th>
          <th width="21%" style="text-align:right;padding:8px 7px; border-bottom:#ccc 1px solid;font-size:13px;" scope="col">Total Amt.</th>
        </tr>
        @if (count($items) > 0)
        
        @forelse ($items as $item)
        <tr>
          <td style="text-align:left;padding:8px 7px; border-bottom:#ccc 1px solid;">{{$item['product_name']}}</td>
          <td style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;">{{$item['mrp']}}</td>
          <td style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;">{{$item['qty']}}</td>
          <td style="text-align:right;padding:8px 7px; border-bottom:#ccc 1px solid;">{{$item['final_price']}}</td>
        </tr>
        @empty
        
        
        
        @endforelse
        <tr>
        <td style="text-align:center;padding:8px 7px;font-weight:bold; font-size:13px;"></td>
          <td style="text-align:center;padding:8px 7px;font-weight:bold; font-size:13px;">Total </td>
          <td style="text-align:center;padding:8px 7px;font-weight:bold; font-size:13px;">{{$total['total_qty']}}</td>
          <td style="text-align:right;padding:8px 7px; font-weight:bold; font-size:13px;">₹ {{$total['total_price']}}</td>
        </tr>
        @endif
      </table></td>
  </tr>
  <tr>
    <td style="text-align:center;padding:8px 7px; font-weight:bold; font-size:13px;">{{$total_amt_in_word}}</td>
  </tr>
  <tr>
    <td style="padding:10px 5px 2px;font-size:16px;font-weight:bold;">PAYMENT METHODS</td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td style="padding:8px 7px; font-weight:normal; font-size:14px" width="12%">{{$payment_method}} </td>
          <td style="padding:8px 7px; font-weight:normal; font-size:14px; text-align:center;" width="6%">:</td>
          <td style="padding:8px 7px;font-size:14px; font-weight:bold;" width="82%">₹ {{$gst['total_amt']}}</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td style="padding:15px 5px 4px;font-size:16px;font-weight:bold;">TERMS & CONDITIONS</td>
  </tr>
  <tr>
    <td style="padding:7px 7px;font-weight:bold;">Product once sold can not be returned or refunded.</td>
  </tr>
  <tr>
    <td style="padding:7px 7px;font-weight:bold;">Please carry ORIGINAL INVOICE to claim Warrenty</td>
  </tr>
  <tr>
    <td style="padding:10px 5px;font-weight:bold;">---Amount Recd From Customer---</td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0" border="0" style="border:#777 1px solid;">
        <tr>
          <td width="50%" style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:right; border-bottom:#ccc 1px solid;">Cash :</td>
          <td width="50%" style="padding:8px 7px;font-size:14px; font-weight:bold; text-align:right;border-bottom:#ccc 1px solid;">₹ {{$gst['total_amt']}}</td>
        </tr>
        <tr>
          <td style="padding:7px 7px; font-weight:bold; font-size:14px; text-align:right;">Balance Paid In Cash :</td>
          <td style="padding:4px 2px;font-size:14px; font-weight:bold; text-align:right;">₹ {{$gst['total_amt']}}</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td style="padding:3px 5px;font-weight:bold; text-align:center; font-size:16px;">THANK YOU FOR SHOPPING WITH US</td>
  </tr>
</table>
</body>
</html>
