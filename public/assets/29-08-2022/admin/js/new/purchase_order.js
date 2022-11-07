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
				/*if(item_detail.default_qty !='' && item_detail.default_qty !=null){
					default_qty= item_detail.default_qty; 
				}*/
				
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

