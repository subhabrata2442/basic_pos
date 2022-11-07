@extends('layouts.admin')
@section('admin-content')
<style>
	.content-header{
		display: none !important;
	}
	.custom-table table tbody tr:nth-child(odd){
		background: #f5f5f5;
	}
	.custom-table table tbody tr:nth-child(even){
		background: #f5e9e3;
	}
	.auto_search_result {
		list-style: none;
		padding: 0px;
		width: 100%;
		position: absolute;
		margin: 0;
		max-height: 300px;
		overflow-y: auto;
		z-index: 99999;
		top: 100%;
		background: #cfcff0;
	}
	.auto_search_result li {
		background: lavender;
		padding: 7px 15px;
		margin-bottom: 1px;
		font-size: 13px;
	}
	.auto_search_result li:hover {
		cursor: pointer;
		background: cadetblue;
		color: white;
	}
	.reset-btn{
		background-color: #d3681b;
	}
	.swal2-title {
   
    font-size: 1.3em;

}
</style>
<div class="srcBtnWrap">
  <div class="card">
    <div class="row align-items-center justify-content-between">
      <div class="col-auto">
        <h4>Stock Transfer</h4>
      </div>
      <div class="col-auto"> <a href="javascript:;" class="searchDropBtn">Advance Search <i class="fas fa-chevron-circle-down"></i></a> </div>
    </div>
  </div>
</div>
<div class="card toggleCard">
  <form action="" method="get" id="filter">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
          <label for="customer_last_name" class="form-label">By Product Name</label>
          <div class="position-relative">
            <input type="text" class="form-control" id="search_product" name="product" value="{{request()->input('product')}}" autocomplete="off">
            <ul id="search_product_list" class="auto_search_result">
            </ul>
          </div>
          <input type="hidden" name="product_id" id="product_id" value="{{request()->input('product_id')}}">
        </div>
      </div>
      <div class="col-12">
        <ul class="saveSrcArea d-flex align-items-center justify-content-center mb-2">
          <li> <a href="javascript:?" class="saveBtn-2 reset-btn" id="reset">Reset</i></a> </li>
          <li>
            <button class="saveBtn-2" type="submit">Search <i class="fas fa-arrow-circle-right"></i></button>
          </li>
        </ul>
      </div>
    </div>
  </form>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <form method="post" action="{{ route('admin.purchase.product_stock_upload') }}" class="needs-validation" id="product_stock_upload-form" novalidate enctype="multipart/form-data">
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
      <div class="table-responsive custom-table">
        <table id="" class="table table-bordered text-nowrap">
          <thead>
            <th scope="col">Barcode</th>
            <th scope="col">Product Name</th>
            <th scope="col">Category</th>
            <th scope="col">Subcategory</th>
            <th scope="col">Size</th>
            <th scope="col">Opening Stock</th>
              </thead>
          <tbody>
          
          @forelse ($data['stock_product'] as $product_stock)
          <tr>
           <td>{{$product_stock->product_barcode}}</td>
            <td>{{$product_stock->product->product_name}}</td>
            <td>{{$product_stock->product->category->name}}</td>
            <td>{{$product_stock->product->subcategory->name}}</td>
            <td>{{$product_stock->size->name}}</td>
            <td>{{$product_stock->product_qty}}</td>
          </tr>
          @empty
          <tr >
            <td colspan="5"> No data found </td>
          </tr>
          @endforelse
            </tbody>
          
        </table>
        {{ $data['stock_product']->appends($_GET)->links() }} </div>
    </div>
  </div>
</div>
@endsection

@section('scripts') 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
@if( Request::has('product')) 
<script>
	$(".toggleCard").css("display", "block");
	</script> 
@endif 
<script type="text/javascript">

$(document).on('change','#product_stock_upload_file',function(){
	this.form.submit();
});


$(function() {
	//End Date range picker
	$('.searchDropBtn').on("click",function(){
		$(".toggleCard").slideToggle();
	})

	//Product List
	$("#search_product").keyup(function() {
		var search = $(this).val();
		if (search != "") {
            $.ajax({
                url: '{{route('admin.ajax.sale-product')}}',
                type: 'get',
                data: {
                    search: search,
                    _token: prop.csrf_token
                },
                dataType: 'json',
                success: function(response) {
                    var len = response.result.length;
                    $("#search_product_list").empty();
                    for (var i = 0; i < len; i++) {
                        var id = response.result[i]['id'];
                        var name = response.result[i]['product_name']+ ' ' + response.result[i]['product_barcode'];
                        $("#search_product_list").append("<li value='" + id + "'>" + name + "</li>");
                    }
                    // binding click event to li
                    $("#search_product_list li").bind("click", function() {
                        $('.loader_section').show();
						var cname = $(this).text();
						console.log(cname);
    					var cid = $(this).val();
						$('#search_product').val(cname);
						$('#product_id').val(cid);
						$("#search_product_list").empty();
                    });
                }
            });
        }
	});
	//reset form
	$("#reset").click(function() {
		$('#filter').trigger("reset");
		window.location = window.location.href.split("?")[0];
	});
});

</script> 
@endsection 