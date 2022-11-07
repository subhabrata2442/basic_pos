$(document).on('click','.add_more_size_btn',function(){
	var count=$('.add_more_size_section').find('.card').length;
	
	var size_html=$('#size-sec-0').html();
	
	var html ='<div class="card" id="add_more_size_row_'+count+'"><div class="row">';
		html +='<div class="col-md-12" id="size-sec-'+count+'">'+size_html+'</div>';
		html +='<div class="col-md-3"><div class="form-group"><label for="cost_rate_'+count+'" class="form-label">Cost Rate</label><input type="text" class="form-control admin-input cost_rate" id="cost_rate_'+count+'" name="cost_rate[]" value="0" required autocomplete="off"></div></div>';
		html +='<div class="col-md-3"><div class="form-group"><label for="cost_gst_percent_'+count+'" class="form-label">Cost GST %</label><input type="text" class="form-control admin-input cost_gst_percent" id="cost_gst_percent_'+count+'" name="cost_gst_percent[]" value="0" required autocomplete="off"></div></div>';
		html +='<div class="col-md-3"><div class="form-group"><label for="cost_gst_amount_'+count+'" class="form-label">Cost GST &#8377; </label><input type="text" class="form-control admin-input notallowinput" id="cost_gst_amount_'+count+'" name="cost_gst_amount[]" value="0" autocomplete="off"></div></div>';
		html +='<div class="col-md-3"><div class="form-group"><label for="cost_price_'+count+'" class="form-label">Cost Price</label><input type="text" class="form-control admin-input notallowinput" id="cost_price_'+count+'" name="cost_price[]" value="0"  autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="extra_charge_'+count+'" class="form-label">Extra Charge</label><input type="text" class="form-control admin-input extra_charge" id="extra_charge_'+count+'" name="extra_charge[]" value="0"  autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="profit_percent_'+count+'" class="form-label">Profit %</label><input type="text" class="form-control admin-input profit_percent" id="profit_percent_'+count+'" name="profit_percent[]" value="0" autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="profit_amount_'+count+'" class="form-label">Profit &#8377; </label><input type="text" class="form-control admin-input notallowinput" id="profit_amount_'+count+'" name="profit_amount[]" value="0"  autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="selling_price_'+count+'" class="form-label">Selling Rate</label><input type="text" class="form-control admin-input notallowinput" id="selling_price_'+count+'" name="selling_price[]" value="0"  autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="sell_gst_percent_'+count+'" class="form-label">Sell GST %</label><input type="text" class="form-control admin-input sell_gst_percent" id="sell_gst_percent_'+count+'" name="sell_gst_percent[]" value="0"  autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="sell_gst_amount_'+count+'" class="form-label">Sell GST &#8377; </label><input type="text" class="form-control admin-input notallowinput" id="sell_gst_amount_'+count+'" name="sell_gst_amount[]" value="0"  autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="offer_price_'+count+'" class="form-label">Offer Price</label><input type="text" class="form-control admin-input number offer_price" id="offer_price_'+count+'" name="offer_price[]" value="0"  autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="product_mrp_'+count+'" class="form-label">Product MRP <a href="javascript:;" data-toggle="tooltip" class="pa-0 ma-0  bold" style="font-size:20px;" data-placement="top" title="Profit is calculated on Offer Price, and not on MRP.  If you do not have Offer Price then you can keep Offer Price same as MRP." data-content="" ><i class="fa fa-eye cursor"></i></a></label><input type="text" class="form-control admin-input number" id="product_mrp_'+count+'" name="product_mrp[]" value="0"  autocomplete="off"></div></div>';
		html +='<div class="col-md-4"><div class="form-group"><label for="wholesale_price_'+count+'" class="form-label">Wholesale Price</label><input type="text" class="form-control admin-input number" id="wholesale_price_'+count+'" name="wholesale_price[]" value="0"  autocomplete="off"></div></div>';
		html +='</div></div>';
		
		$('#add_more_size_section_row').append(html);
});






