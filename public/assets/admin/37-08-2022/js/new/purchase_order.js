$(document).ready(function() {
    $('#invoice_upload-form').submit(function(evt) {
        evt.preventDefault();
        var formData 	= new FormData(this);
        $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
				dataType: "json",
                beforeSend: function() {
					//$('.loader-bg').fadeIn();
                },
                complete: function() {
					//$('.loader-bg').fadeOut();
					//$('#invoice_upload-form')[0].reset();
                },
                success: function(json) {
					if (json.success == 1) {
						var html = '';
						var scan_time = moment().format("DD-MM-YYYY h:mm:ss a");
						
						var tp_no = json.tp_no;	
						$('#tp_no').val(tp_no);
						
						var invoice_date = json.invoice_date;
						$('#purchase_date').val(invoice_date);
						
						if(json.new_result.length>0){
							$('#newProductItemsModal').modal('show');
						}
						
						var new_html='';
						for (var i = 0; i < json.new_result.length; i++) {
							var new_item_detail = json.new_result[i];
							var item_row_id = i;
							
							new_html += '<tr id="new_product_' + item_row_id + '" data-id="' + item_row_id + '" class="new_product">' +
								'<td class="greenBg" contenteditable="true"  id="new_product_barcode_'+item_row_id+'"></td>'+
								'<td id="new_product_bottle_case_'+item_row_id+'">'+new_item_detail.total_cases+'</td>'+
								'<td id="p_new_product_in_case_'+item_row_id+'">'+new_item_detail.in_cases+'</td>'+
								'<td id="p_new_product_qty_'+item_row_id+'">'+new_item_detail.qty+'</td>'+
								'<td id="new_product_category_'+item_row_id+'">'+new_item_detail.category+'</td>'+
								'<td id="new_product_sub_category_'+item_row_id+'">'+new_item_detail.sub_category+'</td>'+
								'<td id="new_brand_name_'+item_row_id+'">'+new_item_detail.brand_name+'</td>'+
								'<td id="new_batch_no_'+item_row_id+'">'+new_item_detail.batch_no+'</td>'+
								'<td id="new_measure_'+item_row_id+'">'+new_item_detail.measure+'</td>'+
								'<td class="number greenBg" contenteditable="true" id="new_strength_'+item_row_id+'"></td>'+
								'<td id="new_bl_'+item_row_id+'">'+new_item_detail.bl+'</td>'+
								'<td id="new_lpl_'+item_row_id+'">'+new_item_detail.lpl+'</td>'+
								'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="new_retailer_margin_'+item_row_id+'"></td>'+
								'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="new_round_off_'+item_row_id+'"></td>'+
								'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="new_sp_fee_'+item_row_id+'"></td>'+
								'<td id="new_product_mrp_'+item_row_id+'">'+new_item_detail.product_mrp+'</td>'+
								'<td id="new_product_total_cost_'+item_row_id+'">'+new_item_detail.total_cost+'</td>'+
								'</tr>';
							}		
						$("#new_product_record_sec").html(new_html);
						
						for (var i = 0; i < json.result.length; i++) {
							var item_detail = json.result[i];
							
							var product_barcode		= item_detail.product_barcode;
							var item_category 		= item_detail.category;
							var item_sub_category 	= item_detail.sub_category;
							var item_brand_name 	= item_detail.brand_name;
							var item_bl 			= item_detail.bl;
							var item_lpl 			= item_detail.lpl;
							var item_measure 		= item_detail.measure;
							var item_qty 			= item_detail.qty;
							var total_cost 			= item_detail.total_cost;
							var item_batch_no 		= item_detail.batch_no;
							
							var strength 			= item_detail.strength;
							var retailer_margin 	= item_detail.retailer_margin;
							var round_off 			= item_detail.round_off;
							var sp_fee 				= item_detail.sp_fee;
							var product_mrp 		= item_detail.product_mrp;
							
							var bottle_case			= item_detail.total_cases;
							var in_case				= item_detail.in_cases;
							
							var is_new='new_item';
							if(item_detail.product_id>0){
								is_new='old_item';
							}
							var qty=1;
							if(item_qty>0){
								qty=item_qty;
							}
							
							var product_id = item_detail.product_id;
							var item_row = i;
							html += '<tr id="product_' + product_id + '" data-id="' + item_row + '" class="'+is_new+'">' +
							'<input type="hidden" name="item_scan_time_' + product_id + '" id="item_scan_time_' + product_id + '" value="' + scan_time + '">' +
							'<input type="hidden" name="inward_item_detail_id_' + product_id + '" id="inward_item_detail_id_' + product_id + '" value="">' +
							'<input type="hidden" name="stock_transfers_detail_id_' + product_id + '" id="stock_transfers_detail_id_' + product_id + '" value="">' +
							'<td><a href="javascript:;" onclick="remove(' + product_id + ');"><i class="fas fa-times"></i></a></td>' +
							'<td>'+product_barcode+'</td>'+
					        '<td>'+bottle_case+'</td>'+
							'<td onkeypress="return check_character(event);" class="number greenBg p_product_in_case" contenteditable="true" id="product_in_case_'+product_id+'">'+in_case+'</td>'+
							
							'<td onkeypress="return check_character(event);" class="number greenBg p_product_qty" contenteditable="true" id="product_qty_'+product_id+'">'+qty+'</td>'+
							'<td onkeypress="return check_character(event);" class="number greenBg p_free_qty" contenteditable="true" style="color: black;" id="free_qty_'+product_id+'">0</td>'+
							'<td>'+item_category+'</td>'+
							'<td>'+item_sub_category+'</td>'+
							'<td><a id="inwardproduct_popup_'+product_id+'"><span class="informative" id="brand_name_'+product_id+'">'+item_brand_name+'</span></a></td>'+
							'<td contenteditable="true" id="batch_no_'+product_id+'">'+item_batch_no+'</td>'+
							'<td id="measure_'+product_id+'">'+item_measure+'</td>'+
							'<td class="number greenBg" contenteditable="true" id="strength_'+product_id+'">'+strength+'</td>'+
							'<td class="number greenBg" contenteditable="true" id="bl_'+product_id+'">'+item_bl+'</td>'+
							'<td class="number greenBg" contenteditable="true" id="lpl_'+product_id+'">'+item_lpl+'</td>'+
							'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="unit_cost_'+product_id+'"></td>'+
							'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="retailer_margin_'+product_id+'"></td>'+
							'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="round_off_'+product_id+'"></td>'+
							'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="sp_fee_'+product_id+'"></td>'+
							'<td onkeypress="return check_character(event);" class="number greenBg p_offer_price" contenteditable="true" id="offer_price_'+product_id+'"></td>'+
							'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="product_mrp_'+product_id+'">'+product_mrp+'</td>'+
							'<td id="total_cost_'+product_id+'">'+total_cost+'</td>'+
							'</tr>';
						}
						
						$("#product_record_sec").html(html);
						final_calculation();
						
						
						
						//alert(json.result.length);
					} else {
						toastr.error("No data found!");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
    });
});

$(document).on('click', '#addProductSubmitBtm', function() {
	$('#ajax_loader').show();
    var product_info = [];
    var inward_stock_info = {};
	
	$("#new_product_record_sec tr").each(function(index, e) {
		var rowcount = $(this).data('id');
		$("#new_product_record_sec").find("tr[data-id='" + rowcount + "']").each(function(key, keyval) {
			var product_detail = {};
			var tr = $(this).attr('id');
			var product_id = tr.split('product_')[1];
			
			var id = '';
			var values = '';
			product_detail['product_id'] = product_id;
			var cost_price = '';

            $(this).find('td').each(function() {
                if ($(this).attr('id') != undefined) {
                    id = $(this).attr('id').split('_' + product_id)[0];
                    values = $(this).html();
                    product_detail[id] = values;
                }
            });
            product_info.push(product_detail);
        });
    });
	
    $.ajax({
        url: prop.ajaxurl,
        type: 'post',
        data: {
            inward_stock: product_info,
            action: 'add_new_product',
            _token: prop.csrf_token
        },
        dataType: 'json',
        success: function(response) {
			$('#newProductItemsModal').modal('hide');
			$('#ajax_loader').hide();
			var html='';
			var scan_time = moment().format("DD-MM-YYYY h:mm:ss a");
			for (var i = 0; i < response.result.length; i++) {
				var item_detail = response.result[i];
				
				var product_barcode		= item_detail.product_barcode;
				var item_category 		= item_detail.category;
				var item_sub_category 	= item_detail.sub_category;
				var item_brand_name 	= item_detail.brand_name;
				var item_bl 			= item_detail.bl;
				var item_lpl 			= item_detail.lpl;
				var item_measure 		= item_detail.measure;
				var item_qty 			= item_detail.qty;
				var total_cost 			= item_detail.total_cost;
				var item_batch_no 		= item_detail.batch_no;
				var strength 			= item_detail.strength;
				var retailer_margin 	= item_detail.retailer_margin;
				var round_off 			= item_detail.round_off;
				var sp_fee 				= item_detail.sp_fee;
				var product_mrp 		= item_detail.product_mrp;
				
				var bottle_case			= item_detail.total_cases;
				var in_case				= item_detail.in_cases;
				
				var qty=1;
				if(item_qty>0){
					qty=item_qty;
				}
				var product_id = item_detail.product_id;
				//alert(product_barcode);
				//return false;
				var item_row = i;
				html += '<tr id="product_' + product_id + '" data-id="' + item_row + '" >' +
					'<input type="hidden" name="item_scan_time_' + product_id + '" id="item_scan_time_' + product_id + '" value="' + scan_time + '">' +
					'<input type="hidden" name="inward_item_detail_id_' + product_id + '" id="inward_item_detail_id_' + product_id + '" value="">' +
					'<input type="hidden" name="stock_transfers_detail_id_' + product_id + '" id="stock_transfers_detail_id_' + product_id + '" value="">' +
					'<td><a href="javascript:;" onclick="remove(' + product_id + ');"><i class="fas fa-times"></i></a></td>' +
					'<td>'+product_barcode+'</td>'+
					'<td>'+bottle_case+'</td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg p_product_in_case" contenteditable="true" id="product_in_case_'+product_id+'">'+in_case+'</td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg p_product_qty" contenteditable="true" id="product_qty_'+product_id+'">'+item_qty+'</td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg p_free_qty" contenteditable="true" style="color: black;" id="free_qty_'+product_id+'">0</td>'+
					'<td>'+item_category+'</td>'+
					'<td>'+item_sub_category+'</td>'+
					'<td><a id="inwardproduct_popup_'+product_id+'"><span class="informative" id="brand_name_'+product_id+'">'+item_brand_name+'</span></a></td>'+
					'<td contenteditable="true" id="batch_no_'+product_id+'">'+item_batch_no+'</td>'+
					'<td id="measure_'+product_id+'">'+item_measure+'</td>'+
					'<td class="number greenBg" contenteditable="true" id="strength_'+product_id+'">'+strength+'</td>'+
					'<td class="number greenBg" contenteditable="true" id="bl_'+product_id+'">'+item_bl+'</td>'+
					'<td class="number greenBg" contenteditable="true" id="lpl_'+product_id+'">'+item_lpl+'</td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="unit_cost_'+product_id+'">'+product_mrp+'</td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="retailer_margin_'+product_id+'">'+retailer_margin+'</td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="round_off_'+product_id+'">'+round_off+'</td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="sp_fee_'+product_id+'">'+sp_fee+'</td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg p_offer_price" contenteditable="true" id="offer_price_'+product_id+'"></td>'+
					'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="product_mrp_'+product_id+'"></td>'+
					'<td id="total_cost_'+product_id+'">'+total_cost+'</td>'+
					'</tr>';
				}
				$("#product_record_sec").prepend(html);
				final_calculation();
				
			
			
            Swal.fire({
                title: 'Product add successfully done.',
                showDenyButton: false,
                showCancelButton: false,
                allowOutsideClick: false
            }).then((result) => {

                if (result.isConfirmed) {
                    //$('#supplier-inward_stock-form').hide();
			        //$('#supplier-inward_stock-product-form').show();
                } else if (result.isDenied) {
                }
            })
        }
    });
});




$(document).ready(function() {
    $("#supplier-inward_stock-form").validate({
        rules: {
            supplier_company_name: "required",
            supplier_email: "required",
            supplier_first_name: "required",
            supplier_last_name: "required",
            /*notes: "required",*/
            supplier_due_days: "required",
            supplier_due_date: "required",
            supplier_company_address: "required",
            supplier_company_area: "required",
            about: "supplier_company_zipcode",
        },
        messages: {
            //promo: "Required",
        },
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
			$('#supplier_company_name').html($('#supplier').val());
			$('#supplier_invoice_no').html($('#invoice_no').val());
			$('#supplier_transport_pass_no').html($('#tp_no').val());
			$('#supplier_invoice_purchase_date').html($('#purchase_date').val());
			$('#supplier_invoice_inward_date').html($('#inward_date').val());
				
			$('#supplier-inward_stock-form').hide();
			$('#supplier-inward_stock-product-form').show();
			
			
			$('#input-supplier_company_name').val($('#supplier').val());
			$('#input-supplier_company_id').val($('#supplier_id').val());
			$('#input-supplier_invoice_no').val($('#invoice_no').val());
			$('#input-supplier_invoice_purchase_date').val($('#purchase_date').val());
			$('#input-supplier_invoice_inward_date').val($('#inward_date').val());
			
			$('#input-supplier_shipping_note').val($('#shipping_note').val());
			$('#input-supplier_additional_note').val($('#shipping_note').val());
			
			
			//toastr.error("Supplier can not be empty!");
			
			
		}
    });
});

$(document).on('click','.open_supplier_form',function(){
	$('#supplier-inward_stock-form').show();
	$('#supplier-inward_stock-product-form').hide();
});

$(document).on('click','#payment_detail_modal_btn',function(){
	$('#paymentDetailModal').modal('show');
});

$(document).on('click','#changeAddressBtn',function(){
	$('#changeAddressModal').modal('show');
});



$(document).ready(function() {
	$("#supplier").keyup(function() {
        var search = $(this).val();
        if (search != "") {
            $.ajax({
                url: prop.ajaxurl,
                type: 'post',
                data: {
                    search: search,
					action: 'get_suppliers',
					_token: prop.csrf_token
                },
                dataType: 'json',
                success: function(response) {
					var len = response.result.length;
					 
                    $("#supplier_search_result").empty();
                    for (var i = 0; i < len; i++) {
                        var id = response.result[i]['id'];
                        var company_name = response.result[i]['company_name'];
                        $("#supplier_search_result").append("<li value='" + id + "'>" + company_name + "</li>");
                    }
                    // binding click event to li
                    $("#supplier_search_result li").bind("click", function() {
                        $('.loader_section').show();
						setSupplierRow(this);
                    });
                }
            });
        }
    });
		
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
                        var name = response.result[i]['product_name']+'-'+response.result[i]['product_size'];
                        $("#product_search_result").append("<li value='" + id + "'>" + name + "</li>");
                    }
                    // binding click event to li
                    $("#product_search_result li").bind("click", function() {
                        $('.loader_section').show();
						setRow(this);
                    });
                }
            });
        }else{
			$("#product_search").val('');
			$("#product_search_result").empty();
		}
    });
});

