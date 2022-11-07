<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
table {
	border-collapse: collapse;
}
td , th {
	padding: 3px 10px;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#333; font-size:14px;">
  <thead>
    <tr>
      <td colspan="5" style="font-weight:bold;font-size:18px" align="center">{{@$shop_name}}</td>
    </tr>
    <tr>
      <td colspan="5" style="font-weight:bold;font-size:14px" align="center">F.L. (Off) Shop</td>
    </tr>
    <tr>
      <td colspan="5" style="font-weight:bold;font-size:14px" align="center">{{@$shop_address}}</td>
    </tr>
    <tr>
      <td colspan="5" style="font-weight:bold;font-size:16px" align="center">Item Wise Sales Report</td>
    </tr>
    <tr>
      <td colspan="5" style="font-size:13px;padding-bottom:12px;" align="center">From : {{$from_date}} To : {{$to_date}}</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th width="33%" align="left" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px;">PARTICULARS</th>
      <th width="16%" align="right" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px;">Qty (BOTTLES)</th>
      <th width="16%" align="right" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px;">Qty (LTR)</th>
      <th width="20%" align="center" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px;">RATE</th>
      <th width="15%" align="right" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px;">AMOUNT</th>
    </tr>
    @if(count($items) > 0 )
    @php 
      $total_bottle = 0;
      $total_qty = 0;
      $total_ammount = 0;
    @endphp
      @foreach ($items as $category=> $categores)
        <tr>
          <td colspan="5" style="font-weight:bolder;font-size:13px;padding:10px 10px 6px;">{{$category}}</td>
        </tr>
        @foreach ($categores as $sub_cal=> $sub_cates)
          @php
          
          @endphp
          <tr>
            @php 
              $total_bottle += array_sum(array_column($sub_cates->toArray(),'total_bottles'));
              $total_qty += array_sum(array_column($sub_cates->toArray(),'total_ml'));
              $total_ammount += array_sum(array_column($sub_cates->toArray(),'total_ammount'));
            @endphp
            <td style="font-weight:bold;">{{$sub_cal}}</td>
            <td align="right" style="font-weight:bold; border-bottom:#333 1px dashed;">{{array_sum(array_column($sub_cates->toArray(),'total_bottles'))}} Btl</td>
            <td align="right" style="font-weight:bold; border-bottom:#333 1px dashed;">{{array_sum(array_column($sub_cates->toArray(),'total_ml'))/1000}}</td>
            <td align="center" style="font-weight:bold; border-bottom:#333 1px dashed;">{{number_format(array_sum(array_column($sub_cates->toArray(),'total_ammount')) / array_sum(array_column($sub_cates->toArray(),'total_bottles')),2)}} Btl</td>
            <td align="right" style="font-weight:bold; border-bottom:#333 1px dashed;">{{number_format(array_sum(array_column($sub_cates->toArray(),'total_ammount')),2)}}</td>
          </tr>

            @foreach ($sub_cates as $products)
              <tr>
                <td style="padding-left:15px;">{{$products->product_name}}</td>
                <td align="right">{{$products->total_bottles}} Btl</td>
                <td align="right">{{$products->total_ml / 1000}}</td>
                <td align="center">{{number_format($products->product_mrp,2)}}/Btl</td>
                <td align="right">{{number_format($products->total_ammount,2)}}</td>
              </tr>
          @endforeach  
        @endforeach
      @endforeach 
      <tr>
        <td style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px;">&nbsp;</td>
        <td align="right" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px; font-weight:bold;">{{$total_bottle}} Btl</td>
        <td align="right" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px; font-weight:bold;">{{$total_qty/1000}}</td>
        <td align="center" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px; font-weight:bold;"></td>
        <td align="right" style="border-bottom:#333 1px solid;border-top:#333 1px solid; padding:10px; font-weight:bold;">{{number_format($total_ammount,2)}}</td>
      </tr>
      <tr>
        <td colspan="3" align="right">&nbsp;</td>
        <td align="left" style="font-weight:bold;">Sale on Cash</td>
        <td align="right" style="font-weight:bold;">{{number_format($total_ammount,2)}}</td>
      </tr>
      <tr>
        <td colspan="3" align="right">&nbsp;</td>
        <td align="left" style="font-weight:bold;">Total Amount Received</td>
        <td align="right" style="font-weight:bold;"> {{number_format($total_ammount,2)}}</td>
      </tr>
    @endif
  </tbody>
</table>
</body>
</html>
