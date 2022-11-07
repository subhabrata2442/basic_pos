<!doctype html>

<html>
<head>
<meta charset="utf-8">
<title>Invoice</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#333; font-size:13px;">
  <tr>
    <td style="padding:8px 5px;font-size:16px;font-weight:bold; text-align:center;">KO PRINT</td>
  </tr>
  <tr>
    <td style="padding:8px 7px;font-size:16px;font-weight:bold;">{{$shop_details['name']}}</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17%" style="padding:8px 7px; font-weight:bold; font-size:14px">Order No. </td>
          <td width="8%" style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td width="15%" style="padding:8px 7px;font-size:13px; font-weight:normal; text-align:right;">#{{$invoice_details['invoice_no']}}</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px">Date/Time</td>
          <td style="padding:8px 7px; font-weight:bold; font-size:14px; text-align:center;">:</td>
          <td style="font-size:13px; font-weight:normal; text-align:right;">{{$invoice_details['invoice_date']}}</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td style="padding:15px 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#777 1px solid;">
        <tr>
          <th width="39%" style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid; font-size:13px;" scope="col">ID</th>
          <th width="39%" style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid; font-size:13px;" scope="col">Particulars</th>
          <th width="39%" style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid; font-size:13px;" scope="col">Size</th>
          <th width="39%" style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid; font-size:13px;" scope="col">Type</th>
          <th width="7%" style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;font-size:13px;" scope="col">Qty</th>
        </tr>
        @if (count($items) > 0)
        
        @forelse ($items as $key=>$item)
        <tr>
          <td style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;">{{($key+1)}}</td>
          <td style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;">{{$item['product_name']}}</td>
          <td style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;">{{$item['product_size']}}</td>
          <td style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;">{{$item['product_type']}}</td>
          <td style="text-align:center;padding:8px 7px; border-bottom:#ccc 1px solid;">{{$item['product_qty']}}</td>
        </tr>
        @empty
        @endforelse
        @endif
      </table></td>
  </tr>
</table>
</body>
</html>
