@extends('layouts.sidebar_collapse_admin')
@section('admin-content')
<style>
.error {
    display: none !important;
}
</style>
<div class="row">
<form method="post" action="" class="needs-validation" id="supplier-inward_stock-form" novalidate enctype="multipart/form-data">
  <div class="col-12 mb-3">
    <div class="commonBox"> 
      <!--<div class="arrowUpDown2"> <span class="arrowDown"><i class="fas fa-arrow-alt-circle-down"></i></span> </div>-->
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
          <div class="supplierWrap">
            <div class="mb-3 form-group relative formBox">
              <div class="upplierBox d-flex"> <a href="javascript:;"><span><i class="fas fa-users"></i></span>Add</a>
                <input type="text" name="supplier" id="supplier" class="form-control input-1" placeholder="Supplier" required="required">
                <input type="hidden" name="supplier_id" id="supplier_id">
                <ul id="supplier_search_result">
                </ul>
              </div>
            </div>
            <div class="invArea">
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Invoice Number</li>
                <li class="invAreaVal">
                  <input type="text" name="invoice_no" id="invoice_no" class="form-control input-1" required="required">
                </li>
              </ul>
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Purchase Date</li>
                <li class="invAreaVal">
                  <input type="date" name="purchase_date" id="purchase_date" class="form-control input-1" required="required">
                </li>
              </ul>
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Inward Date</li>
                <li class="invAreaVal">
                  <input type="date" name="inward_date" id="inward_date" class=" form-control input-1" required="required">
                </li>
              </ul>
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Tax Type</li>
                <li class="invAreaVal">
                  <select name="tax_type" id="tax_type" class="form-control form-inputtext" required>
                    <option value="">Select Type</option>
                    <option value="1">Include Tax</option>
                    <option value="2">Excludes Tax</option>
                  </select>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
          <div class="supplierDetails" id="supplier_details_sec">
            <h4>Supplier Details :</h4>
            <p> Contact : <br>
              Email : <br>
              Website : <br>
              GSTIN :<br>
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
          <div class="noteArea">
            <div class="noteAreaInner">
              <textarea name="shipping_note" id="shipping_note" cols="30" rows="10" placeholder="Shipping Note"></textarea>
            </div>
            <div class="noteAreaInner">
              <textarea name="additional_note" id="additional_note" cols="30" rows="10" placeholder="Additional Note"></textarea>
            </div>
            <div class="noteAreaInner"><a href="javascript:;" class="downloadTemplate"><i class="fas fa-download"></i> Download Inward Template</a></div>
            <div class="noteAreaInner">
              <ul class="d-flex flex-wrap justify-content-between">
                <li><a href="javascript:;" class="btn btn-info"><i class="fas fa-upload"></i> Upload Products</a></li>
                <li>
                  <button type="submit" class="btn btn-primary">Submit <i class="fas fa-paper-plane"></i></button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<form method="post" action="" class="needs-validation" id="supplier-inward_stock-product-form" novalidate enctype="multipart/form-data">
  <input type="hidden" name="company_name" id="input-supplier_company_name" />
  <input type="hidden" name="company_id" id="input-supplier_company_id" />
  <input type="hidden" name="invoice_no" id="input-supplier_invoice_no" />
  <input type="hidden" name="invoice_purchase_date" id="input-supplier_invoice_purchase_date" />
  <input type="hidden" name="invoice_inward_date" id="input-supplier_invoice_inward_date" />
  <input type="hidden" name="qty_total" id="input-supplier_qty_total" />
  <input type="hidden" name="gross_amount" id="input-supplier_gross_amount" />
  <input type="hidden" name="tax_amount" id="input-supplier_tax_amount" />
  <input type="hidden" name="sub_total" id="input-supplier_sub_total" />
  <input type="hidden" name="shipping_note" id="input-supplier_shipping_note" />
  <input type="hidden" name="additional_note" id="input-supplier_additional_note" />
  <div class="col-12 mb-3">
    <div class="commonBox purcheseDetails">
      <div class="arrowUpDown open_supplier_form"> <span class="arrowUp"><i class="fas fa-arrow-alt-circle-up"></i></span> </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Supplier Name <span class="d-block" id="supplier_company_name"></span></td>
              <td>Invoice Number<span class="d-block" id="supplier_invoice_no"></span></td>
              <td>Purchase Date<span class="d-block" id="supplier_invoice_purchase_date"></span></td>
              <td>Inward Date <span class="d-block" id="supplier_invoice_inward_date"></span></td>
              <td><ul class="d-flex addPayMeth">
                  <li class="formBox d-flex flex-wrap align-items-center">
                    <div class="addPaymentMethod"><a href="javascript:;" class="mainBtn" id="payment_detail_modal_btn">Add Payment Details</a> </div>
                    <div class="unpaidAmt">
                      <p>Unpaid Amt <span>1200</span></p>
                      <p><a href="javascript:;">[+] Addt. Charges <span>1200</span></a></p>
                    </div>
                  </li>
                </ul></td>
            </tr>
            <tr>
              <td>Quantity : <span id="qty_total">0</span></td>
              <td>Cost Price : <span id="gross_amount">0</span></td>
              <td>Tax : <span id="tax_amount"></span></td>
              <td>Total Price : <span id="sub_total"></span></td>
              <td><ul class="row">
                  <li class="col-6">
                    <label for="">Due Days</label>
                    <input type="text" name="inward_due_days" id="inward_due_days" class="input-1">
                  </li>
                  <li class="col-6">
                    <label for="">Due Date</label>
                    <input type="date" name="inward_due_date" id="inward_due_date" class="input-1">
                  </li>
                </ul></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="commonBox">
      <div class="enterBarcode mb-3">
        <div class="row">
          <div class="col">
            <div class="form-group relative enterBarcodeSrc m-0">
              <input type="text" name="product_search" id="product_search" class="form-control input-1" autocomplete="off" placeholder="Enter Barcode/Product Code/Product Name">
              <button type="button" class="searchBtn"><i class="fas fa-search"></i></button>
              <ul id="product_search_result">
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="inwordTableWrap">
        <div class="table-responsive forTableHeight">
          <table class="inwordTable table-striped table-hover table mb-0">
            <thead>
              <tr>
                <th><i class="fas fa-times"></i></th>
                <th>Add Qty</th>
                <th>Free Qty</th>
                <th>Barcode</th>
                <th>Prod Name</th>
                <th>Prod Code</th>
                <th>Batch No</th>
                <th>Base Price</th>
                <th colspan="2">Disc % & Amt</th>
                <th colspan="2">Scheme % & Amt</th>
                <th colspan="2">Free % & Amt</th>
                <th>Cost Price</th>
                <th colspan="2">GST % & Amt</th>
                <th>Extra Charge</th>
                <th colspan="2">Profit % & Amt</th>
                <th class="blue_td_border">SellPrice</th>
                <th colspan="2">GST % & Amt</th>
                <th>Offer Price</th>
                <th>MRP</th>
                <th>Mfg Date</th>
                <th>Exp Date</th>
                <th>Total Cost</th>
              </tr>
            </thead>
            <tbody id="product_record_sec">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="inwardStockBtm" id="inwardStockSubmitBtmSec" style="display:none">
    <div class="commonBox">
      <div class="form-group relative formBox m-0">
        <button type="button" class="saveBtn" id="inwardStockSubmitBtm">Save <i class="fas fa-paper-plane ml-2"></i></button>
      </div>
    </div>
  </div>
</form>
<div class="modal fade" id="paymentDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="changeAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body"> ... </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script src="{{ url('assets/admin/js/cHVyY2hhc2VfaW53YXJkX3N0b2Nr.js') }}"></script> 
<script src="{{ url('assets/admin/js/invisible_debut.js') }}"></script> 
<script>
</script> 
@endsection 