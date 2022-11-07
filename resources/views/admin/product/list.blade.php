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
      
      
      <!--<form method="post" action="{{ route('admin.product.bar_product_price_upload') }}" class="needs-validation" id="bar_product_price_upload-form" novalidate enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
          <div class="form-group">
            <div class="upload-btn file-upload">
              <label for="product_upload" class="custom-file-upload fileInfo file-drop">Upload Bar Product </label>
              <input id="bar_product_upload_file" type="file" name="product_upload_file">
            </div>
          </div>
        </div>
      </form>-->
      
      <form method="post" action="{{ route('admin.product.product_stock_upload') }}" class="needs-validation" id="product_stock_upload-form" novalidate enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
          <div class="form-group">
            <div class="upload-btn file-upload">
              <label for="product_stock_upload_file" class="custom-file-upload fileInfo file-drop">Upload Stock Product </label>
              <input id="product_stock_upload_file" type="file" name="product_upload_file">
            </div>
          </div>
        </div>
      </form>
      
      
      
      
      
      
      <div class="table-responsive dataTable-design">
        <table id="product_list" class="table table-bordered">
          <thead>
            <th>Product Name</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Size</th>
            <th>Stock QTY</th>
            <th>MRP</th>
            <th>Strength</th>
            <th>Retailer margin</th>
            <th>Round Off</th>
            <th>Special Purpose Fee</th>
            
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

$(document).on('change','#bar_product_upload_file',function(){
	this.form.submit();
});

$(document).on('change','#product_stock_upload_file',function(){
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
				data: 'product_name',
				name: 'product_name'
			},	
			{
				data: 'category',
				name: 'category'
			},
			{
				data: 'subcategory',
				name: 'subcategory',
			},
			{
				data: 'size',
				name: 'size'
			},
			{
				data: 'qty',
				name: 'qty'
			},
			{
				data: 'mrp',
				name: 'mrp'
			},
			{
				data: 'strength',
				name: 'strength'
			},	
			{
				data: 'retailer_margin',
				name: 'retailer_margin'
			},
			{
				data: 'round_off',
				name: 'round_off',
			},
			{
				data: 'special_purpose_fee',
				name: 'special_purpose_fee'
			}
		]
	});

});
</script> 
@endsection 