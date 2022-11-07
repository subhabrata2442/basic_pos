@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <form method="post" action="{{ route('admin.product.edit', [base64_encode($data['products']->id)]) }}"
                    class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
      <div class="card">
        <div class="row">
          <x-alert />
          <div class="col-md-4">
            <div class="form-group">
              <label for="product_name" class="form-label">Product Name</label>
              <input type="text" class="form-control admin-input" id="product_name" name="product_name" value="{{ old('product_code', $data['products']->product_name) }}" required autocomplete="off">
              @error('product_name')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="product_code" class="form-label">Product Code</label>
              <input type="text" class="form-control admin-input" id="product_code" name="product_code"
                                    value="{{ old('product_code', $data['products']->product_code) }}" required autocomplete="off">
              @error('product_code')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="hsn_sac_code" class="form-label">HSN</label>
              <input type="text" class="form-control admin-input" id="product_hsn" name="hsn_sac_code" value="{{ old('hsn_sac_code', $data['products']->hsn_sac_code) }}" autocomplete="off">
              @error('hsn_sac_code')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="sku_code" class="form-label">Product SKU</label>
              <input type="text" class="form-control admin-input" id="sku_code" name="sku_code" value="{{ old('sku_code', $data['products']->sku_code) }}"  autocomplete="off">
              @error('sku_code')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="uqc_id" class="form-label">UQC (Measurement)</label>
              <select name="uqc_id" id="uqc_id" class="form-control form-inputtext">
                <option value="">Select UQC</option>
                <option value="1" @if ($data['products']->uqc_id == 1) selected @endif>BAG</option>
                <option value="2" @if ($data['products']->uqc_id == 2) selected @endif>BAL</option>
                <option value="3" @if ($data['products']->uqc_id == 3) selected @endif>BDL</option>
                <option value="4" @if ($data['products']->uqc_id == 4) selected @endif>BKL</option>
              </select>
              
              @error('uqc_id')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="days_before_product_expiry" class="form-label">Alert Before Product Expiry(Days)</label>
              <input type="text" class="form-control admin-input" id="days_before_product_expiry" name="days_before_product_expiry" value="{{ old('days_before_product_expiry', $data['products']->days_before_product_expiry) }}"  autocomplete="off">
              @error('days_before_product_expiry')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="days_before_product_expiry" class="form-label">Product System Barcode</label>
              <input type="text" class="form-control admin-input" id="days_before_product_expiry" name="days_before_product_expiry" value="{{ old('days_before_product_expiry', $data['products']->days_before_product_expiry) }}"  autocomplete="off">
              @error('days_before_product_expiry')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="alert_product_qty" class="form-label">Low Stock Alert</label>
              <input type="text" class="form-control admin-input" id="alert_product_qty" name="alert_product_qty" value="{{ old('alert_product_qty', $data['products']->alert_product_qty) }}"  autocomplete="off">
              @error('alert_product_qty')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="default_qty" class="form-label">MOQ (Minimum Order Quantity)</label>
              <input type="text" class="form-control admin-input" id="default_qty" name="default_qty" value="{{ old('default_qty', $data['products']->default_qty) }}"  autocomplete="off">
              @error('default_qty')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="product_desc" class="form-label">Product Description</label>
              <textarea name="product_desc" rows="3" id="product_desc" class="form-control admin-textarea" required>{{ old('product_desc', $data['products']->product_desc) }}</textarea>
              @error('product_desc')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="product_note" class="form-label">Product Note</label>
              <textarea name="product_note" rows="3" id="product_note" class="form-control admin-textarea">{{ old('product_note', $data['products']->product_note) }}</textarea>
              @error('product_note')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row">
          <x-alert />
          <div class="col-md-3">
            <div class="form-group">
              <label for="cost_rate" class="form-label">Cost Rate</label>
              <input type="text" class="form-control admin-input" id="cost_rate" name="cost_rate" value="{{ old('cost_rate', $data['products']->cost_rate) }}" required autocomplete="off">
              @error('cost_rate')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="cost_gst_percent" class="form-label">Cost GST %</label>
              <input type="text" class="form-control admin-input" id="cost_gst_percent" name="cost_gst_percent" value="{{ old('cost_gst_percent', $data['products']->cost_gst_percent) }}" required autocomplete="off">
              @error('cost_gst_percent')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="cost_gst_amount" class="form-label">Cost GST &#8377; </label>
              <input type="text" class="form-control admin-input notallowinput" id="cost_gst_amount" name="cost_gst_amount" value="{{ old('cost_gst_amount', $data['products']->cost_gst_amount) }}" autocomplete="off">
              @error('cost_gst_amount')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="cost_price" class="form-label">Cost Price</label>
              <input type="text" class="form-control admin-input notallowinput" id="cost_price" name="cost_price" value="{{ old('cost_price', $data['products']->cost_price) }}"  autocomplete="off">
              @error('cost_price')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="extra_charge" class="form-label">Extra Charge</label>
              <input type="text" class="form-control admin-input" id="extra_charge" name="extra_charge" value="{{ old('extra_charge', $data['products']->extra_charge) }}"  autocomplete="off">
              @error('extra_charge')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="profit_percent" class="form-label">Profit %</label>
              <input type="text" class="form-control admin-input" id="profit_percent" name="profit_percent" value="{{ old('profit_percent', $data['products']->profit_percent) }}"  autocomplete="off">
              @error('profit_percent')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="profit_amount" class="form-label">Profit &#8377; </label>
              <input type="text" class="form-control admin-input notallowinput" id="profit_amount" name="profit_amount" value="{{ old('profit_amount', $data['products']->profit_amount) }}"  autocomplete="off">
              @error('profit_amount')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="selling_price" class="form-label">Selling Rate</label>
              <input type="text" class="form-control admin-input notallowinput" id="selling_price" name="selling_price" value="{{ old('selling_price', $data['products']->selling_price) }}"  autocomplete="off">
              @error('selling_price')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="sell_gst_percent" class="form-label">Sell GST %</label>
              <input type="text" class="form-control admin-input" id="sell_gst_percent" name="sell_gst_percent" value="{{ old('sell_gst_percent', $data['products']->sell_gst_percent) }}"  autocomplete="off">
              @error('sell_gst_percent')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="sell_gst_amount" class="form-label">Sell GST &#8377; </label>
              <input type="text" class="form-control admin-input notallowinput" id="sell_gst_amount" name="sell_gst_amount" value="{{ old('sell_gst_amount', $data['products']->sell_gst_amount) }}"  autocomplete="off">
              @error('sell_gst_amount')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="offer_price" class="form-label">Offer Price</label>
              <input type="text" class="form-control admin-input number" id="offer_price" name="offer_price" value="{{ old('offer_price', $data['products']->offer_price) }}"  autocomplete="off">
              @error('offer_price')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="product_mrp" class="form-label">Product MRP <a href="javascript:;" data-toggle="tooltip" class="pa-0 ma-0  bold" style="font-size:20px;" data-placement="top" title="Profit is calculated on Offer Price, and not on MRP.  If you do not have Offer Price then you can keep Offer Price same as MRP." data-content="" class=""><i class="fa fa-eye cursor"></i></a></label>
              <input type="text" class="form-control admin-input number" id="product_mrp" name="product_mrp" value="{{ old('product_mrp', $data['products']->product_mrp) }}"  autocomplete="off">
              @error('product_mrp')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="wholesale_price" class="form-label">Wholesale Price</label>
              <input type="text" class="form-control admin-input number" id="wholesale_price" name="wholesale_price" value="{{ old('wholesale_price', $data['products']->wholesale_price) }}"  autocomplete="off">
              @error('wholesale_price')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row">
          <x-alert />
          <div class="suppliers-table table-responsive">
            <table class="table text-nowrap bt-none">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Product Image Caption</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><div class="product-image"> <a href="javascript:;" class="preview fetch_image" id="thumb-image"><img src="{{ $data['thumb'] ??  ''}}" alt="{{ $thumb ?? ''}}" width="150px"></a>
                      <input type="hidden" name="image" value="{{$data->image ?? ''}}" id="input-image">
                      <input name="upload_photo" id="upload_photo" style="display:none" onchange="preview_image(this.files)" type="file">
                    </div></td>
                  <td><input type="text" id="supp_name" class="form-control admin-input"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row">
          <x-alert />
          <div class="col-md-4">
            <div class="form-group">
              <label for="category" class="form-label">Category</label>
              <select name="category" id="category" class="form-control form-inputtext">
                <option value="">Select Category</option>
                <option value="1" @if ($data['products']->category == 1) selected @endif>BISCUITS</option>
                <option value="2" @if ($data['products']->category == 2) selected @endif>BODYKIT</option>
                <option value="3" @if ($data['products']->category == 3) selected @endif>Cadbury</option>
              </select>
              @error('category')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="category" class="form-label">Size</label>
              <select name="size" id="size" class="form-control form-inputtext">
                <option value="">Select Size</option>
                <option value="1" @if ($data['products']->size == 1) selected @endif>1Kg</option>
                <option value="2" @if ($data['products']->size == 2) selected @endif>180Ml</option>
                <option value="3" @if ($data['products']->size == 3) selected @endif>375Ml</option>
              </select>
              @error('size')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="brand" class="form-label">Brand</label>
              <select name="brand" id="brand" class="form-control form-inputtext">
                <option value="">Select Brand</option>
                <option value="1" @if ($data['products']->brand == 1) selected @endif>CHELSEA</option>
                <option value="2" @if ($data['products']->brand == 2) selected @endif>CHITRA</option>
                <option value="3" @if ($data['products']->brand == 3) selected @endif>CHITRA</option>
                <option value="4" @if ($data['products']->brand == 4) selected @endif>CHITTARI</option>
                <option value="5" @if ($data['products']->brand == 5) selected @endif>CITRON</option>
                <option value="6" @if ($data['products']->brand == 6) selected @endif>COPER MATEL</option>
              </select>
              @error('brand')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="subcategory" class="form-label">Subcategory</label>
              <select name="subcategory" id="subcategory" class="form-control form-inputtext">
                <option value="">Select Subcategory</option>
                <option value="1" @if ($data['products']->subcategory == 1) selected @endif>BAGS</option>
                <option value="2" @if ($data['products']->subcategory == 2) selected @endif>BALLPEN</option>
                <option value="3" @if ($data['products']->subcategory == 3) selected @endif>BANGLE</option>
                <option value="4" @if ($data['products']->subcategory == 4) selected @endif>BENGALI</option>
                <option value="5" @if ($data['products']->subcategory == 5) selected @endif>BODYKIT</option>
                <option value="6" @if ($data['products']->subcategory == 6) selected @endif>BOTTOMS</option>
              </select>
              @error('subcategory')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="color" class="form-label">Color</label>
              <select name="color" id="color" class="form-control form-inputtext">
                <option value="">Select Color</option>
                <option value="1" @if ($data['products']->color == 1) selected @endif>Blue</option>
                <option value="2" @if ($data['products']->color == 2) selected @endif>Blue Melange</option>
                <option value="3" @if ($data['products']->color == 3) selected @endif>Brown</option>
                <option value="4" @if ($data['products']->color == 4) selected @endif>Cola</option>
                <option value="5" @if ($data['products']->color == 5) selected @endif>Dark Blue</option>
              </select>
              @error('color')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="material" class="form-label">Material</label>
              <select name="material" id="material" class="form-control form-inputtext">
                <option value="">Select Material</option>
                <option value="1" @if ($data['products']->material == 1) selected @endif>BRASS</option>
                <option value="2" @if ($data['products']->material == 2) selected @endif>COTTON</option>
                <option value="3" @if ($data['products']->material == 3) selected @endif>Cotton</option>
                <option value="4" @if ($data['products']->material == 4) selected @endif>DIAMOND</option>
                <option value="5" @if ($data['products']->material == 5) selected @endif>DOBBY</option>
                <option value="6" @if ($data['products']->material == 6) selected @endif>FABRIC</option>
                <option value="7" @if ($data['products']->material == 7) selected @endif>Fiber</option>
                <option value="8" @if ($data['products']->material == 8) selected @endif>Grocery</option>
                <option value="9" @if ($data['products']->material == 9) selected @endif>KATHIA</option>
              </select>
              @error('material')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="vendor_code" class="form-label">Vendor code</label>
              <select name="vendor_code" id="vendor_code" class="form-control form-inputtext">
                <option value="">Select Vendor code</option>
                <option value="2531" @if ($data['products']->vendor_code == 2531) selected @endif>2531</option>
                <option value="2609" @if ($data['products']->vendor_code == 2609) selected @endif>2609</option>
                <option value="2446" @if ($data['products']->vendor_code == 2446) selected @endif>2446</option>
                <option value="2553" @if ($data['products']->vendor_code == 2553) selected @endif>2553</option>
                <option value="2528" @if ($data['products']->vendor_code == 2528) selected @endif>2528</option>
                <option value="2569" @if ($data['products']->vendor_code == 2569) selected @endif>2569</option>
                <option value="2449" @if ($data['products']->vendor_code == 2449) selected @endif>2449</option>
                <option value="2501" @if ($data['products']->vendor_code == 2501) selected @endif>2501</option>
              </select>
              @error('vendor_code')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="abcdefg" class="form-label">Abcdefg</label>
              <select name="abcdefg" id="abcdefg" class="form-control form-inputtext">
                <option value="">Select Abcdefg</option>
              </select>
              @error('abcdefg')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="service" class="form-label">Service</label>
              <select name="service" id="service" class="form-control form-inputtext">
                <option value="">Select Service</option>
              </select>
              @error('service')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="supplier_barcode" class="form-label">Supplier Barcode</label>
              <input type="text" class="form-control admin-input" id="supplier_barcode" name="supplier_barcode" value="{{ old('supplier_barcode', $data['products']->supplier_barcode) }}"  autocomplete="off">
              @error('supplier_barcode')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row">
          <x-alert />
          <div class="row">
            <div class="col-12">
              <button class="commonBtn-btnTag" type="submit">Submit </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts') 
<script src="{{ url('assets/admin/js/product.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
@endsection 