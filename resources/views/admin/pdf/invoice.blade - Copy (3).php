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
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4"  style="padding:2px 5px;font-size:12px;font-weight:bold;text-align: center;">{{$shop_details['name']}}</td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:4px 5px;text-align: center;">{{$shop_details['address1']}}</td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:6px 5px; text-align: center;">{{$shop_details['address2']}}</td>
  </tr>
  <tr>
    <td colspan="4" style="padding:6px 5px; text-align: center;">{{$shop_details['phone']}}</td>
  </tr>
  <tr>
    <td colspan="4" style="padding:10px 5px;font-size:12px;font-weight:bold; text-align:center;">CASH MEMO</td>
  </tr>
  <tr>
    <td colspan="2" style="padding:2px 5px; text-align: left;">Bill No: <span>1234</span></td>
    <td colspan="2" style="padding:2px 5px; text-align: left;">Table No: <span>4</span></td>
  </tr>
  <tr>
    <td colspan="2" style="padding:6px 5px; text-align: left;">Date: <span>{{$invoice_details['invoice_date']}}</span></td>
    <td colspan="2" style="padding:6px 5px; text-align: left;">Time: <span>09:32pm</span></td>
  </tr>
  <tr>
    <td colspan="4" style="padding:6px 5px 20px; text-align: left;">GST NO: <span>25ADSX199D2</span></td>
  </tr>
  <tr>
    <td style="padding:6px 5px; text-align: left; border: #ccc 1px solid">ITEM</td>
    <td style="padding:6px 5px; text-align: center; border-top: #ccc 1px solid; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">QTY</td>
    <td style="padding:6px 5px; text-align: center; border-top: #ccc 1px solid; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">RATE</td>
    <td style="padding:6px 5px; text-align: right; border-top: #ccc 1px solid; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">Total</td>
  </tr>
  <tr>
    <td style="padding:6px 5px; text-align: left; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">Old Mounk(60)</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">130</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">2</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">260</td>
  </tr>
  <tr>
    <td style="padding:6px 5px; text-align: left; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">Old Mounk(60)</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">130</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">2</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">260</td>
  </tr>
  <tr>
    <td style="padding:6px 5px; text-align: left; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">Old Mounk(60)</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">130</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">2</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">260</td>
  </tr>
  <tr>
    <td style="padding:6px 5px; text-align: left; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">Old Mounk(60)</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">130</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">2</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">260</td>
  </tr>
  <tr>
    <td style="padding:6px 5px; text-align: left; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">Old Mounk(60)</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">130</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">2</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">260</td>
  </tr>
  <tr>
    <td style="padding:6px 5px; text-align: left; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">Old Mounk(60)</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">130</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">2</td>
    <td style="padding:6px 5px; text-align: center; border-bottom: #ccc 1px solid; border-right: #ddd 1px solid;">260</td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:20px 5px;font-size:12px;font-weight:bold;text-align: center;">NET: <span>813</span></td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:6px 5px; text-align: center;">Eight hundred and thirteen only</td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:6px 5px; text-align: center;">Rate Exclusive all taxes</td>
  </tr>
  <tr>
    <td colspan="4"  style="padding:20px 5px;font-size:12px;font-weight:bold;text-align: center;">*Thank You. Visit Again. Your satisfaction is our moto*</td>
  </tr>
</table>
</body>
</html>