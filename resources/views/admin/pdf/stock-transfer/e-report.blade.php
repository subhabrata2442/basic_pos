<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>e Report</title>
<style type="text/css">
* {
	padding: 0;
	margin: 0;
}
table {
	font-size: 14px;
	font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	color: #333;
}
table, th, td {
	border: 1px solid #ddd;
	border-collapse: collapse;
}
th, td {
	padding: 10px;
}
.no-padding {
	padding: 0;
}
.noBdr {
	border: none !important;
}
.noBtb {
	border-bottom: none !important;
	border-top: none !important;
}
.bdr-l-none {
	border-left: none;
}
.bdr-r-none {
	border-right: none !important;
}
</style>
</head>

<body>
<p style="margin:0;">Trader Id No.:{{$data['trader_id_no']}}</p>
<p style="margin:0;">Licensee Id No. : {{$data['licensee_no']}}</p>
<p style="margin:0;">Statement month (mm/yyyy) : {{$data['month']}} <span class="h1">Government of West Bengal </span>Licensee Name        : {{$data['shop_name']}} <span class="h1">Excise Department </span></p>
<!--<h2 style="font-size:16px;margin:0;">Range : {{$data['month']}} <span class="s1">e-Report Return : Retail</span></h2>-->
<p style="margin-bottom:15px;">Circle : {{$data['shop_address']}}, {{$data['shop_address2']}}</p>
<table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="292" class="noBdr" style="background:#444; color:#fff;">&nbsp;</td>
    <td width="706" class="no-padding noBdr"><table  border="0" cellspacing="0" cellpadding="0" class="noBdr">
        <tr>
          <td width="158" class="noBtb" style="background:#444; color:#fff; font-weight:bold;">Opening Balance</td>
          <td width="101" class="noBtb" style="background:#444; color:#fff; font-weight:bold;">Receipts</td>
          <td width="80" class="noBtb" style="background:#444; color:#fff; font-weight:bold;">Sales</td>
          <td width="161" class="noBtb" style="background:#444; color:#fff; font-weight:bold;">Closing Balance</td>
          <td width="206" class="noBtb" style="background:#444; color:#fff; font-weight:bold;">Sales in June 2021</td>
        </tr>
      </table></td>
  </tr>
  <?php if(count($data['result']['imfl_osbi_os_result'])>0){ ?>
  <?php foreach($data['result']['imfl_osbi_os_result'] as $row){?>
  <tr>
    <td colspan="2" class="no-padding noBdr"><table border="0" cellspacing="0" cellpadding="0" class="noBdr">
        <tr>
          <td width="100" class="bdr-l-none bdr-r-none" style="background:#444; color:#fff; font-weight:bold;text-align:center;"><?=$row['category_name'];?></td>
          <td width="936" class="no-padding noBdr bdr-r-none"><table width="937" border="0" cellpadding="0" cellspacing="0" class="noBdr">
              <?php if(count($row['sub_category'])>0){ ?>
              <?php $i=1;foreach($row['sub_category'] as $sub_row){?>
              <tr>
                <td width="135" class="">0
                  <?=$i;?></td>
                <td width="98" class=""><?=$sub_row['sub_category_name'];?></td>
                <td width="158" class=""><?=$sub_row['opening_balance'];?></td>
                <td width="101" class=""><?=$sub_row['receipt_balance'];?></td>
                <td width="80" class=""><?=$sub_row['total_sell'];?></td>
                <td width="161" class=""><?=$sub_row['closing_balance'];?></td>
                <td width="204" class=""><?=$sub_row['prevYear_closing_balance'];?></td>
              </tr>
              <?php $i++;} ?>
              <?php } ?>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <?php } ?>
  <?php foreach($data['result']['cs_result'] as $row){?>
  <tr>
    <td colspan="2" class="no-padding noBdr"><table border="0" cellspacing="0" cellpadding="0" class="noBdr">
        <tr>
          <td width="100" class="bdr-l-none bdr-r-none" style="background:#444; color:#fff; font-weight:bold;text-align:center;"><?=$row['category_name'];?></td>
          <td width="936" class="no-padding noBdr bdr-r-none"><table width="937" border="0" cellpadding="0" cellspacing="0" class="noBdr">
              <?php if(count($row['sub_category'])>0){ ?>
              <?php $i=1;foreach($row['sub_category'] as $sub_row){?>
              <tr>
                <td width="135" class="">0
                  <?=$i;?></td>
                <td width="98" class=""><?=$sub_row['sub_category_name'];?></td>
                <td width="158" class=""><?=$sub_row['opening_balance'];?></td>
                <td width="101" class=""><?=$sub_row['receipt_balance'];?></td>
                <td width="80" class=""><?=$sub_row['total_sell'];?></td>
                <td width="161" class=""><?=$sub_row['closing_balance'];?></td>
                <td width="204" class=""><?=$sub_row['prevYear_closing_balance'];?></td>
              </tr>
              <?php $i++;} ?>
              <?php } ?>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <?php } ?>
  <?php foreach($data['result']['os_result'] as $row){?>
  <tr>
    <td colspan="2" class="no-padding noBdr"><table border="0" cellspacing="0" cellpadding="0" class="noBdr">
        <tr>
          <td width="100" class="bdr-l-none bdr-r-none" style="background:#444; color:#fff; font-weight:bold;text-align:center;"><?=$row['category_name'];?></td>
          <td width="936" class="no-padding noBdr bdr-r-none"><table width="937" border="0" cellpadding="0" cellspacing="0" class="noBdr">
              <?php if(count($row['sub_category'])>0){ ?>
              <?php $i=1;foreach($row['sub_category'] as $sub_row){?>
              <tr>
                <td width="135" class="">0
                  <?=$i;?></td>
                <td width="98" class=""><?=$sub_row['sub_category_name'];?></td>
                <td width="158" class=""><?=$sub_row['opening_balance'];?></td>
                <td width="101" class=""><?=$sub_row['receipt_balance'];?></td>
                <td width="80" class=""><?=$sub_row['total_sell'];?></td>
                <td width="161" class=""><?=$sub_row['closing_balance'];?></td>
                <td width="204" class=""><?=$sub_row['prevYear_closing_balance'];?></td>
              </tr>
              <?php $i++;} ?>
              <?php } ?>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <?php } ?>
  <?php } ?>
  <tr>
    <td colspan="2" class="no-padding noBdr"><table border="0" cellspacing="0" cellpadding="0" class="noBdr">
        <tr>
          <td width="100" class="bdr-l-none bdr-r-none" style="background:#444; color:#fff; font-weight:bold;text-align:center;"><?=$data['result']['beer_result']['category_name'];?></td>
          <td width="936" class="no-padding noBdr bdr-r-none"><table width="937" border="0" cellpadding="0" cellspacing="0" class="noBdr">
              <tr>
                <td width="135" class="">0
                  <?=$i;?></td>
                <td width="98" class="">Beer made in India</td>
                <td width="158" class=""><?=$data['result']['beer_result']['opening_balance'];?></td>
                <td width="101" class=""><?=$data['result']['beer_result']['receipt_balance'];?></td>
                <td width="80" class=""><?=$data['result']['beer_result']['total_sell'];?></td>
                <td width="161" class=""><?=$data['result']['beer_result']['closing_balance'];?></td>
                <td width="204" class=""><?=$data['result']['beer_result']['prevYear_closing_balance'];?></td>
              </tr>
              <tr>
                <td width="135" class="">0</td>
                <td width="98" class="">Beer made in Bhutan</td>
                <td width="158" class="">0</td>
                <td width="101" class="">0</td>
                <td width="80" class="">0</td>
                <td width="161" class="">0</td>
                <td width="204" class="">0</td>
              </tr>
              <tr>
                <td width="135" class="">0</td>
                <td width="98" class="">Beer made in Nepal</td>
                <td width="158" class="">0</td>
                <td width="101" class="">0</td>
                <td width="80" class="">0</td>
                <td width="161" class="">0</td>
                <td width="204" class="">0</td>
              </tr>
              <tr>
                <td width="135" class="">0</td>
                <td width="98" class="">Beer manufactured overseas</td>
                <td width="158" class="">0</td>
                <td width="101" class="">0</td>
                <td width="80" class="">0</td>
                <td width="161" class="">0</td>
                <td width="204" class="">0</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" class="no-padding noBdr"><table border="0" cellspacing="0" cellpadding="0" class="noBdr">
        <tr>
          <td width="100" class="bdr-l-none bdr-r-none" style="background:#444; color:#fff; font-weight:bold;text-align:center;">TOTAL</td>
          <td width="936" class="no-padding noBdr bdr-r-none"><table width="937" border="0" cellpadding="0" cellspacing="0" class="noBdr">
              <tr>
                <td width="135" class="">TFL</td>
                <td width="98" class="">Total : Foreign Liquor</td>
                <td width="158" class=""><?=$data['result']['imfl_osbi_os_result'][0]['opening_balance'];?></td>
                <td width="101" class=""><?=$data['result']['imfl_osbi_os_result'][0]['receipt_balance'];?></td>
                <td width="80" class=""><?=$data['result']['imfl_osbi_os_result'][0]['total_sell'];?></td>
                <td width="161" class=""><?=$data['result']['imfl_osbi_os_result'][0]['closing_balance'];?></td>
                <td width="204" class=""><?=$data['result']['imfl_osbi_os_result'][0]['prevYear_closing_balance'];?></td>
              </tr>
              <tr>
                <td width="135" class="">TBR</td>
                <td width="98" class="">Total : Beer</td>
                <td width="158" class=""><?=$data['result']['beer_result']['opening_balance'];?></td>
                <td width="101" class=""><?=$data['result']['beer_result']['receipt_balance'];?></td>
                <td width="80" class=""><?=$data['result']['beer_result']['total_sell'];?></td>
                <td width="161" class=""><?=$data['result']['beer_result']['closing_balance'];?></td>
                <td width="204" class=""><?=$data['result']['beer_result']['prevYear_closing_balance'];?></td>
              </tr>
              <tr>
                <td width="135" class="">TCS</td>
                <td width="98" class="">Total : Country Spirit</td>
                <td width="158" class=""><?=$data['result']['cs_result'][0]['opening_balance'];?></td>
                <td width="101" class=""><?=$data['result']['cs_result'][0]['receipt_balance'];?></td>
                <td width="80" class=""><?=$data['result']['cs_result'][0]['total_sell'];?></td>
                <td width="161" class=""><?=$data['result']['cs_result'][0]['closing_balance'];?></td>
                <td width="204" class=""><?=$data['result']['cs_result'][0]['prevYear_closing_balance'];?></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" class="no-padding noBdr"><table border="0" cellspacing="0" cellpadding="0" class="noBdr">
        <tr>
          <td width="100" class="bdr-l-none bdr-r-none" style="background:#444; color:#fff; font-weight:bold; text-align:center;">Fees Paid</td>
          <td width="936" class="no-padding noBdr bdr-r-none"><table width="937" border="0" cellpadding="0" cellspacing="0" class="noBdr">
              <tr>
                <td width="134" class="">R28</td>
                <td width="601" class="">Initial Grant Fee for the next Period of Settlement</td>
                <td width="202" class="">0.00</td>
              </tr>
              <tr>
                <td width="134" class="">R29</td>
                <td width="601" class="">Composition Money</td>
                <td width="202" class="">0.00</td>
              </tr>
              <tr>
                <td width="134" class="">R30</td>
                <td width="601" class="">Other fees paid, if any</td>
                <td width="202" class="">0.00</td>
              </tr>
              <tr>
                <td width="134" class="">RT</td>
                <td width="601" class="">Total fees & other monies paid</td>
                <td width="202" class="">0.00</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
