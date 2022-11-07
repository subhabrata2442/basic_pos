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
          <li> <a href="{{ route('admin.purchase.stock.warehouse_stock_report') }}" target="_blank" class="saveBtn-2" id="download_report"><i class="fas fa-download"></i> Download Report</i></a> </li>
        </ul>
      </div>
    </div>
  </form>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="table-responsive custom-table">
        <table id="" class="table table-bordered text-nowrap">
          <thead>
          <th scope="col">Product Name</th>
            <th scope="col">Category</th>
            <th scope="col">Subcategory</th>
            <th scope="col">Size</th>
            <th scope="col">Price</th>
            <th scope="col">Warehouse qty</th>
            <th scope="col">Counter qty</th>
            <th scope="col">Action</th>
              </thead>
          <tbody>
          
          @forelse ($data['stock_product'] as $product_stock)
          <tr>
            <td>{{@$product_stock->product->product_name}}</td>
            <td>{{@$product_stock->product->category->name}}</td>
            <td>{{@$product_stock->product->subcategory->name}}</td>
            <td>{{@$product_stock->size->name}}</td>
            <td>₹ {{ $product_stock->stockProduct->selling_price }}</td>
            <td>{{@$product_stock->stockProduct->w_qty}}</td>
            <td>{{@$product_stock->stockProduct->c_qty}}</td>
            <td><a href="javascript:;" class="exchange_btn" data-stock_id="{{@$product_stock->id}}" data-price_id="{{@$product_stock->stockProduct->id}}" data-w_qty="{{@$product_stock->stockProduct->w_qty}}" data-c_qty="{{@$product_stock->stockProduct->c_qty}}"><i class="fas fa-exchange-alt"></i></a></td>
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
<div class="modal fade modalMdHeader" id="modal-applyExchange" tabindex="-1" aria-labelledby="modal-1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-1Label">Stock Tranfer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="applyCouponBox">
          <form action="{{ route('admin.purchase.stock.transfer') }}" method="post" id="applyExchange-form">
            @csrf
            <input type="hidden" id="original_w_qty" name="prev_w_qty" />
            <input type="hidden" id="original_c_qty" name="prev_c_qty" />
            <input type="hidden" id="stock_id" name="stock_id" />
            <input type="hidden" id="price_id" name="price_id" />
            <input type="hidden" id="transfer_to" name="transfer_to" value="c" />
            <input type="hidden" id="w_qty-input" name="w_qty" />
            <div class="mb-3">
              <label for="" class="form-label">Warehouse Stock:<span id="prev_w_qty_label"></span></label>
            </div>
            @forelse ($data['counter'] as $counter_row)
            <div class="mb-3">
              <label for="" class="form-label">{{$counter_row->name}}</label>
              <input type="number" class="form-control number update_c_qty" name="c_qty[]" autocomplete="off">
              <input type="hidden" name="counter_id[]" value="{{$counter_row->id}}">
            </div>
            @empty
            <div class="mb-3">
              <label for="" class="form-label">Counter</label>
              <input type="number" class="form-control number update_c_qty" name="c_qty[]" autocomplete="off">
            </div>
            @endforelse
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
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


$(document).on('keyup', '.update_c_qty', function() {
    var total_qty = 0;
    var original_w_qty = $('#original_w_qty').val();
	
    var input_c_qty = $(this).val();
    if (Number(input_c_qty) <= 0) {
        $(this).val(0);
        toastr.error("Entered Qty should not be greater than Stock");

        if (Number(input_c_qty) <= 0) {
            var total_qty = 0
            $(".update_c_qty").each(function() {
                var c_qty = $(this).val();
                if (c_qty != '') {
                    total_qty += parseInt(c_qty);
                }
            });
            var new_w_qty = parseInt(original_w_qty) - parseInt(total_qty);
            $('#prev_w_qty_label').text(new_w_qty);
            $('#w_qty-input').val(new_w_qty);
        }
		
        return false;
    }
	
	var total_qty = 0
	$(".update_c_qty").each(function() {
        var c_qty = $(this).val();
        if (c_qty != '') {
            total_qty += parseInt(c_qty);
        }
    });

    var new_w_qty = 0;
    if (original_w_qty > 0) {
        if (original_w_qty < total_qty) {
            toastr.error("Entered Qty should not be greater than Stock");
        } else {
            new_w_qty = parseInt(original_w_qty) - parseInt(total_qty);
        }
    }

    $('#prev_w_qty_label').text(new_w_qty);
    $('#w_qty-input').val(new_w_qty);
});






$(document).on('click','.exchange_btn',function(){
	var w_qty		= $(this).data('w_qty');
	var c_qty		= $(this).data('c_qty');
	var stock_id	= $(this).data('stock_id');
	var price_id	= $(this).data('price_id');
	
	$('#prev_w_qty_label').text(w_qty);
	$('#prev_c_qty_label').text(c_qty);
	
	
	$('#stock_id').val(stock_id);
	$('#price_id').val(price_id);
	
	
	$('#original_w_qty').val(w_qty);
	$('#original_c_qty').val(c_qty);
	$('#w_qty-input').val(w_qty);
	//$('#c_qty-input').val(c_qty);
	
	var total_qty=0;
	total_qty += parseInt(w_qty);
	total_qty += parseInt(c_qty);
	
	 
	$('.update_c_qty').val('');
	
	if(total_qty>0){
		$('#modal-applyExchange').modal('show');
	}else{
		toastr.error("Don't have enough stock to transfer");
	}
	
});

$(document).ready(function() {
    $("#applyExchange-form").validate({
        rules: {},
        messages: {},
        errorElement: "em",
        errorPlacement: function(error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
        submitHandler: function(form) {

            var original_w_qty = $('#original_w_qty').val();
            var original_c_qty = $('#original_c_qty').val();

            var total_qty = 0;

            $(".update_c_qty").each(function() {
                var c_qty = $(this).val();
                if (c_qty != '') {
                    total_qty += parseInt(c_qty);
                }
            });

            if (total_qty > 0) {
                if (original_w_qty < total_qty) {
                    toastr.error("Entered Qty should not be greater than Stock");
                } else {
                    var title = 'Do you want to  Transfer ' + total_qty + ' Qty  From Warehouse?';
                    Swal.fire({
                        title: title,
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Save',
                        denyButtonText: 'Don\'t save',
                    }).then((result) => {

                        if (result.isConfirmed) {
                            var action_url = document.getElementById("applyExchange-form").action;
                            $.ajax({
                                url: action_url,
                                type: 'post',
                                data: $(form).serializeArray(),
                                dataType: 'json',
                                success: function(response) {
                                    $('#modal-applyExchange').modal('hide');
                                    Swal.fire({
                                        title: 'Stock Tranfer successfully submitted.',
                                        icon: 'success',
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        allowOutsideClick: false
                                    }).then((result) => {

                                        if (result.isConfirmed) {

                                            location.reload();

                                        } else if (result.isDenied) {}
                                    });
                                }
                            });
                        } else if (result.isDenied) {
                            Swal.fire('Changes are not saved', '', 'info')
                        }
                    });
                }
            } else {
                toastr.error("Enter Stock!");
            }
        }
    });
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