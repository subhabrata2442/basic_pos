@extends('layouts.admin_pos')
@section('admin-content')
<style>
.has-error {
    border: 1px solid #b30c0c;
}
.error {
    color: #b30c0c;
}
 
</style>
<div class="row">
  <div class="col-lg-8 col-md-8">
    <div class="d-flex align-items-center justify-content-between cbName">
      <div class="enterProduct d-flex align-items-center justify-content-between">
        <div class="enterProductInner d-flex">
          <input type="text" name="search_product" id="search_product" placeholder="Enter Barcode/Enter Product Name" value="">
          <ul id="product_search_result">
          </ul>
        </div>
        <span><i class="fas fa-barcode"></i></span> </div>
      <!--<div class="selectSale">
        <label class="switch">
          <input type="checkbox" id="sell_type">
          <span class="slider round"></span> <span class="absolute-no">Return</span> </label>
      </div>-->
    </div>
    <form method="post" action="{{ route('admin.pos.create') }}" id="pos_create_order-form" novalidate enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="payment_method_type" id="payment_method_type-input" value="cash">
      <input type="hidden" name="stock_type" value="{{$data['stock_type']}}">
      
      <div class="w-100">
        <div class="tableFixHead table-1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th width="6%">Barcode</th>
                <th width="29%">Product</th>
                <th width="7%">Stock</th>
                <th width="11%">MRP</th>
                <th width="9%">Qty.</th>
                <th width="11%">Disc%</th>
                <th width="11%">Disc Amt.</th>
                <th width="8%">Unit Price</th>
                <th width="7%">Total</th>
                <th width="1%">&nbsp;</th>
              </tr>
            </thead>
            <tbody id="product_sell_record_sec">
            </tbody>
          </table>
        </div>
      </div>
      <div class="amountToPay d-flex w-100">
        <div class="atpLeft">
          <div class="atpLeftInner">
            <ul class="d-flex w-100">
              <li class="atpVall">Total Item -</li>
              <li class="atpinfo" id="total_quantity">0</li>
              <input type="hidden" name="total_quantity" id="total_quantity-input" value="0">
            </ul>
            <ul class="d-flex w-100">
              <li class="atpVall">Total -</li>
              <li class="atpinfo"><span id="total_mrp">₹0.00</span> <small>(inclusive all taxes)</small></li>
              <input type="hidden" name="total_mrp" id="total_mrp-input" value="0">
            </ul>
            <ul class="d-flex w-100">
              <li class="atpVall">Discount -</li>
              <li class="atpinfo" id="total_discount_amount">₹0.00</li>
              <input type="hidden" name="total_discount_amount" id="total_discount_amount-input" value="0">
            </ul>
            <ul class="d-flex w-100">
              <li class="atpVall">Tax -</li>
              <li class="atpinfo" id="tax_amount">₹0.00</li>
              <input type="hidden" name="tax_amount" id="tax_amount-input" value="0">
            </ul>
            <ul class="d-flex w-100 subTotal">
              <li class="atpVall">Sub Total-</li>
              <li class="atpinfo" id="sub_total_mrp">₹0.00</li>
              <input type="hidden" name="sub_total" id="sub_total_mrp-input" value="0">
            </ul>
            <ul class="d-flex w-100">
              <li class="atpVall">Round Off -</li>
              <li class="atpinfo">
                <input type="text" name="round_off" id="round_off" class="small-input" placeholder="0" onkeydown="checkforroundoff(event,this)">
              </li>
            </ul>
          </div>
        </div>
        <div class="atpMid d-flex justify-content-center align-items-center">
          <ul>
            <li><a href="javascript:;" class="applyCharge" id="applyChargeBtn">Apply Charge</a></li>
            <li><a href="javascript:;" class="applyDiscount" id="applyDiscountBtn">Apply Discount </a></li>
          </ul>
        </div>
        <div class="atpRight d-flex justify-content-center align-items-center">
          <div class="text-center">
            <h6>Amount to pay</h6>
            <h3 id="total_payble_amount">₹0.00</h3>
            <input type="hidden" name="gross_total_amount" id="gross_total_amount-input" value="0">
            <input type="hidden" name="total_payble_amount" id="total_payble_amount-input" value="0">
            <input type="hidden" name="special_discount_percent" id="selling_special_discount_percent-input" value="0">
            <input type="hidden" name="special_discount_amt" id="selling_special_discount_amt-input" value="0">
            <input type="hidden" name="charge_amt" id="charge_amt-input" value="0">
            
            <input type="hidden" name="tendered_amount" id="total_tendered_amount" value="0">
            <input type="hidden" name="tendered_change_amount" id="total_tendered_change_amount" value="0">
          </div>
        </div>
      </div>
      
      <div class="note_coin_count_sec" style="display:none">
      </div>
      
      
    </form>
  </div>
  <div class="col-lg-4 col-md-4">
    <div class="srcArea relative">
      <input type="text" placeholder="Search by name" class="input-2">
      <span class="plusCircle"><i class="fas fa-plus-circle"></i></span> </div>
    <div class="dateSales">
      <ul class="d-flex justify-content-between align-items-center">
        <li><strong>Cashier :</strong> Alok Saha</li>
        <li class="d-flex align-items-center">
          <p>Date</p>
          <input type="date" placeholder="Search by name" class="input-2">
        </li>
      </ul>
    </div>
    <div class="customerDetails">
      <h4>Customer Details<span class="float-right" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="fas fa-info-circle"></i></span></h4>
      <div class="customerDetailsMid">
        <ul>
          <li>Customer Name : <span></span></li>
          <li>Contact Number : <span></span></li>
          <!-- <li>Total Purchase : <span>0</span></li>
          <li>Loyalty Points : <span>0</span></li>
          <li>Member Ship : <span>Gold</span></li>
          <li>Member Ship Discount : <span> CONGRATS22 (50%)
          <li>Coupon : <span>GH569RT66</span></li> -->
        </ul>
      </div>
      <div class="customerDetailsBtm">
        <ul class="d-flex">
          <li>Last Bill No - <span></span></li>
          <li>Bill Amount - <span>₹0</span></li>
          <li class="ml-auto"><i class="fas fa-print"></i></li>
        </ul>
      </div>
    </div>
    <div class="sidebar-widget text-center">
      <ul class="row">
        <li class="col-3"><a href="jsvascript:;" data-bs-toggle="modal" data-bs-target="#modal-1"><span><i class="fas fa-ticket-alt"></i></span>Apply<br>
          Coupon</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-user-check"></i></span>Apply<br>
          Membership</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-calculator"></i></span>Calculator</a></li>
        <li class="col-3"><a href="jsvascript:;" data-bs-toggle="modal" data-bs-target="#modal-2"><span><i class="fas fa-credit-card"></i></span>Reedem Credit</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-hand-paper"></i></span>Hold</a></li>
        <li class="col-3"><a href="jsvascript:;" data-bs-toggle="modal" data-bs-target="#modal-3"><span><i class="fas fa-street-view"></i></span>View Hold</a></li>
        <li class="col-3"><a href="javascript:;"><span><i class="fas fa-wallet"></i></span>Reset Bill</a></li>
        <li class="col-3"><a href="javascript:;"><span><i class="fas fa-luggage-cart"></i></span>Today Sale</a></li>
        <li class="payPrint col-6"><a href="javascript:;" class="payBtn"><span><i class="fas fa-money-check"></i></span>pay</a></li>
        <li class="payPrint col-6"><a href="{{ route('admin.pos.print_invoice') }}" target="_blank"><span><i class="fas fa-print"></i></span>Print</a></li>
      </ul>
    </div>
  </div>
  <div class="col-12">
    <div class="topsellingProduct">
      <h4>Top Selling Sroducts</h4>
      <ul class="row">
        <li><a href="javascript:;" data-id="102" class="addTopSellingProduct"><img src="{{ url('assets/admin/images/1.png') }}" alt=""><span>Best Taste (600 ml)</span></a></li>
        <li><a href="javascript:;" data-id="742" class="addTopSellingProduct"><img src="{{ url('assets/admin/images/1.png') }}" alt=""><span>SEAGRAMS IMPERIAL BLUE CLASSIC GRAIN WHISKY (750  ml)</span></a></li>
        <li><a href="javascript:;" data-id="663" class="addTopSellingProduct"><img src="{{ url('assets/admin/images/1.png') }}" alt=""><span>OFFICER'S CHOICE DELUXE WHISKY (750  ml)</span></a></li>
        <li><a href="javascript:;" data-id="632" class="addTopSellingProduct"><img src="{{ url('assets/admin/images/1.png') }}" alt=""><span>Mc Dowells No.1 Luxury Premium Whisky (750  ml)</span></a></li>
        <li><a href="javascript:;" data-id="306" class="addTopSellingProduct"><img src="{{ url('assets/admin/images/1.png') }}" alt=""><span>Old Monk Lemon Rum (750  ml)</span></a></li>
        <li><a href="javascript:;" data-id="9" class="addTopSellingProduct"><img src="{{ url('assets/admin/images/1.png') }}" alt=""><span>BIRA91 GOLD WHEAT STRONG BEER (650  ml)</span></a></li>
        <li><a href="javascript:;" data-id="293" class="addTopSellingProduct"><img src="{{ url('assets/admin/images/1.png') }}" alt=""><span>McDowells No.1 Celebration Matured XXX Rum (750  ml)</span></a></li>
        <li><a href="javascript:;" data-id="40" class="addTopSellingProduct"><img src="{{ url('assets/admin/images/1.png') }}" alt=""><span>Kingfisher Strong Premium Beer (650  ml)</span></a></li>
      </ul>
    </div>
  </div>