$(document).on('click','.addmoreoption',function(){
	
	var feature_title=$(this).data('title');
	var feature_type=$(this).data('type');
	 
     $('.dnamic_feature_title').html("Add " + feature_title);
     $('.dnamic_feature_name').html(feature_title +" Name");
     $('#product_features_type').val(feature_type);
	 $('#product_feature_data_value').val('');
	 $("#addproducts_features").modal('show');
	 
});

$(document).on('click','#productfeaturessave',function(){
	var product_type	= $('#product_features_type').val();
	var feature_title	= $('#product_feature_data_value').val();
	
	 $.ajax({
            url: prop.ajaxurl,
            type: 'post',
			dataType: "json",
            data: {
                product_type: product_type,
				feature_title: feature_title,
                action: 'set_feature_option',
                _token: prop.csrf_token
            },
            beforeSend: function() {},
            success: function(response) {
				if(response.status==0){
					toastr.error(response.msg);
				}else{
					$('#'+product_type)
					 .append($("<option></option>")
					 .attr("value", response.val)
					 .attr("selected", "selected")
					 .text(response.title)); 
					
					
					toastr.success(response.msg);
					$("#addproducts_features").modal('hide');
					
				}
               
            }
        });
	
	
	
	 
});




$(document).on('keyup','.cost_rate',function(){
	var row_id	= $(this).attr('id').split('cost_rate_')[1];
	
    var costrate = $(this).val();
    var costgstper = $("#cost_gst_percent_"+row_id).val();
	
    var extra_charge = $("#extra_charge_"+row_id).val();
    var costgstamt = ((Number(costrate) * Number(costgstper)) / Number(100)).toFixed(4);
	
    $("#cost_gst_amount_"+row_id).val(costgstamt);
    var costprice = (Number(costrate) + Number(costgstamt)).toFixed(4);
	console.log(costprice);
    $("#cost_price_"+row_id).val(costprice);

    var productper = $("#profit_percent_"+row_id).val();

    var cost_rate_with_extracha = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);
    var productrs = ((Number(cost_rate_with_extracha) * Number(productper)) / Number(100)).toFixed(4);
    if (productrs <= 0) {
        $("#profit_amount_"+row_id).css('color', 'red');
    } else {
        $("#profit_amount_"+row_id).removeAttr('color');
    }

    if (productper <= 0) {
        $("#profit_percent_"+row_id).css('color', '#c9571b');
    } else {
        $("#profit_percent_"+row_id).removeAttr('color');
    }
    $("#profit_amount_"+row_id).val(productrs);
	
    var sellingprice = (Number(cost_rate_with_extracha) + Number(productrs)).toFixed(4);


    $("#selling_price_"+row_id).val(sellingprice);
    var sellingper = $("#sell_gst_percent_"+row_id).val();
    var sellingstrs = ((Number(sellingprice) * Number(sellingper)) / Number(100)).toFixed(4);
    var productmrp = (Number(sellingprice) + Number(sellingstrs)).toFixed(4);
    $("#sell_gst_amount_"+row_id).val(sellingstrs);
    $("#product_mrp_"+row_id).val(productmrp);
    $("#offer_price_"+row_id).val(productmrp);

});


