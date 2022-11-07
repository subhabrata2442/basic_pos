$(document).ready(function() {
    $("#search_product").keyup(function() {
        var search = $(this).val();
        if (search != "") {
            $.ajax({
                url: prop.ajaxurl,
                type: 'post',
                data: {
                    search: search,
                    action: 'get_product',
                    _token: prop.csrf_token
                },
                dataType: 'json',
                success: function(response) {
                    var len = response.result.length;

                    $("#product_search_result").empty();
                    for (var i = 0; i < len; i++) {
                        var id = response.result[i]['id'];
                        var name = response.result[i]['product_barcode'] + '-' + response.result[i]['product_name'];
                        $("#product_search_result").append("<li value='" + id + "'>" + name + "</li>");
                    }
                    // binding click event to li
                    $("#product_search_result li").bind("click", function() {
                        $('.loader_section').show();
                        setProductRow(this);
                    });
                }
            });
        }
    });
});

// Set Text to search box and get details
function setProductRow(element){
	var value = $(element).text();
    var product_id = $(element).val();
	
    $("#search_product").val('');
    $("#product_search_result").empty();
	
    // Request User Details
    $.ajax({
        url: prop.ajaxurl,
        type: 'post',
		data: {
			product_id: product_id,
			action: 'get_product_byId',
			_token: prop.csrf_token
               },
		dataType: 'json',
        success: function(response){
			if(response.status=='1'){
				var html = '';
				var scan_time = moment().format("DD-MM-YYYY h:mm:ss a");
				var item_detail = response.result;
				
				//alert(JSON.stringify(item_detail));
				
				var item_code 			= '';
				var barcode				= '';
				var cost_gst_percent 	= '0';
				var profit_percent 		= '0';
				var profit_amount 		= '0';
				var selling_price 		= '0';
				var sell_gst_percent	= '0';
				var item_mrp 			= '0';
				var cost_rate 			= '0';
				var total_cost_rate 	= '0';
				var offer_price 		= '0';
				var sell_gst_amount 	= '0';
				var cost_gst_amount 	= '0';
				var extra_charge 		= '0';
				
				if (item_detail.product_code != null || item_detail.product_code != undefined) {
					product_code = item_detail.product_code;
				}
				if (item_detail.product_barcode != null || item_detail.product_barcode != undefined) {
					barcode = item_detail.product_barcode;
				}
				if (item_detail.cost_rate != null || item_detail.cost_rate != undefined) {
					cost_rate = item_detail.cost_rate.toFixed(decimalpoints);
				}
				if (item_detail.cost_gst_percent != null || item_detail.cost_gst_percent != undefined) {
					cost_gst_percent = item_detail.cost_gst_percent.toFixed(decimalpoints);
				}
				if (item_detail.extra_charge != null || item_detail.extra_charge != undefined) {
					extra_charge = item_detail.extra_charge.toFixed(decimalpoints);
				}
				if (item_detail.profit_percent != null || item_detail.profit_percent != undefined) {
					profit_percent = item_detail.profit_percent.toFixed(decimalpoints);
				}
				if (item_detail.profit_amount != null || item_detail.profit_amount != undefined) {
					profit_amount = item_detail.profit_amount.toFixed(decimalpoints);
				}
				if (item_detail.selling_price != null || item_detail.selling_price != undefined) {
					selling_price = item_detail.selling_price.toFixed(decimalpoints);
				}
				if (item_detail.sell_gst_percent != null || item_detail.sell_gst_percent != undefined) {
					sell_gst_percent = item_detail.sell_gst_percent.toFixed(decimalpoints);
				}
				if (item_detail.product_mrp != null || item_detail.product_mrp != undefined) {
					product_mrp = item_detail.product_mrp.toFixed(decimalpoints);
				}
				if (item_detail.offer_price != null || item_detail.offer_price != undefined) {
					offer_price = item_detail.offer_price.toFixed(decimalpoints);
				}
				if (item_detail.sell_gst_amount != null || item_detail.sell_gst_amount != undefined) {
					sell_gst_amount = item_detail.sell_gst_amount.toFixed(decimalpoints);
				}
				if (item_detail.cost_gst_amount != null || item_detail.cost_gst_amount != undefined) {
					cost_gst_amount = item_detail.cost_gst_amount.toFixed(decimalpoints);
				}
				
				var wholesale_price = item_detail.wholesale_price; 
				
				var default_qty= 1;
				
				
				var item_row = 0;
				if($('#product_record_sec tr').length == 0){
					item_row++;
				}
				else{
					var max = 0;
					$("#product_record_sec tr").each(function() {
						var value = parseInt($(this).data('id'));
						max = (value > max) ? value : max;
					});
					item_row = max + 1;
				}
				
				var product_id = item_detail.id;
				var row = 0;
				var same_item=0;
				
				$("#product_record_sec tr").each(function () {
					var row_product_id = $(this).attr('id').split('_')[1];
					if (row_product_id == product_id) {
						same_item=1;
						toastr.error("This product already added");
						//alert('same item');
					}
				});
				if (same_item == 0) {
					var pricehtml='<option value="47">875</option>';
					html += '<tr id="product_' + product_id + '" data-id="' + item_row + '">' +
						'<td>' + barcode + '</td>' +
						'<td><a href="javascript:;"><span class="informative">' + item_detail.product_name + '</span></a></td>' +
						'<td>' + default_qty + '</td>' +
						'<td id="selling_mrp_'+product_id+'">'+
                            '<select name="product_mrp_id[]" id="product_mrp_id_'+product_id+'" class="input-3">'+
                                pricehtml+
                            '</select>'+
                            '<input type="hidden" id="product_mrp_'+product_id+'" name="product_mrp[]"  value="" >'+
                          '</td>' +
						'<td id="product_selling_qty_'+product_id+'">'+
                          '<input type="text" id="qty_'+product_id+'" class="input-3" value="1" name="qty[]">'+
                          '</td>'+
						'<td id="product_selling_discount_per_'+product_id+'">'+
                          '<input type="text" id="discount_per_'+product_id+'" class="input-3" value="0" name="discount_per[]">'+
                          '</td>'+
						'<td id="product_selling_discount_'+product_id+'">'+
                          '<input type="text" id="discount_'+product_id+'" class="input-3" value="0" name="discount[]">'+
                          '</td>'+
						'<td>' + wholesale_price + '</td>' +
						'<td>' + cost_gst_amount + '</td>' + 
                        '</tr>';
					}
				$("#sale_product_record_sec").prepend(html);
				//$('.loader_section').hide();
				//final_calculation();
				
			}
			
			
			
        }

    });
}