</div>
<div class="modal fade modalMdHeader" id="modal-applyDiscount" tabindex="-1" aria-labelledby="modal-1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-1Label">Discount</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="applyCouponBox">
          <form action="" method="get" id="applyDiscount-form">
            <div class="mb-3">
              <label for="" class="form-label">Discount (%)</label>
              <input type="text" class="form-control number" name="special_discount_percent" id="special_discount_percent" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Discount Amt</label>
              <input type="text" class="form-control number" name="special_discount_amt" id="special_discount_amt" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <div class="modal-footer invoiceBalance">
        <h6>Total Payable: <span id="discount_total_payable">0</span></h6>
      </div>
    </div>
  </div>
</div>
<div class="modal fade modalMdHeader" id="modal-applyCharges" tabindex="-1" aria-labelledby="modal-1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-1Label">Apply Charge</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="applyCouponBox">
          <form action="" method="get" id="applyCharge-form">
            <div class="mb-3">
              <label for="" class="form-label">Charge Amt</label>
              <input type="text" class="form-control number" name="charge_amt" id="charge_amt" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <div class="modal-footer invoiceBalance">
        <h6>Total Payable: <span id="charge_total_payable">0</span></h6>
      </div>
    </div>
  </div>
</div>

<!--<div class="modal fade modalMdHeader" id="modal-2" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="applyCouponBox">
          <form action="" method="get">
            <div class="mb-3">
              <label for="" class="form-label">Scan Barcode/Type Number</label>
              <input type="email" class="form-control" id="">
            </div>
            <div class="mb-3">
              <table class="table table-striped" width="100%">
                <tbody>
                  <tr>
                    <td width="65%">Credit Note Date </td>
                    <td width="35%" align="right">N/A</td>
                  </tr>
                  <tr>
                    <td>Credit Amount</td>
                    <td align="right">0</td>
                  </tr>
                  <tr>
                    <td>Credit Available</td>
                    <td align="right">0</td>
                  </tr>
                  <tr>
                    <td>Apply Credit</td>
                    <td align="right"><input type="text" name="" id="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><i class="fas fa-rupee-sign"></i> <strong>Payable Amt</strong></td>
                    <td align="right"><strong>16</strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <button type="submit" class="btn btn-info">Apply Credit</button>
          </form>
        </div>
      </div>
      <div class="modal-footer invoiceBalance">
        <h6>Invoice Balance: <span>16</span></h6>
      </div>
    </div>
  </div>