function remove(row) {
    $("#product_record_sec").find("tr[data-id='" + row + "']").remove();
    var total_qty = $("#product_record_sec tr").length;
    $(".total_qty").html(total_qty);
	final_calculation();
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
				
				
				var product_barcode 	= item_detail.product_barcode;
				var bottle_case 		= item_detail.bottle_case;
				var item_category 		= item_detail.category;
				var item_sub_category 	= item_detail.sub_category;
				var item_brand_name 	= item_detail.brand_name;
				var item_bl 			= item_detail.bl;
				var item_lpl 			= item_detail.lpl;
				var item_measure 		= item_detail.measure;
				var item_qty 			= item_detail.qty;
				var total_cost 			= item_detail.total_cost;
				var item_batch_no 		= item_detail.batch_no;
				
				var strength 			= item_detail.strength;
				var retailer_margin 	= item_detail.retailer_margin;
				var round_off 			= item_detail.round_off;
				var sp_fee 				= item_detail.sp_fee;
				var product_mrp 		= item_detail.product_mrp;
				
				var product_id = item_detail.product_id;
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
				
				
				var row = 0;
				var same_item=0;
				$("#product_record_sec tr").each(function () {
					var row_product_id = $(this).attr('id').split('_')[1];
					if (row_product_id == product_id) {
						same_item=1;
						toastr.error("This product already added");
					}
				});
				var in_case=1;
				var item_qty = (bottle_case*in_case);
				if(same_item == 0){
					html += '<tr id="product_' + product_id + '" data-id="' + item_row + '">' +
						'<input type="hidden" name="item_scan_time_' + product_id + '" id="item_scan_time_' + product_id + '" value="' + scan_time + '">' +
						'<input type="hidden" name="inward_item_detail_id_' + product_id + '" id="inward_item_detail_id_' + product_id + '" value="">' +
						'<input type="hidden" name="stock_transfers_detail_id_' + product_id + '" id="stock_transfers_detail_id_' + product_id + '" value="">' +
						'<td><a href="javascript:;" onclick="remove(' + product_id + ');"><i class="fas fa-times"></i></a></td>' +
						'<td>'+product_barcode+'</td>'+
						'<td>'+bottle_case+'</td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg p_product_in_case" contenteditable="true" id="product_in_case_'+product_id+'">'+in_case+'</td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg p_product_qty" contenteditable="true" id="product_qty_'+product_id+'">'+item_qty+'</td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg p_free_qty" contenteditable="true" style="color: black;" id="free_qty_'+product_id+'">0</td>'+
						'<td>'+item_category+'</td>'+
						'<td>'+item_sub_category+'</td>'+
						'<td><a id="inwardproduct_popup_'+product_id+'"><span class="informative" id="brand_name_'+product_id+'">'+item_brand_name+'</span></a></td>'+
						'<td contenteditable="true" id="batch_no_'+product_id+'">'+item_batch_no+'</td>'+
						'<td id="measure_'+product_id+'">'+item_measure+'</td>'+
						'<td class="number greenBg" contenteditable="true" id="strength_'+product_id+'">'+strength+'</td>'+
						'<td class="number greenBg" contenteditable="true" id="bl_'+product_id+'">'+item_bl+'</td>'+
						'<td class="number greenBg" contenteditable="true" id="lpl_'+product_id+'">'+item_lpl+'</td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="unit_cost_'+product_id+'"></td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="retailer_margin_'+product_id+'"></td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="round_off_'+product_id+'"></td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="sp_fee_'+product_id+'"></td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg p_offer_price" contenteditable="true" id="offer_price_'+product_id+'"></td>'+
						'<td onkeypress="return check_character(event);" class="number greenBg" contenteditable="true" id="product_mrp_'+product_id+'"></td>'+
						'<td id="total_cost_'+product_id+'">'+total_cost+'</td>'+
						'</tr>';
					}
					
				$("#product_record_sec").prepend(html);
				$('.loader_section').hide();
				final_calculation();
				
			}	
        }

    });
}

