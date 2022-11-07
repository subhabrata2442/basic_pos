$(document).ready(function() {
    $("#product_search").keyup(function() {
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
                        var name = response.result[i]['product_barcode']+'-'+response.result[i]['product_name'];
                        $("#product_search_result").append("<li value='" + id + "'>" + name + "</li>");
                    }
                    // binding click event to li
                    $("#product_search_result li").bind("click", function() {
                        $('.loader_section').show();
						setRow(this);
                    });
                }
            });
        }
    });
});



function remove(row) {
    $("#product_record_sec").find("tr[data-id='" + row + "']").remove();
    var total_qty = $("#product_record_sec tr").length;
    $(".total_qty").html(total_qty);
   // totalcalculation();
}

//allow only integer and one point in td editable
function check_character(event) {
	if ((event.which != 46 || $(event.target).text().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
}

// Set Text to search box and get details
function setRow(element){
	var value = $(element).text();
    var product_id = $(element).val();
	
    $("#product_search").val('');
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
				if(item_detail.default_qty !='' && item_detail.default_qty !=null){
					default_qty= item_detail.default_qty; 
				}
				
				if (item_detail.cost_rate != null || item_detail.cost_rate != undefined) {
					total_cost_rate = ((Number(cost_rate)) * (Number(default_qty)));
				}
				
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
					html += '<tr id="product_' + product_id + '" data-id="' + item_row + '">' +
                        '<input type="hidden" name="item_scan_time_' + product_id + '" id="item_scan_time_' + product_id + '" value="' + scan_time + '">' +
                        '<input type="hidden" name="inward_item_detail_id_' + product_id + '" id="inward_item_detail_id_' + product_id + '" value="">' +
                        '<input type="hidden" name="stock_transfers_detail_id_' + product_id + '" id="stock_transfers_detail_id_' + product_id + '" value="">' +
                        '<td><a href="javascript:;" onclick="remove(' + item_row + ');"><i class="fas fa-times"></i></a></td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg p_product_qty" contenteditable="true" id="product_qty_' + product_id + '">' + default_qty + '</td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg p_free_qty" contenteditable="true" style="color: black;" id="free_qty_' + product_id + '">0</td>' +
                        '<td>' + barcode + '</td>' +
                        '<td><a id="inwardproduct_popup_' + product_id + '" onclick="return inwardproductdetail_popup(this);"><span class="informative">' + item_detail.product_name + '</span></a></td>' +
                        '<td>' + product_code + '</td>';
					
					html += '<td greenBg contenteditable="true" id="batch_no_' + product_id + '"></td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg p_base_price" contenteditable="true" id="base_price_' + product_id + '">' + cost_rate + '</td>' +
						
                        '<td  onkeypress = "return check_character(event);" class="number greenBg p_discount_percent" contenteditable="true" style="color: black;" id="base_discount_percent_' + product_id + '">0</td>' +
                        '<td  class="" id="base_discount_amount_' + product_id + '">0</td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg  p_scheme_percent" contenteditable="true" id="scheme_discount_percent_' + product_id + '">0</td>' +
                        '<td  class=" " id="scheme_discount_amount_' + product_id + '">0</td>' + 
						'<td class="" readonly  id="free_discount_percent_' + product_id + '">' + item_detail.free_discount_percent + '</td>' +
						'<td class=""  readonly id="free_discount_amount_' + product_id + '">' + Number(item_detail.free_discount_amount).toFixed(4) + '</td>' +
                        '<td class=""  readonly  id="cost_rate_' + product_id + '">' + cost_rate + '</td>' +
						'<td class="" id="total_cost_rate_' + product_id + '" style="display: none;">' + total_cost_rate + '</td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg p_cost_gst_percent" contenteditable="true" id="gst_percent_' + product_id + '">' + cost_gst_percent + '</td>' +
                        '<td class="" readonly id="gst_amount_' + product_id + '">' + cost_gst_amount + '</td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg p_extra_charge" contenteditable="true" id="extra_charge_' + product_id + '">' + extra_charge + '</td>' +
                        '<td class=""  readonly id="profit_percent_' + product_id + '">' + profit_percent + '</td>' +
                        '<td class="" readonly id="profit_amount_' + product_id + '">' + profit_amount + '</td>' +
                        '<td class=" blue_td_border" readonly id="sell_price_' + product_id + '">' + selling_price + '</td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg p_selling_gst_percent" contenteditable="true" id="selling_gst_percent_' + product_id + '">' + sell_gst_percent + '</td>' +
                        '<td class="" id="selling_gst_amount_' + product_id + '">' + sell_gst_amount + '</td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg p_offer_price" contenteditable="true" id="offer_price_' + product_id + '">' + offer_price + '</td>' +
                        '<td onkeypress = "return check_character(event);" class="number greenBg " contenteditable="true" style="color: black;" id="product_mrp_' + product_id + '">' + product_mrp + '</td>' +
                        '<td class="number greenBg" style="display: none" id="wholesale_price_' + product_id + '">' + wholesale_price + '</td>' +
                        '<td contenteditable="true" class="greenBg " style="color: black;"  onclick="return getdatepicker(\'mfg_date_' + product_id + '\',' + same_item + ');" id="mfg_date_' + product_id + '" ></td>' + '<td contenteditable="true" class="greenBg " style="color: black;" onclick="return getdatepicker(\'expiry_date_' + product_id + '\',' + same_item + ');" id="expiry_date_' + product_id + '"></td>' +
                        '<td class="" readonly id="total_cost_' + product_id + '">' + item_detail.cost_price + '</td>' +
                        '</tr>';	
						
						
					}
				$("#product_record_sec").prepend(html);
				$('.loader_section').hide();
				final_calculation();
				
			}
			
			
			
        }

    });
}