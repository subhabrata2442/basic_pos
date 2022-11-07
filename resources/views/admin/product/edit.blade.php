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
                
                
                @if(count($data['measurement'])>0)
                @foreach($data['measurement'] as $row)
                
                
                <option value="{{$row->id}}" @if ($data['products']->uqc_id == $row->id) selected @endif>{{$row->name}}</option>
                
                
                @endforeach
                @endif
                
              
              
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
                      <input type="hidden" name="image" value="{{ $data['products']->image ?? ''}}" id="input-image">
                      <input name="upload_photo" id="upload_photo" style="display:none" onchange="preview_image(this.files)" type="file">
                    </div></td>
                  <td><input type="text" id="product_image_caption" name="product_image_caption" class="form-control admin-input" value="{{$data['products']->image_caption ?? ''}}"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row">
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="category" class="form-label">Category</label>
              <select name="category" id="category" class="form-control form-inputtext">
                <option value="">Select Category</option>
                
                
                @if(count($data['category_list'])>0)
                @foreach($data['category_list'] as $cRow)
                
                
                <option value="{{$cRow->id}}" @if ($data['products']->category_id == $cRow->id) selected @endif>{{$cRow->name}}</option>
                
                
                @endforeach
                @endif
                
              
              
              </select>
              @error('category')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="category" data-title="Category"><i class="fas fa-plus"></i></a></div>
          </div>
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="category" class="form-label">Size</label>
              <select name="size" id="size" class="form-control form-inputtext">
                <option value="">Select Size</option>
                
                
                @if(count($data['size'])>0)
                @foreach($data['size'] as $sRow)
                
                
                <option value="{{$sRow->id}}" @if ($data['products']->size_id == $sRow->id) selected @endif>{{$sRow->name}}</option>
                
                
                @endforeach
                @endif
                
              
              
              </select>
              @error('size')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="size" data-title="Size"><i class="fas fa-plus"></i></a></div>
          </div>
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="brand" class="form-label">Brand</label>
              <select name="brand" id="brand" class="form-control form-inputtext">
                <option value="">Select Brand</option>
                
                
                @if(count($data['brand'])>0)
                @foreach($data['brand'] as $bRow)
                
                
                <option value="{{$bRow->id}}" @if ($data['products']->brand_id == $bRow->id) selected @endif >{{$bRow->name}}</option>
                
                
                @endforeach
                @endif
                
              
              
              </select>
              @error('brand')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="brand" data-title="Brand"><i class="fas fa-plus"></i></a></div>
          </div>
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="subcategory" class="form-label">Subcategory</label>
              <select name="subcategory" id="subcategory" class="form-control form-inputtext">
                <option value="">Select Subcategory</option>
                
                
                @if(count($data['subcategory'])>0)
                @foreach($data['subcategory'] as $row)
                
                
                <option value="{{$row->id}}" @if ($data['products']->subcategory_id == $row->id) selected @endif>{{$row->name}}</option>
                
                
                @endforeach
                @endif
                
              
              
              </select>
              @error('subcategory')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="subcategory" data-title="Subcategory"><i class="fas fa-plus"></i></a></div>
          </div>
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="color" class="form-label">Color</label>
              <select name="color" id="color" class="form-control form-inputtext">
                <option value="">Select Color</option>
                
                
                @if(count($data['color'])>0)
                @foreach($data['color'] as $row)
                
                
                <option value="{{$row->id}}" @if ($data['products']->color_id == $row->id) selected @endif>{{$row->name}}</option>
                
                
                @endforeach
                @endif
                
              
              
              </select>
              @error('color')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="color" data-title="Color"><i class="fas fa-plus"></i></a></div>
          </div>
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="material" class="form-label">Material</label>
              <select name="material" id="material" class="form-control form-inputtext">
                <option value="">Select Material</option>
                
                
                @if(count($data['material'])>0)
                @foreach($data['material'] as $row)
                
                
                <option value="{{$row->id}}" @if ($data['products']->material_id == $row->id) selected @endif>{{$row->name}}</option>
                
                
                @endforeach
                @endif
                
              
              
              </select>
              @error('material')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="material" data-title="Material"><i class="fas fa-plus"></i></a></div>
          </div>
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="vendor_code" class="form-label">Vendor code</label>
              <select name="vendor_code" id="vendor_code" class="form-control form-inputtext">
                <option value="">Select Vendor code</option>
                
                
                @if(count($data['vendorCode'])>0)
                @foreach($data['vendorCode'] as $row)
                
                
                <option value="{{$row->id}}" @if ($data['products']->vendor_code_id == $row->id) selected @endif>{{$row->name}}</option>
                
                
                @endforeach
                @endif
                
              
              
              </select>
              @error('vendor_code')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="vendor_code" data-title="Vendor code"><i class="fas fa-plus"></i></a></div>
          </div>
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="abcdefg" class="form-label">Abcdefg</label>
              <select name="abcdefg" id="abcdefg" class="form-control form-inputtext">
                <option value="">Select Abcdefg</option>
                
                
                @if(count($data['abcdefg'])>0)
                @foreach($data['abcdefg'] as $row)
                
                
                <option value="{{$row->id}}" @if ($data['products']->abcdefg_id == $row->id) selected @endif>{{$row->name}}</option>
                
                
                @endforeach
                @endif
              
              
              </select>
              @error('abcdefg')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="abcdefg" data-title="Abcdefg"><i class="fas fa-plus"></i></a></div>
          </div>
          <div class="col-md-4 plusBoxWrap relative">
            <div class="form-group">
              <label for="service" class="form-label">Service</label>
              <select name="service" id="service" class="form-control form-inputtext">
                <option value="">Select Service</option>
                
                
                @if(count($data['service'])>0)
                @foreach($data['service'] as $row)
                
                
                <option value="{{$row->id}}" @if ($data['products']->service_id == $row->id) selected @endif>{{$row->name}}</option>
                
                
                @endforeach
                @endif
              
              
              </select>
              @error('service')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
            <div class="plusBox"><a href="javascript:;" class="plusBoxBtn addmoreoption" data-type="service" data-title="Service"><i class="fas fa-plus"></i></a></div>
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
            <div class="col-12">
              <button class="commonBtn-btnTag" type="submit">Submit </button>
            </div>
          </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="addproducts_features">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title dnamic_feature_title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="container"></div>
      <form id="productfeaturesform">
        <input type="hidden" id="product_features_type" autocomplete="off">
        <div class="modal-body">
          <div class="input-group input-group-default floating-label">
            <label class="form-label dnamic_feature_name"> </label>
            <input class="form-control form-inputtext" autocomplete="off" name="product_feature_data_value" id="product_feature_data_value" maxlength="100" type="text" placeholder=" ">
          </div>
          <span id="sizeerr" style="color: red;font-size: 15px"></span> </div>
        <div class="modal-footer"><a href="javascript:;" data-dismiss="modal" class="btn">Close</a>
          <button type="button" id="productfeaturessave" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts') 
<script src="{{ url('assets/admin/js/product.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
@endsection 