// Set Text to search box and get details
function setSupplierRow(element){
	var value 		= $(element).text();
    var company_id 	= $(element).val();
	
	$("#supplier_search_result").empty();
	
	
	
    // Request User Details
    $.ajax({
        url: prop.ajaxurl,
        type: 'post',
		data: {
			company_id: company_id,
			action: 'get_supplier_byId',
			_token: prop.csrf_token
               },
		dataType: 'json',
        success: function(response){
			if(response.status=='1'){
				var html = '';
				var supplier_detail 	= response.supplier;
				var supplier_gst_detail = response.supplier_gst;
				
				
				var company_name='';
				if (supplier_detail.company_name != null || supplier_detail.company_name != undefined) {
					company_name = supplier_detail.company_name;
				}
				var email='';
				if (supplier_detail.email != null || supplier_detail.email != undefined) {
					email = supplier_detail.email;
				}
				
				var address='';
				if (supplier_detail.address != null || supplier_detail.address != undefined) {
					address = supplier_detail.address;
				}
				var area='';
				if (supplier_detail.area != null || supplier_detail.area != undefined) {
					area = supplier_detail.area;
				}
				var city='';
				if (supplier_detail.city != null || supplier_detail.city != undefined) {
					city = supplier_detail.city;
				}
				
				var phone_no='';
				if (supplier_detail.phone_no != null || supplier_detail.phone_no != undefined) {
					phone_no = supplier_detail.phone_no;
				}
				
				var gstin='';
				if (supplier_detail.gstin != null || supplier_detail.gstin != undefined) {
					gstin = supplier_detail.gstin;
				}

				var pan='';
				if (supplier_detail.pan != null || supplier_detail.pan != undefined) {
					pan = supplier_detail.pan;
				}
				var pin='';
				if (supplier_detail.pin != null || supplier_detail.pin != undefined) {
					pin = supplier_detail.pin;
				}
				var website='';
				if (supplier_detail.website != null || supplier_detail.website != undefined) {
					website = supplier_detail.website;
				}
				$('#supplier').val(company_name);
				$('#supplier_id').val(company_id);
				$('#supplier_company_name').html(company_name);
				$('#supplier_invoice_no').html($('#invoice_no').val());
				$('#supplier_transport_pass_no').html($('#tp_no').val());
				
				$('#supplier_invoice_purchase_date').html($('#purchase_date').val());
				$('#supplier_invoice_inward_date').html($('#inward_date').val());
				
				$('#input-supplier_company_name').val(company_name);
				$('#input-supplier_company_id').val(company_id);
				$('#input-supplier_invoice_no').val($('#invoice_no').val());
				$('#input-supplier_invoice_purchase_date').val($('#purchase_date').val());
				$('#input-supplier_invoice_inward_date').val($('#inward_date').val());
				
				
				//alert(JSON.stringify(item_detail));
				var supplier_details_html='<h4>Supplier Details :</h4><p><strong>'+company_name+'</strong><br>'+address+' ,<br>'+area+' , '+pin+'<br>Contact : '+phone_no+'<br>Email : '+email+'<br>Website : '+website+'<br>GSTIN : '+gstin+'<br>PAN :'+pan+'</p><a href="javascript:;" class="changeAddress" id="changeAddressBtn"><i class="fas fa-pen"></i>Change Address</a> ';
				
				$("#supplier_details_sec").html(supplier_details_html);
				$('.loader_section').hide();

				
			}	
        }

    });
}


