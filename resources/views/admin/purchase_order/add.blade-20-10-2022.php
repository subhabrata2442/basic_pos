@extends('layouts.sidebar_collapse_admin')
@section('admin-content')
<style>
.error {
    display: none !important;
}
.red_border {
    border: 1px solid #e50b0b;
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
            <div class="invArea">
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Supplier</li>
                <li class="invAreaVal">
                  <input type="text" name="supplier" id="supplier" class="form-control input-1" required="required" readonly="readonly" value="{{$data['supplier']->company_name ?? ''}}">
                </li>
              </ul>
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Transport Pass No.</li>
                <li class="invAreaVal">
                  <input type="text" name="tp_no" id="tp_no" class="form-control input-1" required="required">
                </li>
              </ul>
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
                <li class="invAreaInf">Warehouse</li>
                <li class="invAreaVal">
                  <div class="mb-0 form-group relative formBox">
                    <div class="upplierBox d-flex">
                      <input type="text" name="warehouse" id="warehouse" class="form-control input-1" placeholder="Warehouse" required="required">
                      <ul id="warehouse_search_result">
                      </ul>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
          <div class="supplierDetails relative customPb">
            <div class="" id="supplier_details_sec">
              <h4>Warehouse Details :</h4>
            </div>
            <div class="shippingNoteArea">
              <div class="noteAreaInner">
                <textarea name="shipping_note" id="shipping_note" cols="30" rows="10" placeholder="Shipping Note" style="height: 51px;"></textarea>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="noteAreaInner">
                    <select class="form-control custom-select form-control-select" id="invoice_stock" required="required">
                     <option value="">Select Stock</option>
                      <option value="counter" selected="selected">Counter Stock</option>
                      <!--<option value="bar">Bar Stock</option>-->
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="noteAreaInner">
                    <select class="form-control custom-select form-control-select" id="invoice_stock_type" required="required">
                      <option value="">Select Stock Type</option>
                      <option value="warehouse">Warehouse</option>
                      <option value="counter">counter</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
          <div class="supplierDetails relative">
            <h4>Payment Details</h4>
            
            <!--<div class="noteAreaInner">
              <textarea name="additional_note" id="additional_note" cols="30" rows="10" placeholder="Additional Note"></textarea>
            </div>-->
            <div class="invArea mb-3">
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Payment Mode</li>
                <li class="invAreaVal">
                  <select class="form-control custom-select form-control-select" id="payment_method" name="payment_method" required="required">
                    <option value="">Select payment method</option>
                    <option value="bevco_wallet">Bevco Wallet</option>
                    <option value="ocr">Credit/Debit Card</option>
                    <option value="cheque">Cheque</option>
                    <option value="net_banking">Net Banking</option>
                    <option value="cash">Cash</option>
                  </select>
                </li>
              </ul>
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Payment Date</li>
                <li class="invAreaVal">
                  <input type="date" name="payment_date" id="payment_date" class="form-control input-1" required="required">
                </li>
              </ul>
              <ul class="d-flex align-items-center">
                <li class="invAreaInf">Reference No</li>
                <li class="invAreaVal">
                  <input type="text" name="payment_ref_no" id="payment_ref_no" class="form-control input-1" placeholder="Ref No">
                </li>
              </ul>
            </div>
            <div class="uploadDiv"> <a href="javascript:;" class="uploadBtnMd" id="upload_invoice"><i class="fas fa-upload"></i> Click Here To Upload PDF</a>
              <p></p>
            </div>
            @if (isset($data['inward_stock_type']) && $data['inward_stock_type'] == 'edit')
            
            @else
            <div class="noteAreaInner">
              <button type="submit" class="btn btn-primary w-100">Submit <i class="fas fa-paper-plane"></i></button>
            </div>
            @endif </div>
        </div>
      </div>
    </div>
  </div>
</form>
@if (isset($data['inward_stock_type']) && $data['inward_stock_type'] == 'edit')
<form method="post" action="" class="needs-validation" id="supplier-inward_stock-product-form" novalidate enctype="multipart/form-data">
@else 
<!--style="display:none"-->
<form method="post" action="" class="needs-validation" id="supplier-inward_stock-product-form" novalidate enctype="multipart/form-data" style="display:none">
  @endif
  <input type="hidden" name="supplier_id" id="supplier_id" value="{{$data['supplier']->id ?? ''}}">
  <input type="hidden" name="warehouse_id" id="warehouse_id">
  <input type="hidden" name="invoice_no" id="input-supplier_invoice_no" />
  <input type="hidden" name="invoice_purchase_date" id="input-supplier_invoice_purchase_date" />
  <input type="hidden" name="invoice_inward_date" id="input-supplier_invoice_inward_date" />
  <input type="hidden" name="qty_total" id="input-supplier_qty_total" />
  <input type="hidden" name="gross_amount" id="input-supplier_gross_amount" />
  <input type="hidden" name="tax_amount" id="input-supplier_tax_amount" />
  <input type="hidden" name="sub_total" id="input-supplier_sub_total" />
  <input type="hidden" name="shipping_note" id="input-supplier_shipping_note" />
  <input type="hidden" name="additional_note" id="input-supplier_additional_note" />
  <input type="hidden" name="invoice_stock" id="input-invoice_stock" />
  <input type="hidden" name="invoice_stock_type" id="input-invoice_stock_type" />
  <input type="hidden" name="tcs_amt" id="input-tcs_amt" />
  <input type="hidden" name="special_purpose_fee_amt" id="input-special_purpose_fee_amt" />
  <input type="hidden" name="round_off_value_amt" id="input-round_off_value_amt" />
  <input type="hidden" name="gross_total_amount" id="input-gross_total_amount" />
  <div class="col-12 mb-3">
    <div class="commonBox purcheseDetails vTop"> @if (isset($data['inward_stock_type']) && $data['inward_stock_type'] == 'edit')
      
      @else
      <div class="arrowUpDown open_supplier_form"> <span class="arrowUp"><i class="fas fa-arrow-alt-circle-up"></i></span> </div>
      @endif
      <div class="table-responsive">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td><h5>Supplier Name</h5>
                <span class="d-block" id="supplier_company_name"></span></td>
              <td><h5>Purchase Date</h5>
                <span class="d-block" id="supplier_invoice_purchase_date"></span></td>
              <td><h5>Inward Date</h5>
                <span class="d-block" id="supplier_invoice_inward_date"></span></td>
              <td rowspan="2" class="p-0"><table class="table mb-0 tableBorderless">
                  <tr>
                    <td><strong>Total Cost</strong></td>
                    <td class="text-right"><span id="sub_total">0.00</span></td>
                  </tr>
                  <tr>
                    <td><strong>T.C.S (1%) :</strong></td>
                    <td class="text-right"><span id="tcs_amt">0.00</span></td>
                  </tr>
                  <tr>
                    <td><strong>Special Purpose Fee :</strong></td>
                    <td class="text-right"><span id="special_purpose_fee_amt">0.00</span></td>
                  </tr>
                  <tr>
                    <td><strong>Round off Value :</strong><span class="d-block text-left mt-0"><small>(To be remitted by Govermemt)</small></span></td>
                    <td class="text-right"><span id="round_off_value_amt">0.00</span></td>
                  </tr>
                  <!--<tr>
                    <td><strong>Round off :</strong></td>
                      <td class="text-right">0.22</td>
                  </tr>-->
                  <tr>
                    <td class="font-18"><strong>Total</strong></td>
                    <td class="text-right font-18"><strong id="gross_total_amount">0.00</strong></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><h5>Invoice Number</h5>
                <span class="d-block" id="supplier_invoice_no"></span></td>
              <td><h5>Transport Pass No.</h5>
                <span class="d-block" id="supplier_transport_pass_no"></span></td>
              <td><h5>Quantity :</h5>
                <span id="qty_total">0</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="commonBox"> 
      <!--<div class="enterBarcode mb-3">
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
      </div>-->
      <div class="inwordTableWrap">
        <div class="table-responsive forTableHeight">
          <table class="inwordTable table-striped table-hover table mb-0">
            <thead>
              <tr>
                <th><i class="fas fa-times"></i></th>
                <th>Barcode</th>
                <th>Case Qty</th>
                <th>Bottle/case</th>
                <th>Loose Qty</th>
                <th>Total Qty</th>
                <th>Free Qty</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Brand Name</th>
                <th>Batch No</th>
                <th>Measure</th>
                <th>Strength</th>
                <th>In B.L</th>
                <th>In LPL</th>
                <th>Unit Cost</th>
                <th>Unit Cost(Exc.SP+RO)</th>
                <th>Retailer margin</th>
                <th>Round Off</th>
                <th>SP Fee</th>
                <th>Offer Price</th>
                <th>MRP</th>
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
  @if (isset($data['inward_stock_type']) && $data['inward_stock_type'] == 'edit')
  {{--
  <div class="inwardStockBtm" id="inwardStockSubmitBtmSec" style="display:none">
      <div class="form-group relative formBox m-0">
        <button type="button" class="saveBtn saveBtnMd" id="inwardStockSubmitBtm">Update <i class="fas fa-paper-plane ml-2"></i></button>
      </div>
  </div>
  --}}
  @else
  <div class="inwardStockBtm" id="inwardStockSubmitBtmSec" style="display:none">
      <div class="form-group relative formBox m-0">
        <button type="button" class="saveBtn saveBtnMd" id="inwardStockSubmitBtm">Save <i class="fas fa-paper-plane ml-2"></i></button>
      </div>
  </div>
  @endif
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
<div class="modal fade bd-example-modal-lg" id="newProductItemsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="max-width:95%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Add</h5>
      </div>
      <div class="modal-body">
        <div class="table-responsive forTableHeight">
          <table class="inwordTable table-striped table-hover table mb-0">
            <thead>
              <tr>
                <th>Barcode</th>
                <th>Bottle/case</th>
                <th>In case</th>
                <th>Total Qty</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Brand Name</th>
                <th>Batch No</th>
                <th>Measure</th>
                <th>Strength</th>
                <th>In B.L</th>
                <th>In LPL</th>
                <th>Retailer margin</th>
                <th>Round Off</th>
                <th>SP Fee</th>
                <th>MRP</th>
                <th>Total Amount</th>
              </tr>
            </thead>
            <tbody id="new_product_record_sec">
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="saveBtn" id="addProductSubmitBtm">Submit <i class="fas fa-paper-plane ml-2"></i></button>
      </div>
    </div>
  </div>
</div>
<div style="display:none;">
  <form method="post" action="{{ route('admin.purchase.invoice_upload') }}" class="needs-validation" id="invoice_upload-form" novalidate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="upload_invoice_stock_type" id="upload_invoice_stock_type" value="counter">
    <input name="upload_invoice_pdf" id="upload_invoice_pdf" style="display:none" type="file">
  </form>
</div>
@endsection

@section('scripts') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script src="{{ url('assets/admin/js/cHVyY2hhc2VfaW53YXJkX3N0b2Nr.js') }}"></script> 
<script src="{{ url('assets/admin/js/invisible_debut.js') }}"></script> 
<script>

/*$(document).ready(function() {
	
});*/

$(document).on('click', '#upload_invoice', function(e) {
	$('#upload_invoice_pdf').click();
});

$(document).on('change','#upload_invoice_pdf',function(){
	$("#invoice_upload-form").submit()
});
</script> 
@if (isset($data['inward_stock_type']) && $data['inward_stock_type'] == 'edit') 
<script>
    $(document).ready(function() {
      
      var id = "{{$data['inward_stock_id']}}";
      var token = "{{ csrf_token() }}";
      $.ajax({
        url : "{{ route('admin.purchase.list.ajax') }}",
        data : {'token' : token,'id':id},
        type : 'GET',
        dataType : 'json',
        beforeSend: function() {
          $('#ajax_loader').fadeIn();
          $('#warehouse').val('');
          $('#warehouse_id').val('');
          $('#input-supplier_invoice_no').val('');
          $('#input-supplier_invoice_purchase_date').val('');
          $('#input-supplier_invoice_inward_date').val('');
          var warehouse_details_html = '<h4>Warehouse Details :</h4><p> Contact : <br>Email : <br></p>';

          $("#supplier_details_sec").html(warehouse_details_html);
        },
        complete: function() {
          $('#ajax_loader').fadeOut();
          //$('.loader-bg').fadeOut();
          //$('#invoice_upload-form')[0].reset();
        },
        success : function(result){
          if (result.success == 1) {
            var html = '';
            var scan_time = moment().format("DD-MM-YYYY h:mm:ss a");
            var tp_no = result.purchase_inward_stock.tp_no;
            $('#tp_no').val(tp_no);

            
            var purchase_date = result.purchase_date;
            var inward_date = result.inward_date;
            $('#purchase_date').val(purchase_date);

            var invoice_no = result.purchase_inward_stock.invoice_no;
            $('#invoice_no').val(invoice_no);

            $('#supplier_company_name').text($('#supplier').val());
            $('#supplier_invoice_purchase_date').text(purchase_date);
            $('#supplier_invoice_inward_date').text(inward_date);
            $('#supplier_invoice_no').text(invoice_no);
            $('#supplier_transport_pass_no').text(tp_no);

            $('#payment_method').val(result.purchase_inward_stock.payment_method);
            $('#payment_date').val(result.purchase_inward_stock.payment_date);
            $('#invoice_stock').val(result.purchase_inward_stock.invoice_stock);
            $('#invoice_stock_type').val(result.purchase_inward_stock.invoice_stock_type);
            $('#payment_ref_no').val(result.purchase_inward_stock.payment_ref_no);
            $('#shipping_note').val(result.purchase_inward_stock.shipping_note);
            $('#additional_note').val(result.purchase_inward_stock.additional_note);
            $('#inward_date').val(inward_date);
            // Start Warehouse Details :
            var supplier_detail = result.warehouse;

            var company_name = '';
            if (supplier_detail.company_name != null || supplier_detail.company_name != undefined) {
                company_name = supplier_detail.company_name;
            }
            var email = '';
            if (supplier_detail.email != null || supplier_detail.email != undefined) {
                email = supplier_detail.email;
            }

            var address = '';
            if (supplier_detail.address != null || supplier_detail.address != undefined) {
                address = supplier_detail.address;
            }
            var area = '';
            if (supplier_detail.area != null || supplier_detail.area != undefined) {
                area = supplier_detail.area;
            }
            var city = '';
            if (supplier_detail.city != null || supplier_detail.city != undefined) {
                city = supplier_detail.city;
            }

            var phone_no = '';
            if (supplier_detail.phone_no != null || supplier_detail.phone_no != undefined) {
                phone_no = supplier_detail.phone_no;
            }

            var pin = '';
            if (supplier_detail.pin != null || supplier_detail.pin != undefined) {
                pin = supplier_detail.pin;
            }

            $('#warehouse').val(company_name);
            $('#warehouse_id').val(result.warehouse.id);

            $('#input-supplier_invoice_no').val($('#invoice_no').val());
            $('#input-supplier_invoice_purchase_date').val($('#purchase_date').val());
            $('#input-supplier_invoice_inward_date').val($('#inward_date').val());

            var warehouse_details_html = '<h4>Warehouse Details :</h4><p><strong>' + company_name + '</strong><br>' + address + ' ,<br>INDIA, WEST BENGAL, ' + pin + '<br>Contact : ' + phone_no + '<br>Email : ' + email + '</p>';

            $("#supplier_details_sec").html(warehouse_details_html);
            //End Warehouse Details :
            //Product List
            for (var i = 0; i < result.stock_products.length; i++) {
              var item_detail = result.stock_products[i];

              var product_barcode = item_detail.product_barcode;
              var item_category = item_detail.category;
              var item_sub_category = item_detail.sub_category;
              var item_brand_name = item_detail.brand_name;
              var item_bl = item_detail.bl;
              var item_lpl = item_detail.lpl;
              var item_measure = item_detail.measure;
              var item_qty = item_detail.qty;
              var total_cost = item_detail.total_cost;
              var item_batch_no = item_detail.batch_no;

              var strength = item_detail.strength;
              var retailer_margin = item_detail.retailer_margin;
              var round_off = item_detail.round_off;
              var sp_fee = item_detail.sp_fee;
              var product_mrp = item_detail.product_mrp;

              var bottle_case 	= item_detail.total_cases;
              var bottle_per_case = item_detail.bottle_case;
              var loose_qty 		= item_detail.loose_qty;
              var in_case = item_detail.in_cases;

              var is_new = 'new_item';
              if (item_detail.product_id > 0) {
                  is_new = 'old_item';
              }
              var qty = 1;
              if (item_qty > 0) {
                  qty = item_qty;
              }

              var product_id = item_detail.product_id;
              var item_row = i;
              html += '<tr id="product_' + product_id + '" data-id="' + item_row + '" class="' + is_new + '">' +
                  '<input type="hidden" name="item_scan_time_' + product_id + '" id="item_scan_time_' + product_id + '" value="' + scan_time + '">' +
                  '<input type="hidden" name="inward_item_detail_id_' + product_id + '" id="inward_item_detail_id_' + product_id + '" value="">' +
                  '<input type="hidden" name="stock_transfers_detail_id_' + product_id + '" id="stock_transfers_detail_id_' + product_id + '" value="">' +
                  '<td><a href="javascript:;" onclick="remove(' + item_row + ');"><i class="fas fa-times"></i></a></td>' +
                  '<td id="product_barcode_' + product_id + '">' + product_barcode + '</td>' +
                  '<td id="product_case_qty_' + product_id + '">' + bottle_case + '</td>' +
                  '<td id="product_bottle_case_' + product_id + '">' + bottle_per_case + '</td>' +
                  '<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="product_loose_qty_' + product_id + '">' + loose_qty + '</td>' +

                  '<td onkeypress="return check_character(event);" class="number greenBg p_product_qty" contenteditable="true" id="product_qty_' + product_id + '">' + qty + '</td>' +
                  '<td onkeypress="return check_character(event);" class="number greenBg p_free_qty" contenteditable="true" style="color: black;" id="free_qty_' + product_id + '">0</td>' +
                  '<td>' + item_category + '</td>' +
                  '<td>' + item_sub_category + '</td>' +
                  '<td><a id="inwardproduct_popup_' + product_id + '"><span class="informative" id="brand_name_' + product_id + '">' + item_brand_name + '</span></a></td>' +
                  '<td contenteditable="true" id="batch_no_' + product_id + '">' + item_batch_no + '</td>' +
                  '<td id="measure_' + product_id + '">' + item_measure + '</td>' +
                  '<td class="number greenBg" contenteditable="true" id="strength_' + product_id + '">' + strength + '</td>' +
                  '<td class="number greenBg" contenteditable="true" id="bl_' + product_id + '">' + item_bl + '</td>' +
                  '<td class="number greenBg" contenteditable="true" id="lpl_' + product_id + '">' + item_lpl + '</td>' +
                  '<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="unit_cost_' + product_id + '"></td>' +
                  '<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="retailer_margin_' + product_id + '"></td>' +
                  '<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="round_off_' + product_id + '"></td>' +
                  '<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="sp_fee_' + product_id + '"></td>' +
                  '<td onkeypress="return check_character(event);" class="number greenBg p_offer_price" contenteditable="true" id="offer_price_' + product_id + '"></td>' +
                  '<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="product_mrp_' + product_id + '">' + product_mrp + '</td>' +
                  '<td id="total_cost_' + product_id + '">' + total_cost + '.00</td>' +
                  '</tr>';
          }

          $("#product_record_sec").html(html);
          final_calculation();
            //End Product List
            
          }else {
            toastr.error("No data found!");
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
            //toastr.error("No data found!");
            //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    });
  </script> 
@endif
@endsection 