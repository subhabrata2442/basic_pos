@extends('layouts.admin_pos')
@section('admin-content')
<style>
.product_unit_price_amount {
    width: 70px;
    margin: -29px 0 0 0 !important;
    padding: 5px 5px 6px 5px;
    border: 1px solid #ced4da;
    border-radius: 5px 0 0px 5px;
    position: relative;
    border-top: none;
    border-bottom: none;
}
</style>
<div class="row">
  <div class="col-lg-8 col-md-8">
    <div class="d-flex align-items-center justify-content-between cbName">
      <div class="enterProduct d-flex align-items-center justify-content-between">
        <div class="enterProductInner d-flex">
          <input type="text" name="search_product" id="search_product" placeholder="Enter Barcode/Enter Product Name" value="SEAGRAMS BLENDERS PRIDE SELECT PREMIUM WHISKY">
          <ul id="product_search_result">
          </ul>
        </div>
        <span><i class="fas fa-barcode"></i></span> </div>
      <div class="selectSale"> 
        <!-- <ul class="d-flex">
          <li>
            <input type="radio" id="r1" name="radio" value="" >
            <label for="r1">Sale</label>
          </li>
          <li>
            <input type="radio" id="r2" name="radio" value="" >
            <label for="r2">Sale Return</label>
          </li>
        </ul> -->
        <label class="switch">
          <input type="checkbox" id="sell_type">
          <span class="slider round"></span> <span class="absolute-no">NO</span> </label>
      </div>
    </div>
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
            <tr id="sell_product_2" data-id="2">
              <input type="hidden" id="product_w_stock_2" value="96">
              <input type="hidden" id="product_c_stock_2" value="48">
              <td>00451</td>
              <td>SEAGRAMS BLENDERS PRIDE SELECT PREMIUM WHISKY (750  ml)</td>
              <td id="product_stock_2">W-96<br>
                S-48</td>
              <td id="product_mrp_2">920</td>
              <td><input type="number" id="product_qty_2" class="input-3 product_qty" value="1"></td>
              <td><input type="text" id="product_disc_percent_2" class="product_disc_percent input-3" value="0"></td>
              <td><input type="text" id="product_disc_amount_2" class="input-3" value="0"></td>
              <td><select id="product_unit_price_2" class="product_unit_price">
                  <option value="920">920</option>
                  <option value="900">900</option>
                </select>
                <input type="text" class="product_unit_price_amount" id="product_unit_price_amount_2" value="920" readonly="readonly"></td>
              <td id="product_total_amount_2">920.00</td>
              <td><a href="javascript:;" onclick="remove_sell_item(2);"><i class="fas fa-times"></i></a></td>
            </tr>
            <tr id="sell_product_1" data-id="1">
              <input type="hidden" id="product_w_stock_1" value="48">
              <input type="hidden" id="product_c_stock_1" value="24">
              <td>00451</td>
              <td>SEAGRAMS BLENDERS PRIDE SELECT PREMIUM WHISKY (375 ml)</td>
              <td id="product_stock_1">W-48<br>
                S-24</td>
              <td id="product_mrp_1">490</td>
              <td><input type="number" id="product_qty_1" class="input-3 product_qty" value="1"></td>
              <td><input type="text" id="product_disc_percent_1" class="input-3" value="0"></td>
              <td><input type="text" id="product_disc_amount_1" class="input-3" value="0"></td>
              <td id="product_unit_price_1">490</td>
              <td id="product_total_amount_1">665.00</td>
              <td><a href="javascript:;" onclick="remove_sell_item(1);"><i class="fas fa-times"></i></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- <div class="w-100 productTable">
      <div class="tableFixHead">
        <table>
          <thead>
            <tr>  	  	          	                                     
              <th>Product Name</th>
              <th>Serial No</th>
              <th>Notes</th>
              <th>Rate</th>
              <th>Qty.</th>
              <th>Disc%</th>
              <th>Disc Amt.</th>
              <th>Unit Price</th>
              <th>Total</th>
              <th><a href="#"><i class="fas fa-plus-circle"></i></a></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> -->
    
    <div class="amountToPay d-flex w-100">
      <div class="atpLeft">
        <div class="atpLeftInner">
          <ul class="d-flex w-100">
            <li class="atpVall">Total Item -</li>
            <li class="atpinfo">12</li>
          </ul>
          <ul class="d-flex w-100">
            <li class="atpVall">Total -</li>
            <li class="atpinfo">₹415.70 <small>(inclusive all taxes)</small></li>
          </ul>
          <ul class="d-flex w-100">
            <li class="atpVall">Discount -</li>
            <li class="atpinfo">₹49.15</li>
          </ul>
          <ul class="d-flex w-100">
            <li class="atpVall">Tax -</li>
            <li class="atpinfo">₹8.44</li>
          </ul>
          <ul class="d-flex w-100 subTotal">
            <li class="atpVall">Sub Total-</li>
            <li class="atpinfo">₹415.70</li>
          </ul>
          <ul class="d-flex w-100">
            <li class="atpVall">Round Off -</li>
            <li class="atpinfo">(-) 0.70</li>
          </ul>
        </div>
      </div>
      <div class="atpMid d-flex justify-content-center align-items-center">
        <ul>
          <li><a href="#" class="applyCharge">Apply Charge</a></li>
          <li><a href="#" class="applyDiscount">Apply Discount </a></li>
        </ul>
      </div>
      <div class="atpRight d-flex justify-content-center align-items-center">
        <div class="text-center">
          <h6>Amount to pay</h6>
          <h3>₹415.00</h3>
        </div>
      </div>
    </div>
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
          <li>Customer Name : <span>Mithun Dey</span></li>
          <li>Contact Number : <span>0123456789</span></li>
          <!-- <li>Total Purchase : <span>0</span></li>
          <li>Loyalty Points : <span>0</span></li>
          <li>Member Ship : <span>Gold</span></li>
          <li>Member Ship Discount : <span> CONGRATS22 (50%)
          <li>Coupon : <span>GH569RT66</span></li> -->
        </ul>
      </div>
      <div class="customerDetailsBtm">
        <ul class="d-flex">
          <li>Last Bill No - <span>POSCN437</span></li>
          <li>Bill Amount - <span>₹17235</span></li>
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
        <li class="col-3"><a href="#"><span><i class="fas fa-wallet"></i></span>Reset Bill</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-luggage-cart"></i></span>Today Sale</a></li>
        <li class="payPrint col-6"><a href="#"><span><i class="fas fa-money-check"></i></span>pay</a></li>
        <li class="payPrint col-6"><a href="#"><span><i class="fas fa-print"></i></span>Print</a></li>
      </ul>
    </div>
  </div>
  <div class="col-12">
    <div class="topsellingProduct">
      <h4>Top Selling Sroducts</h4>
      <ul class="row">
        <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
        <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
        <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
        <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
        <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
        <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
        <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
        <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
      </ul>
    </div>
  </div>
</div>
@endsection
<div class="modal fade modalMdHeader" id="modal-1" tabindex="-1" aria-labelledby="modal-1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-1Label">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="applyCouponBox">
          <form action="" method="get">
            <div class="mb-3">
              <label for="" class="form-label">Coupon Name</label>
              <input type="email" class="form-control" id="">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Customer Coupon</label>
              <input type="email" class="form-control" id="">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <div class="modal-footer invoiceBalance">
        <h6>Invoice Balance: <span>16</span></h6>
      </div>
    </div>
  </div>
</div>
<div class="modal fade modalMdHeader" id="modal-2" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
</div>
<div class="modal fade modalMdHeader" id="modal-3" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                <p><strong>Amt :</strong> <i class="fas fa-rupee-sign"></i> 16</p>
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
</div>
@section('scripts') 
<script>
var stock_type	= 'w';
</script>
<!--<script src="{{ url('assets/admin/js/typeahead.min.js') }}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.1/typeahead.bundle.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.1/bloodhound.min.js"></script> --> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script src="{{ url('assets/admin/js/pos.js') }}"></script> 
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script> 
@endsection 