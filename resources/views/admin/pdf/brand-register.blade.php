<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Brand</title>
<style>
* {
	margin: 0;
	padding: 0;
}
table {
	border-collapse: collapse;
}
td, th {
	padding: 2px 3px;
	border: #ddd 1px solid;
	text-align: center;
}
td {
	vertical-align: top;
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
.bdrTop {
	border: none;
	border-top: #ddd 1px solid;
}
.no-bdr-l, .no-bdr-r {
	border-left: none;
	border-right: none;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#333; font-size:8px;">
  <tr>
    <td colspan="9" class="noBdr text-left" style="font-size:12px;">REGISTER TO BE MAINTAINED FOR STOCK OF FOREIGN LIQUOR</td>
  </tr>
  <tr>
    <td colspan="9" class="noBdr text-left" style="font-size:10px;">Name of Licence :<strong> {{$data['shop_name']}}</strong></td>
  </tr>
  <tr>
    <td colspan="9" class="noBdr text-left" style="font-size:10px;">Kind of liquor :<strong> India Made Foreign Liquor</strong></td>
  </tr>
  <tr>
    <td colspan="9" class="noBdr text-left" style="font-size:10px;">Brand Name :<strong> {{$data['brand_name']}}</strong></td>
  </tr>
  <tr>
    <td colspan="9" class="noBdr text-left" style="font-size:10px; padding-bottom:15px;">For The Month of :<strong>{{$data['month']}}</strong></td>
  </tr>
  <tr>
    <td width="5%" style="font-weight:bold">Date</td>
    <td width="13%" class="p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr>
          <td colspan="6" class="noBdr" style="font-weight:bold">Opening Stock</td>
        </tr>
        <tr> @if (count($data['result']) > 0)
          @forelse ($data['result'][0]['stock_result'] as $size_row)
          <td class="bdrTop" style="font-weight:bold">{{$size_row['size_name']}}</td>
          @empty
          @endforelse   
          @endif </tr>
      </table></td>
    <td width="11%" style="font-weight:bold">Source of Receipts & Pass No.</td>
    <td width="13%" style="font-weight:bold">Batch No. </td>
    <td width="14%" class="p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr>
          <td colspan="6" class="noBdr" style="font-weight:bold">Quantity Receipts</td>
        </tr>
        <tr> @if (count($data['result']) > 0)
          @forelse ($data['result'][0]['stock_result'] as $size_row)
          <td class="bdrTop" style="font-weight:bold">{{$size_row['size_name']}}</td>
          @empty
          @endforelse   
          @endif </tr>
      </table></td>
    <td width="13%" class="p0 p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr>
          <td colspan="6" class="noBdr" style="font-weight:bold">Total Stock Coloumn</td>
        </tr>
        <tr> @if (count($data['result']) > 0)
          @forelse ($data['result'][0]['stock_result'] as $size_row)
          <td class="bdrTop" style="font-weight:bold">{{$size_row['size_name']}}</td>
          @empty
          @endforelse   
          @endif </tr>
      </table></td>
    <td width="13%" class="p0 p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr>
          <td colspan="6" class="noBdr" style="font-weight:bold">Quantity Sales</td>
        </tr>
        <tr> @if (count($data['result']) > 0)
          @forelse ($data['result'][0]['stock_result'] as $size_row)
          <td class="bdrTop" style="font-weight:bold">{{$size_row['size_name']}}</td>
          @empty
          @endforelse   
          @endif </tr>
      </table></td>
    <td width="15%" class="p0 p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr>
          <td colspan="6" class="noBdr" style="font-weight:bold">Closing Balance</td>
        </tr>
        <tr> @if (count($data['result']) > 0)
          @forelse ($data['result'][0]['stock_result'] as $size_row)
          <td class="bdrTop" style="font-weight:bold">{{$size_row['size_name']}}</td>
          @empty
          @endforelse   
          @endif </tr>
      </table></td>
    <td width="3%" style="font-weight:bold">Remarks</td>
  </tr>
  @if (count($data['result']) > 0)
  @forelse ($data['result'] as $row)
  <tr>
    <td>{{$row['sell_date']}}</td>
    <td class="p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr> @foreach ($row['stock_result'] as $srow)
          <td class="noBdr">{{$srow['opening_stock']}}</td>
          @endforeach </tr>
      </table></td>
    <td class="text-left"><p style="font-weight:bold;">{{$row['stock_result'][0]['warehouse_info']}} -<span style="display:block; font-weight:normal">{{$row['stock_result'][0]['source_info']}}</span></p></td>
    <td class="text-left"><p style="font-weight:bold;">{{$row['stock_result'][0]['batch_no']}}</p></td>
    <td class="p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr> @foreach ($row['stock_result'] as $srow)
          <td class="noBdr">{{$srow['purchase_stock']}}</td>
          @endforeach </tr>
      </table></td>
    <td class="p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr>
          @foreach ($row['stock_result'] as $srow)
          <td class="noBdr">{{$srow['total_stock']}}</td>
          @endforeach
        </tr>
      </table></td>
    <td class="p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr>
          @foreach ($row['stock_result'] as $srow)
          <td class="noBdr">{{$srow['total_sale']}}</td>
          @endforeach
        </tr>
      </table></td>
    <td class="p0"><table border="0" cellspacing="0" cellpadding="0" style="width:100%">
        <tr>
          @foreach ($row['stock_result'] as $srow)
          <td class="noBdr">{{$srow['closing_stock']}}</td>
          @endforeach
        </tr>
      </table></td>
    <td>&nbsp;</td>
  </tr>
  @empty
  @endforelse
  @endif
</table>
</body>
</html>