$(document).on('keyup','.cost_gst_percent',function(){
	var row_id	= $(this).attr('id').split('cost_gst_percent_')[1];
	
    var costgstper = '';
    var costrate = Number($("#cost_rate_"+row_id).val());
    costgstper = Number($(this).val());

    $("#sell_gst_percent_"+row_id).val(costgstper);
	
    var costgstval = ((Number(costrate) * Number(costgstper)) / Number(100)).toFixed(4);
    $("#cost_gst_amount_"+row_id).val(costgstval);
    $("#sell_gst_amount_"+row_id).val(costgstval);
	
    var costprice = (Number(costrate) + Number(costgstval)).toFixed(4);
    $("#cost_price_"+row_id).val(costprice);

    var extra_charge = $("#extra_charge_"+row_id).val();
    var profiteval = $("#profit_percent_"+row_id).val();
    var cost_rate_with_extracharge = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);
    var profitrs = ((Number(cost_rate_with_extracharge) * Number(profiteval)) / Number(100)).toFixed(4);

    var sellingprice = (Number(cost_rate_with_extracharge) + Number(profitrs)).toFixed(4);
    $("#selling_price_"+row_id).val(sellingprice);

    var sellgstper = $("#sell_gst_percent_"+row_id).val();
    var sellingstrs = ((Number(sellingprice) * Number(sellgstper)) / Number(100)).toFixed(4);
    var productmrp = (Number(sellingprice) + Number(sellingstrs)).toFixed(4);

    $("#sell_gst_amount_"+row_id).val(sellingstrs);
    $("#product_mrp_"+row_id).val(productmrp);
    $("#offer_price_"+row_id).val(productmrp);

});

$(document).on('keyup','.profit_percent',function(){
	var row_id	= $(this).attr('id').split('profit_percent_')[1];
	
    var costrate = $('#cost_rate_'+row_id).val();
    var profitper = $("#profit_percent_"+row_id).val();
    var extra_charge = $("#extra_charge_"+row_id).val();
    var cost_rate_with_extracharge = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);
    var profitval = ((Number(cost_rate_with_extracharge) * Number(profitper)) / Number(100)).toFixed(4);

    if (profitval <= 0) {
        $("#profit_amount_"+row_id).css('color', '#c9571b');
    } else {
        $("#profit_amount_"+row_id).css('color', 'black');
    }

    if (profitper <= 0) {
        $("#profit_percent_"+row_id).css('color', '#c9571b');
    } else {
        $("#profit_percent_"+row_id).removeAttr('color');
    }
    $("#profit_amount_"+row_id).val(profitval);
    var selling_mrp_price = (Number(cost_rate_with_extracharge) + Number(profitval)).toFixed(4);
    $("#selling_price_"+row_id).val(selling_mrp_price);
    var sellgstper = $("#sell_gst_percent_"+row_id).val();
    var sellingstrs = ((Number(selling_mrp_price) * Number(sellgstper)) / Number(100)).toFixed(4);
    $("#sell_gst_amount_"+row_id).val(sellingstrs);
    var productmrp = (Number(selling_mrp_price) + Number(sellingstrs)).toFixed(4);
    $("#product_mrp_"+row_id).val(productmrp);
    $("#offer_price_"+row_id).val(productmrp);
});

