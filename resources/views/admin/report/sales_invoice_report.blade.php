@extends('layouts.admin')
@section('admin-content')
<style>
  .select2-container .select2-container--default,
  .select2-container .select2-selection--single {
    border-radius: 5px !important;
    height: calc(2.2125rem + 2px) !important;
  }

  .select2-selection.select2-selection--single {
    height: calc(2.2125rem + 2px) !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 14px;
  }

  .select2-selection__clear {
    display: none !important;
  }

  .select2-container--default .select2-selection--multiple,
  .select2-container--default .select2-selection--single {
    border: 1px solid #ebedf2 !important;
  }
</style>
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
    <div class="card-body card">
      <div class="d-flex justify-content-between">
          <span class="d-block font-14 text-dark derkBlueColor font-weight-bold">Report from <span class="fromdate"></span> to <span class="todate"></span></span>
      </div>
      <div>
        <span class="d-block display-6 text-dark"><span class="totalinvoice">0</span> <span class="invoiceLabel"></span></span>
      </div>

      <div>
        <span class="square" style="display: inline-block;position: relative;top: 3px;background:#fff !important;border:1px solid #d5d5d5 !important;"></span>
        <span style="font-size: 14px">Indicates Fully pending Challans.</span><br>
        <span class="square" style="display: inline-block;position: relative;top: 3px;background:#FFD08A !important;"></span>
        <span style="font-size: 14px">Indicates Partially Billed and returned(Cancelled).</span><br>
        <span class="square" style="display: inline-block;position: relative;top: 3px;background:#ffcfbe !important;"></span>
        <span style="font-size: 14px">Indicates Fully Returned or Cancelled.</span><br>
        <span class="square" style="display: inline-block;position: relative;top: 3px;background:#B6E21B !important;"></span>
        <span style="font-size: 14px">Indicates Fully Billed.</span>
        </div>
    </div>
  </div>
  <div class="col-lg-8 col-md-8 col-sm-12 col-12">
    <div class="card-body card text-center">
      <table style="width:100% !important;" cellpadding="1" border="0">
        <tbody>
          <tr>
            <td class="centerAlign derkBlueColor  font-weight-bold">Taxable Amt.</td>
            <td class="centerAlign derkBlueColor font-weight-bold">CGST Amt.</td>
            <td class="centerAlign derkBlueColor font-weight-bold">SGST Amt.</td>
            <td class="centerAlign derkBlueColor font-weight-bold">IGST Amt.</td>
            <td class="centerAlign derkBlueColor font-weight-bold">Grand Total</td>
            <td class="centerAlign derkBlueColor font-weight-bold">Pending Amt.</td>
            <td class="centerAlign derkBlueColor font-weight-bold">Billed Amt.</td>
            <td class="centerAlign derkBlueColor font-weight-bold">Returned Amt.</td>
          </tr>
          <tr>
            <td class="centerAlign">
              <h5><span class="taxabletariff">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="overallcgst">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="overallsgst">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="overalligst">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="overallgrand">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="overallconsignpendingamount">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="overallconsignamount">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="overallconsignreturnamount">0</span></h5>
            </td>
          </tr>
        </tbody>
      </table>
      <hr>
      <table style="width:100% !important;" cellpadding="1" border="0">
        <tbody>
          <tr>
            <td class="centerAlign derkBlueColor font-weight-bold" width="14%">Cash</td>
            <td class="centerAlign derkBlueColor font-weight-bold" width="14%">Card</td>
            <td class="centerAlign derkBlueColor font-weight-bold" width="14%">Cheque</td>
            <td class="centerAlign derkBlueColor font-weight-bold" width="14%">Wallet</td>
            <td class="centerAlign derkBlueColor font-weight-bold" width="14%">Unpaid Amt.</td>
            <td class="centerAlign derkBlueColor font-weight-bold" width="14%">Net Banking</td>
            <td class="centerAlign derkBlueColor font-weight-bold" width="14%">Credit Note</td>
          </tr>
          <tr>
            <td class="centerAlign">
              <h5><span class="cash">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="showcard">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="cheque">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="wallet">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="unpaidamt">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="netbanking">0</span></h5>
            </td>
            <td class="centerAlign">
              <h5><span class="creditnote">0</span></h5>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="mBody card-body-sm">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label>Branch</label>
              <select class="form-control m-select2" name="branch" placeholder="Select Branch" id="branch"
                data-col-index="1">
                <option value="">Select Branch</option>
                <option value="752" selected="selected"> SENEGALIA MART PRIVATE LIMITED</option>
                <option value="812"> SAS CHOCOLATES</option>
                <option value="864"> SURYA SWEETS</option>
                <option value="1182"> KK Store</option>
                <option value="1239"> SHREE JALARAM FASHION</option>
                <option value="1302"> kanna</option>
                <option value="1417"> BRANCH 001</option>
                <option value="1418"> BRANCH 002</option>
                <option value="1419"> BRANCH 003</option>
                <option value="1420"> BRANCH 004</option>
                <option value="1421"> BRANCH 005</option>
                <option value="1591"> Krishna Enterprise</option>
                <option value="1714"> STORE 3</option>
                <option value="2001"> JAVTA</option>
                <option value="2042"> MCR Branch</option>
                <option value="2059"> atul</option>
                <option value="2160"> Vaishali</option>
                <option value="2281"> Mumbai</option>
                <option value="2339"> Athlete</option>
                <option value="2621"> new_testing</option>
                <option value="2664"> dharmi amd</option>
                <option value="2733"> Shopaz Franchise</option>
                <option value="2741"> Vasy Franchise</option>
                <option value="2742"> demo123</option>
                <option value="2751"> Kutch Branch</option>
                <option value="2766"> JAY AMBE TEXTILES</option>
                <option value="2773"> Hritish Apparels</option>
                <option value="2797"> Tripple Green</option>
                <option value="2809"> shopzo test branch</option>
                <option value="2821"> Wellness Provision Store</option>
                <option value="2847"> KADAPA</option>
                <option value="2863"> Fortune Enterprise</option>
                <option value="2914"> Bhavesh Footwear</option>
                <option value="2922"> RN Branch1</option>
                <option value="3054"> RAHIL</option>
                <option value="3076"> kirti</option>
              </select>
            </div>
          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date Range</label>
                  <div class="input-group">
                    <input type="text" id="m_daterangepicker_1" name="dateRange" value=""
                      class="form-control form-control-sm" readonly="" placeholder="Select time">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Due Date Range</label>
                  <div class="input-group">
                    <input type="text" id="m_daterangepicker_2" name="duedateRange" value=""
                      class="form-control form-control-sm" readonly="" placeholder="Select time">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Customer</label>
              <div class="input-group">
                <select class="form-control m-select2" id="customer" name="customer" style="width: 100% !important;"
                  placeholder="Select Customer" data-allow-clear="true" autofocuse>
                  <option value="">Select Customer</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>GST</label>
              <div class="input-group">
                <select class="form-control m-select2" id="gst" name="gst" placeholder="Gst Type">
                  <option value="0">All</option>
                  <option value="1">Without GST</option>
                  <!-- <option value="2">Without GST</option> -->
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-12">
            <table class="table-sm table-bordered table-striped mb-0 w-100">
              <thead>
                <tr>
                  <th>Due Amount</th>
                  <th>Paid Amount</th>
                  <th>Total Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span class="m--font-bolder m--font-danger" id="dueamount"> 3,497,970.88 </span>
                  </td>
                  <td>
                    <span class="m--font-bolder m--font-success" id="paidamount"> 6,890,735.60 </span>
                  </td>
                  <td>
                    <span class="m--font-bolder m--font-info" id="totalamount"> 10,388,706.48 </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="table-responsive dataTable-design">
        <table id="product_list" class="table table-bordered">
          <thead>
            <th>Action</th>
            <th>Image</th>
            <th>System Barcode</th>
            <th>Product Name</th>
            <th>Supplier Barcode</th>
            <th>Category</th>
            <th>Size</th>
            <th>Brand</th>
            <th>Subcategory</th>
            <th>Color</th>
            <th>Material</th>
            <th>Vendor code</th>
            <th>Abcdefg</th>
            <th>Service</th>
            <th>UQC</th>
            <th>Cost Rate</th>
            <th>Cost GST (%)</th>
            <th>Cost GST (&#8377) </th>
            <th>Extra Charge </th>
            <th>Profit(%)</th>
            <th>Profit (&#8377) </th>
            <th>Selling Rate</th>
            <th>Selling GST (%)</th>
            <th>Selling GST (&#8377) </th>
            <th>Product MRP </th>
            <th>Offer Price</th>
            <th>Wholesale Price</th>
            <th>SKU</th>
            <th>Product Code</th>
            <th>HSN </th>
            <th>Alert Before Product Expiry(Days) </th>
            <th>Low Stock Alert </th>
            <!--<th>Note </th>-->
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

@endsection