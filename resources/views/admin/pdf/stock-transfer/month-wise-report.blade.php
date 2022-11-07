<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Monthwise Report</title>
<style>
* {
	margin: 0;
	padding: 0;
}
table {
	border-collapse: collapse;
}
td, th {
	padding: 10px 15px;
	border: #ddd 1px solid;
	text-align: center;
}
.p0 {
	padding: 0;
}
.noBdr {
	border: 0;
}
.text-left {
	text-align: left;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#333; font-size:14px;">
  <tr>
    <td colspan="13" class="noBdr text-left">Daily Receipts and Sales</td>
  </tr>
  <tr>
    <td colspan="13" class="noBdr text-left">Name of Licence : <strong> {{$shop_name}}</strong></td>
  </tr>
  <tr>
    <td colspan="13" class="noBdr text-left">For The Month of :<strong> {{@$month}}</strong></td>
  </tr>
  <tr>
    <th rowspan="2" valign="top">Date</th>
    
    <th colspan="4">FL Bulk Litre (IMFL + OSB + OSBI)</th>
    <th colspan="4">CS Bulk Litre</th>
    <th colspan="4">Beer Bulk Litre (IMFL + OSB + OSBI)</th>
    
    
  </tr>
  <tr>
  
    <td>Opening</td>
    <td>Purchase</td>
    <td>Sale</td>
    <td>Closing</td>
    
    <td>Opening</td>
    <td>Purchase</td>
    <td>Sale</td>
    <td>Closing</td>
    
    <td>Opening</td>
    <td>Purchase</td>
    <td>Sale</td>
    <td>Closing</td>
    
  </tr>
  @forelse ($items as $item)
  <tr>
    <td>{{$item['sell_date']}}</td>
    
    <td>{{$item['fl_bulk_litre_opening']}}</td>
    <td>{{$item['fl_bulk_litre_prchase']}}</td>
    <td>{{$item['fl_bulk_litre_sale']}}</td>
    <td>{{$item['fl_bulk_litre_closing']}}</td>
    
    <td>{{$item['cs_bulk_litre_opening']}}</td>
    <td>{{$item['cs_bulk_litre_prchase']}}</td>
    <td>{{$item['cs_bulk_litre_sale']}}</td>
    <td>{{$item['cs_bulk_litre_closing']}}</td>
    
    <td>{{$item['beer_bulk_litre_opening']}}</td>
    <td>{{$item['beer_bulk_litre_prchase']}}</td>
    <td>{{$item['beer_bulk_litre_sale']}}</td>
    <td>{{$item['beer_bulk_litre_closing']}}</td>
  
  </tr>
  @empty
  @endforelse
</table>
</body>
</html>