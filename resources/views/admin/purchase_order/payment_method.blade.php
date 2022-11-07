@extends('layouts.sidebar_collapse_admin')
@section('admin-content')
<div class="card p-5 pmCardHeight">
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-12">
      <div class="pmMenu">
        <ul>
          <li><a href="#">Cash</a></li>
          <li><a href="#">Upi</a></li>
          <li><a href="#">Card</a></li>
          <li><a href="#">Upi / Phone / Gpay</a></li>
          <li><a href="#">Coupon</a></li>
          <li><a href="#">Credit</a></li>
          <li><a href="#">Multiple Pay</a></li>
        </ul>
      </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-12">
      <div class="pmDetails">
        <div class="applyCoupon" style="display: none;">
          <div class="applyCouponTop">
            <h3>Apply Coupon</h3>
            <div class="relative applyCouponInput">
              <input type="text" placeholder="Please Type Coupon Code" class="input-2"/>
              <a href="#" class="ApplyBtn">Apply</a>
            </div>
          </div>
          <div class="applyCouponBtm">
            <div class="mb-3 text-center invoiceBalance">
              <span>Invoice Balance : 160</span>
            </div>
            <form action="get">
              <div class="mb-3">
                <input type="text" class="form-control input-2" id="" placeholder="Coupon Name">
              </div>
              <div class="mb-3">
                <input type="text" class="form-control input-2" id="" placeholder="Customer Coupon">
              </div>
              <div class="mb-3">
                <ul class="d-flex">
                  <li><button type="button" class="btn btn-primary">Submit</button></li>
                  <li><a href="#" class="btn btn-outline-secondary ml-3">Cancel</a></li>
                </ul>
              </div>
            </form>
          </div>
        </div>
        <div class="applyCoupon" style="display: none;">
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
                <button type="button" class="btn btn-primary">Finalize Payment</button>
              </div>
            </form>
          </div>
        </div>

        <div class="paymentOption">
          <div class="paymentOptionTop">
            <ul class="d-flex">
              <li><a href="#" class="active"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/paytm.jpg" alt=""></a></li>
              <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/phonepay.jpg" alt=""></a></li>
              <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/gpay.jpg" alt=""></a></li>
              <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/upi.jpg" alt=""></a></li>
            </ul>
          </div>

          <div class="paymentOptionInputBox">
            <input type="text" placeholder="" class="input-2 paymentOptionInput"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



@section('scripts') 
@endsection 