$(document).on('keyup','.extra_charge',function(){
	var row_id	= $(this).attr('id').split('extra_charge_')[1];	
	
    var cost_rate = $("#cost_rate_"+row_id).val();
    var extra_charge = $("#extra_charge_"+row_id).val();
    var cost_rate_with_extra = ((Number(cost_rate)) + (Number(extra_charge))).toFixed(4);
    var profit_percent = $("#profit_percent_"+row_id).val();
    var profit_amount = ((Number(profit_percent)) * (Number(cost_rate_with_extra)) / (Number(100))).toFixed(4);
    $("#profit_amount_"+row_id).val(profit_amount);
    var selling_price = ((Number(cost_rate_with_extra)) + (Number(profit_amount))).toFixed(4);
    $("#selling_price_"+row_id).val(selling_price);
    var selgstper = $("#sell_gst_percent_"+row_id).val();
    var sellinggstamt = (((Number(selling_price)) * (Number(selgstper)) / ((Number(100)) )).toFixed(4));
    $("#sell_gst_amount_"+row_id).val(sellinggstamt);
    var productmrp = (Number(selling_price) + Number(sellinggstamt)).toFixed(4);
    $("#sell_gst_amount_"+row_id).val(sellinggstamt);
    $("#product_mrp_"+row_id).val(productmrp);
    $("#offer_price_"+row_id).val(productmrp);

});
$(document).on('keyup','.sell_gst_percent',function(){
	var row_id	= $(this).attr('id').split('sell_gst_percent_')[1];
	
    var sellingprice = $("#selling_price_"+row_id).val();
    var selgstper = $("#sell_gst_percent_"+row_id).val();
    var costrate = $("#cost_rate_"+row_id).val();

    var extra_charge = $("#extra_charge_"+row_id).val();
    var cost_rate_with_extra = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);
    var selligdiff = ((Number(sellingprice)) - (Number(cost_rate_with_extra))).toFixed(4);
    var sellinggstamt = (((Number(sellingprice)) * (Number(selgstper)) / ((Number(100)) )).toFixed(4));
    $("#sell_gst_amount_"+row_id).val(sellinggstamt);
    var productmrp = (Number(sellingprice) + Number(sellinggstamt)).toFixed(4);
    $("#sell_gst_amount_"+row_id).val(sellinggstamt);
    $("#product_mrp_"+row_id).val(productmrp);
    $("#offer_price_"+row_id).val(productmrp);

});



$(document).on('keyup','.offer_price',function(){
	var row_id	= $(this).attr('id').split('offer_price_')[1];	

    var offerprice = $("#offer_price_"+row_id).val();
    var sellgstper = $("#sell_gst_percent_"+row_id).val();


    var eq1 = (Number(offerprice) * Number(sellgstper)).toFixed(4);
    var eq2 = (Number(100) + Number(sellgstper)).toFixed(4);
    var sellgstval = (Number(eq1) / Number(eq2)).toFixed(4);

    $("#product_mrp_"+row_id).val(offerprice);
    $("#sell_gst_amount_"+row_id).val(sellgstval);
    $("#product_mrp_"+row_id).val(offerprice);

    var costrate = $("#cost_rate_"+row_id).val();

    var sellingrate = ((Number(offerprice) - Number(sellgstval))).toFixed(4);
    $("#selling_price_"+row_id).val(sellingrate);

    var extra_charge = $("#extra_charge_"+row_id).val();
    var cost_rate_with_extracharge = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);

    var profitamt = ((Number(sellingrate)) - (Number(cost_rate_with_extracharge))).toFixed(4);

    if (profitamt <= 0) {
        $("#profit_amount_"+row_id).css('color', '#c9571b');
    } else {
        $("#profit_amount_"+row_id).css('color', 'black');
    }
    $("#profit_amount_"+row_id).val(profitamt);
    var profitper = $("#profit_percent_"+row_id).val();
    var ex1 = (Number(profitamt) * Number(100)).toFixed(4);
	
    if (costrate == 0) {
        costrate = 1;
    }
    if (cost_rate_with_extracharge == 0) {
        cost_rate_with_extracharge = 1;
    }

    var profitpernew = ((Number(ex1)) / (Number(cost_rate_with_extracharge))).toFixed(4);

    if (profitpernew <= 0) {
        $("#profit_percent_"+row_id).css('color', '#c9571b');
    } else {
        $("#profit_percent_"+row_id).css('color', 'black');
    }
	
    $("#profit_percent_"+row_id).val(profitpernew);
});



$(document).on('click', '.fetch_image', function(e) {
	$('#upload_photo').click();
});
function preview_image(files) {
	var input = document.getElementById('upload_photo');
	var files = !!input.files ? input.files : [];
    if (!files.length || !window.FileReader) return;
    if (/^image/.test(files[0].type)) {
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file
        reader.onloadend = function() { // set image data as background of div
		//$("#form-image-upload").submit()
		//$("#view_image_"+index).attr("src",this.result);  
		$("#thumb-image").find('img').attr('src', this.result);
        }
    }
}


