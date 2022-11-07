<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CASH MEMO</title>
<style>
* {
	padding: 0;
	margin: 0;
}
@media print {
 @page {
 margin: 0 auto;
 sheet-size: 300px 250mm;
}
html {
	direction: rtl;
}
html, body {
	margin: 0;
	padding: 0
}
#printContainer {
	width: 250px;
	margin: auto;
	text-align: justify;
}
.text-center {
	text-align: center;
}
}
</style>
</head>

<body>
<table border="0" cellspacing="0" cellpadding="0" style="font-size:12px; color:#000">
  <tr>
    <td colspan="4"  style="padding:2px 3px;font-weight:bold;text-align: center;">{{$shop_details['name']}}</td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:4px 3px;text-align: center;">{{$shop_details['address1']}}</td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:6px 3px; text-align: center;">{{$shop_details['address2']}}</td>
  </tr>
  <tr>
    <td colspan="4" style="padding:6px 3px; text-align: center;">{{$shop_details['phone']}}</td>
  </tr>
  <tr>
    <td colspan="4" style="padding:10px 3px;font-weight:bold; text-align:center;">CASH MEMO</td>
  </tr>
  <tr>
    <td colspan="4" style="padding:2px 3px; text-align: left;">Bill No: <span>#{{$invoice_details['bill_no']}}</span></td>
    <!--<td colspan="2" style="padding:2px 3px; text-align: left;">Table No: <span>4</span></td>--> 
  </tr>
  <tr>
    <td colspan="2" style="padding:6px 3px; text-align: left;">Date: <span>{{$invoice_details['invoice_date']}}</span></td>
    <td colspan="2" style="padding:6px 3px; text-align: left;">Time: <span>{{$invoice_details['invoice_time']}}</span></td>
  </tr>
  <!--<tr>
    <td colspan="4" style="padding:6px 3px 20px; text-align: left;">GST NO: <span>25ADSX199D2</span></td>
  </tr>-->
  <tr>
    <td width="118" style="padding:6px 3px; text-align: left;">Item</td>
    <td width="68" style="padding:6px 3px; text-align: center;">Rate</td>
    <td width="82" style="padding:6px 3px; text-align: center;">Qty</td>
    <td width="100" style="padding:6px 3px; text-align: center;">Total</td>
  </tr>
  @if (count($items) > 0)
  @forelse ($items as $item)
  <tr>
    <td style="padding:6px 3px; text-align: left;">{{$item['product_name']}}</td>
    <td style="padding:6px 3px; text-align: center;">{{$item['mrp']}}</td>
    <td style="padding:6px 3px; text-align: center;">{{$item['qty']}}</td>
    <td style="padding:6px 3px; text-align: center;">{{$item['final_price']}}</td>
  </tr>
  @empty
  @endforelse
  @endif
  <tr>
    <td colspan="4"  style="padding:20px 3px;font-weight:bold;text-align: center;">NET: <span>₹ {{$total['total_price']}}</span></td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:6px 3px; text-align: center;"><strong>{{$total_amt_in_word}}</strong></td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:6px 3px; text-align: center;">Rate Exclusive all taxes</td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:20px 3px;font-weight:bold;text-align: center;">*Thank You. Visit Again. Your satisfaction is our moto*</td>
  </tr>
</table>
</body>
</html>