@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
       <form method="post" action="{{ route('admin.product.product_upload') }}" class="needs-validation" id="product_upload-form" novalidate enctype="multipart/form-data">
      @csrf
      <div class="col-md-6">
        <div class="form-group">
          <div class="upload-btn file-upload">
            <label for="product_upload" class="custom-file-upload fileInfo file-drop">Upload </label>
            <input id="product_upload_file" type="file" name="product_upload_file">
          </div>
        </div>
      </div>
      </form>
      <div class="table-responsive dataTable-design">
        <table id="product_list" class="table table-bordered">
          <thead>
          <th>Action</th>
            <th>Image</th>
            <th>System Barcode</th>
            <th>Product Name</th>
            <!--<th>Supplier Barcode</th>-->
            <th>Category</th>
            <th>Size</th>
            <th>Brand</th>
            <th>Subcategory</th>
            <!--<th>Color</th>
            <th>Material</th>
            <th>Vendor code</th>
            <th>Abcdefg</th>
            <th>Service</th>
            <th>UQC</th>-->
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
<script type="text/javascript">



$(document).on('change','#product_upload_file',function(){
	this.form.submit();
});

$(function() {

	var table = $('#product_list').DataTable({
		processing: true,
		serverSide: true,
		searchDelay: 350,
		ajax: "{{ route('admin.product.list') }}",
		columns: [
			{
				data: 'action',
				name: 'action',
				orderable: false,
				searchable: false
			},
		
			{
				data: 'image',
				name: 'image',
			},
			{
				data: 'product_barcode',
				name: 'product_barcode'
			},
			{
				data: 'product_name',
				name: 'product_name'
			},
			/*{
				data: 'supplier_barcode',
				name: 'supplier_barcode',
			},*/
			{
				data: 'category',
				name: 'category'
			},
			{
				data: 'size',
				name: 'size'
			},
			{
				data: 'brand',
				name: 'brand'
			},
			{
				data: 'subcategory',
				name: 'subcategory',
			},
			/*{
				data: 'color',
				name: 'color'
			},
			{
				data: 'material',
				name: 'material'
			},
			{
				data: 'vendor_code',
				name: 'vendor_code',
			},
			{
				data: 'abcdefg',
				name: 'abcdefg'
			},
			{
				data: 'service',
				name: 'service'
			},
			{
				data: 'uqc_id',
				name: 'uqc_id'
			},*/
			{
				data: 'cost_rate',
				name: 'cost_rate',
			},
			{
				data: 'cost_gst_percent',
				name: 'cost_gst_percent'
			},
			{
				data: 'extra_charge',
				name: 'extra_charge'
			},
			{
				data: 'profit_percent',
				name: 'profit_percent',
			},
			{
				data: 'profit_amount',
				name: 'profit_amount'
			},
			{
				data: 'selling_price',
				name: 'selling_price'
			},
			{
				data: 'sell_gst_percent',
				name: 'sell_gst_percent'
			},
			{
				data: 'sell_gst_amount',
				name: 'sell_gst_amount',
			},
			{
				data: 'product_mrp',
				name: 'product_mrp'
			},
			{
				data: 'offer_price',
				name: 'offer_price'
			},
			{
				data: 'wholesale_price',
				name: 'wholesale_price',
			},
			{
				data: 'sku_code',
				name: 'sku_code'
			},
			{
				data: 'product_code',
				name: 'product_code'
			},
			{
				data: 'hsn_sac_code',
				name: 'hsn_sac_code'
			},
			{
				data: 'days_before_product_expiry',
				name: 'days_before_product_expiry'
			},
			{
				data: 'offer_price',
				name: 'offer_price'
			},
			{
				data: 'alert_product_qty',
				name: 'alert_product_qty',
			},
			
		]
	});

});
</script> 
@endsection 