$(document).on('click', '#inwardStockSubmitBtm', function() {
	$('#ajax_loader').show();
    var product_info = [];
    var inward_stock_info = {};
    inward_stock_info['total_qty'] = $("#input-supplier_qty_total").val();
    inward_stock_info['gross_amount'] = $("#input-supplier_gross_amount").val();
    inward_stock_info['tax_amount'] = $("#input-supplier_tax_amount").val();
    inward_stock_info['sub_total'] = $("#input-supplier_sub_total").val();
    inward_stock_info['shipping_note'] = $("#input-supplier_shipping_note").val();
    inward_stock_info['additional_note'] = $("#input-supplier_additional_note").val();
    inward_stock_info['company_name'] = $("#input-supplier_company_name").val();
    inward_stock_info['company_id'] = $("#input-supplier_company_id").val();
	inward_stock_info['tp_no'] = $("#tp_no").val();
    inward_stock_info['invoice_no'] = $("#input-supplier_invoice_no").val();
    inward_stock_info['invoice_purchase_date'] = $("#input-supplier_invoice_purchase_date").val();
    inward_stock_info['invoice_inward_date'] = $("#input-supplier_invoice_inward_date").val();
    inward_stock_info['stock_inward_tax_type'] = $("#tax_type").val();
    inward_stock_info['due_days'] = $("#inward_due_days").val();
    inward_stock_info['due_date'] = $("#inward_due_date").val();

    $("#product_record_sec tr").each(function(index, e) {
        var rowcount = $(this).data('id');
        $("#product_record_sec").find("tr[data-id='" + rowcount + "']").each(function(key, keyval) {
            var product_detail = {};
            var tr = $(this).attr('id');
            var product_id = tr.split('product_')[1];

            var id = '';
            var values = '';
            product_detail['product_id'] = product_id;
            var cost_price = '';

            $(this).find('td').each(function() {
                if ($(this).attr('id') != undefined) {
                    id = $(this).attr('id').split('_' + product_id)[0];
                    values = $(this).html();
                    product_detail[id] = values;
                }
            });
            product_info.push(product_detail);
        });
    });

    inward_stock_info['product_detail'] = product_info;

    $.ajax({
        url: prop.ajaxurl,
        type: 'post',
        data: {
            inward_stock: inward_stock_info,
            action: 'add_inward_stock',
            _token: prop.csrf_token
        },
        dataType: 'json',
        success: function(response) {
            Swal.fire({
                title: 'Stock Inward is successfully done.',
                showDenyButton: false,
                showCancelButton: false,
                allowOutsideClick: false
            }).then((result) => {

                if (result.isConfirmed) {
                    location.reload();
                } else if (result.isDenied) {
                }
            })
        }
    });
});