</div>--> 
<!--<div class="modal fade modalMdHeader" id="modal-3" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="holdBillList">
          <ul>
            <li> <a href="#">
              <div class="d-flex justify-content-between w-100">
                <p><strong>ORD :</strong> <span>HOLD1</span></p>
                <p><strong>Amt :</strong> <i class="fas fa-rupee-sign"></i> 16</p>
              </div>
              <p><strong>Contact Name :</strong> In Customer</p>
              <p><strong>Created On :</strong> <i class="fas fa-calendar-alt"></i> <span>2022-09-01 3:38 pm</span></p>
              </a>
              <div class="print mt-2">
                <button class="btn btn-info"><i class="fas fa-print"></i> print</button>
              </div>
            </li>
            <li> <a href="#">
              <div class="d-flex justify-content-between w-100">
                <p><strong>ORD :</strong> <span>HOLD1</span></p>
                <p><strong>Amt :</strong> <i class="fas fa-rupee-sign"></i> 16</p>
              </div>
              <p><strong>Contact Name :</strong> In Customer</p>
              <p><strong>Created On :</strong> <i class="fas fa-calendar-alt"></i> <span>2022-09-01 3:38 pm</span></p>
              </a>
              <div class="print mt-2">
                <button class="btn btn-info"><i class="fas fa-print"></i> print</button>
              </div>
            </li>
            <li> <a href="#">
              <div class="d-flex justify-content-between w-100">
                <p><strong>ORD :</strong> <span>HOLD1</span></p>
                <p><strong>Amt :</strong> <i class="fas fa-rupee-sign"></i> </p>
              </div>
              <p><strong>Contact Name :</strong> In Customer</p>
              <p><strong>Created On :</strong> <i class="fas fa-calendar-alt"></i> <span>2022-09-01 3:38 pm</span></p>
              </a>
              <div class="print mt-2">
                <button class="btn btn-info"><i class="fas fa-print"></i> print</button>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="modal-footer invoiceBalance">
        <h6>Invoice Balance: <span>16</span></h6>
      </div>
    </div>
  </div>
</div>-->

<section class="payWrap"> <span class="payWrapCloseBtn paymentModalCloseBtn"><i class="fas fa-times-circle"></i></span>
  <div class="p-5">
    <div class="row">
      <div class="payWrapLeft">
        <div class="pmMenu">
          <ul>
            <li><a href="javascript:;" class="active p-method-tab" data-type="cash"><span><img src="{{ url('assets/admin/images/cash.png') }}" alt=""></span> Cash</a></li>
            <li><a href="javascript:;" class="p-method-tab" data-type="card"><span><img src="{{ url('assets/admin/images/card-1.png') }}" alt=""></span> Card</a></li>
            <li><a href="javascript:;" class="p-method-tab" data-type="gPay"><span><img src="{{ url('assets/admin/images/google-pay.png') }}" alt=""></span> Phonepe / Gpay</a></li>
            <li><a href="javascript:;" class="p-method-tab" data-type="coupon"><span><img src="{{ url('assets/admin/images/coupon.png') }}" alt=""></span> Coupon</a></li>
            <li><a href="javascript:;" class="p-method-tab" data-type="credit_card"><span><img src="{{ url('assets/admin/images/credit-card.png') }}" alt=""></span> Credit</a></li>
            <li><a href="javascript:;" class="p-method-tab" data-type="multiple_pay"><span><img src="{{ url('assets/admin/images/pay-per-click.png') }}" alt=""></span> Multiple Pay</a></li>
          </ul>
        </div>
      </div>
      <div class="payWrapRight">
        <div class="pmDetails">
          <div class="cashOption tab_sec" id="cash_payment_sec">
            <div class="cashOptionTop">
              <ul class="row justify-content-center">
                <li class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="mb-3 cashOptionTopBox">
                    <label for="due_amount_tendering-input" class="form-label">Due Ammout</label>
                    <input type="text" class="form-control tendering-input" id="due_amount_tendering" value="0" readonly="readonly" disabled="disabled"/>
                  </div>
                </li>
                <li class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="mb-3 cashOptionTopBox">
                    <label for="tendered_amount" class="form-label">Tendered</label>
                    <input type="text" class="form-control tendering-input" id="tendered_amount" value="0" onkeypress="return check_character(event);">
                  </div>
                </li>
                <li class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="mb-3 cashOptionTopBox">
                    <label for="tendered_change_amount-input" class="form-label">Change</label>
                    <input type="text" class="form-control tendering-input" id="tendered_change_amount" value="0" readonly="readonly" disabled="disabled"/>
                  </div>
                </li>
              </ul>
            </div>
            <div class="cashOptionBtm text-center">
              <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <td width="20%"><a href="javascript:;" class="tendered_number_btn" data-id="1">1</a></td>
                    <td width="20%"><a href="javascript:;" class="tendered_number_btn" data-id="2">2</a></td>
                    <td width="20%"><a href="javascript:;" class="tendered_number_btn" data-id="3">3</a></td>
                    <td width="20%"><a href="javascript:;" class="tendered_plus_number_btn" data-id="5">+5</a></td>
                    <td width="20%"><a href="javascript:;" class="tendered_plus_number_btn" data-id="100">+100</a></td>
                  </tr>
                  <tr>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id="4">4</a></td>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id="5">5</a></td>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id="6">6</a></td>
                    <td><a href="javascript:;" class="tendered_plus_number_btn" data-id="10">+10</a></td>
                    <td><a href="javascript:;" class="tendered_plus_number_btn" data-id="500">+500</a></td>
                  </tr>
                  <tr>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id="7">7</a></td>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id="8">8</a></td>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id="9">9</a></td>
                    <td><a href="javascript:;" class="tendered_plus_number_btn" data-id="20">+20</a></td>
                    <td><a href="javascript:;" class="tendered_plus_number_btn" data-id="2000">+2000</a></td>
                  </tr>
                  <tr>
                    <td><a href="javascript:;" class="tendered_number_reset">C</a></td>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id="0">0</a></td>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id=".">.</a></td>
                    <td><a href="javascript:;" class="tendered_plus_number_btn" data-id="50">+50</a></td>
                    <td><a href="javascript:;" class="tendered_number_btn" data-id="-1"><i class="fas fa-times-circle"></i></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-center">
              <ul class="d-flex">
                <li class="col-auto">
                  <button type="button" class="saveBtn-2" id="calculate_cash_payment_btn">Submit</button>
                </li>
                <li class="col-auto"><a href="javascript:;" class="saveBtnBdr paymentModalCloseBtn">Cancel</a></li>
              </ul>
            </div>
          </div>
          <div class="noteType tab_sec" style="display:none" id="rupee_payment_sec">
            <div class="cashOptionTop">
              <ul class="row justify-content-center">
                <li class="col-12">
                  <div class="mb-3 cashOptionTopBox">
                    <label for="rupee_due_amount_tendering" class="form-label">Due Ammout</label>
                    <span style="color: #1c0a6b;" id="rupee_due_amount_tendering">0</span> </div>
                    <input type="hidden" id="rupee_due_amount_tendering-input" value="0">
                  
                </li>
              </ul>
            </div>
            <div class="rupeeTableMdArea">
              <div class="row">
                <div class="col-6">
                  <div class="rupeeTableMd">
                    <table class="table noBdr">
                      <tbody>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/2000.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_2000-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_2000" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_2000">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/500.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_500-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_500" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_500">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/200.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_200-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_200" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_200">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/100.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_100-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_100" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_100">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/50.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_50-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_50" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_50">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/20.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_20-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_20" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_20">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/10.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_10-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_10" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_10">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/5.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_5-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_5" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_5">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/2.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_2-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_2" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_2">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/1.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="rupee_1-input" data-type="note" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="rupee_1" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-rupee_1">0</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-6">
                  <div class="rupeeTableMd forCoin">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/c-10.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="coin_10-input" data-type="coin" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="coin_10" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-coin_10">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/c-5.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="coin_5-input" data-type="coin" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="coin_5" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-coin_5">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/c-2.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="coin_2-input" data-type="coin" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="coin_2" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-coin_2">0</td>
                        </tr>
                        <tr>
                          <td><img src="{{ url('assets/admin/images/c-1.jpg') }}" alt=""></td>
                          <td>x</td>
                          <td><input type="text" id="coin_1-input" data-type="coin" class="input-1 rupee_count_input" onkeypress="return check_character(event);"></td>
                          <input type="hidden" id="coin_1" class="input-1 rupee_count">
                          <td>=</td>
                          <td id="amount_per_note-coin_1">0</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <ul class="d-flex">
                <li class="col-auto">
                  <button type="button" class="saveBtn-2" onclick="final_payment_submit('cash')">Submit</button>
                </li>
                <li class="col-auto"><a href="javascript:;" class="saveBtnBdr" onclick="backToLink('cash_payment_sec','p_tap')">Back</a></li>
              </ul>
            </div>
          </div>
          <div class="applyCoupon tab_sec" id="coupon_payment_sec" style="display: none;">
            <div class="applyCouponTop">
              <h3>Apply Coupon</h3>
              <div class="relative applyCouponInput">
                <input type="text" placeholder="Please Type Coupon Code" class="input-2"/>
                <a href="#" class="ApplyBtn">Apply</a> </div>
            </div>
            <div class="applyCouponBtm">
              <div class="mb-3 text-center invoiceBalance-2"> <span>Invoice Balance : 160</span> </div>
              <form action="get">
                <div class="mb-3">
                  <input type="text" class="form-control input-2" id="" placeholder="Coupon Name">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control input-2" id="" placeholder="Customer Coupon">
                </div>
                <div class="mb-3">
                  <ul class="d-flex">
                    <li>
                      <button type="button" class="btn btn-primary">Submit</button>
                    </li>
                    <li><a href="#" class="btn btn-outline-secondary ml-3">Cancel</a></li>
                  </ul>
                </div>
              </form>
            </div>
          </div>
          <div class="applyCoupon tab_sec" id="card_payment_sec" style="display: none;">
            <div class="applyCouponTop">
              <h3>Card Details</h3>
              <form action="get">
                <div class="mb-3">
                  <label for="" class="form-label">Payment Account</label>
                  <select class="form-select">
                    <option>Disabled select</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Customer Bank Name</label>
                  <input type="text" class="form-control input-2" id="" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Card Payment Amount</label>
                  <input type="text" class="form-control input-2" id="" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Card Holder Name</label>
                  <input type="text" class="form-control input-2" id="" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Card transaction No</label>
                  <input type="text" class="form-control input-2" id="" placeholder="">
                </div>
                <div class="mb-3">
                  <button type="button" class="saveBtn-2">Finalize Payment</button>
                </div>
              </form>
            </div>
          </div>
          <div class="paymentOption tab_sec" id="gPay_payment_sec" style="display: none;">
            <div class="paymentOptionTop">
              <ul class="row">
                <li><a href="#" class="active"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/paytm.jpg" alt=""></a></li>
                <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/phonepay.jpg" alt=""></a></li>
                <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/gpay.jpg" alt=""></a></li>
                <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/upi.jpg" alt=""></a></li>
              </ul>
            </div>
            <div class="paymentOptionInputBox">
              <form action="get">
                <div class="mb-3">
                  <input type="text" placeholder="" class="input-2 paymentOptionInput"/>
                </div>
                <div class="d-flex justify-content-center">
                  <ul class="d-flex">
                    <li class="col-auto">
                      <button type="button" class="saveBtn-2">Submit</button>
                    </li>
                    <li class="col-auto"><a href="#" class="saveBtnBdr">Cancel</a></li>
                  </ul>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts') 
<script>
var stock_type	= "{{$data['stock_type']}}";
</script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script src="{{ url('assets/admin/js/pos.js') }}"></script> 
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
@endsection 