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




$('#cost_rate').keyup(function(e) {
    var costrate = $('#cost_rate').val();
    var costgstper = $("#cost_gst_percent").val();

    var extra_charge = $("#extra_charge").val();
    var costgstamt = ((Number(costrate) * Number(costgstper)) / Number(100)).toFixed(4);

    $("#cost_gst_amount").val(costgstamt);
    var costprice = (Number(costrate) + Number(costgstamt)).toFixed(4);
    $("#cost_price").val(costprice);

    var productper = $("#profit_percent").val();

    var cost_rate_with_extracha = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);
    var productrs = ((Number(cost_rate_with_extracha) * Number(productper)) / Number(100)).toFixed(4);
    if (productrs <= 0) {
        $("#profit_amount").css('color', 'red');
    } else {
        $("#profit_amount").removeAttr('color');
    }

    if (productper <= 0) {
        $("#profit_percent").css('color', 'red');
    } else {
        $("#profit_percent").removeAttr('color');
    }
    $("#profit_amount").val(productrs);
    //selling price
    var sellingprice = (Number(cost_rate_with_extracha) + Number(productrs)).toFixed(4);


    $("#selling_price").val(sellingprice);

    //selling gst rs
    var sellingper = $("#sell_gst_percent").val();
    var sellingstrs = ((Number(sellingprice) * Number(sellingper)) / Number(100)).toFixed(4);
    var productmrp = (Number(sellingprice) + Number(sellingstrs)).toFixed(4);
    $("#sell_gst_amount").val(sellingstrs);
    //product mrp
    $("#product_mrp").val(productmrp);
    //offer mrp
    $("#offer_price").val(productmrp);

});

$("#cost_gst_percent").keyup(function (){
    var costgstper = '';
    var costrate = Number($("#cost_rate").val());
    costgstper = Number($(this).val());

    $("#sell_gst_percent").val(costgstper);
	
	


    //count percentage value in rupee
    var costgstval = ((Number(costrate) * Number(costgstper)) / Number(100)).toFixed(4);
    $("#cost_gst_amount").val(costgstval);
    $("#sell_gst_amount").val(costgstval);

    //Add cost rate and cost rate gst in rupee
    var costprice = (Number(costrate) + Number(costgstval)).toFixed(4);
    $("#cost_price").val(costprice);

    var extra_charge = $("#extra_charge").val();
    var profiteval = $("#profit_percent").val();
    var cost_rate_with_extracharge = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);
    var profitrs = ((Number(cost_rate_with_extracharge) * Number(profiteval)) / Number(100)).toFixed(4);

    var sellingprice = (Number(cost_rate_with_extracharge) + Number(profitrs)).toFixed(4);
    $("#selling_price").val(sellingprice);

    var sellgstper = $("#sell_gst_percent").val();
    var sellingstrs = ((Number(sellingprice) * Number(sellgstper)) / Number(100)).toFixed(4);
    var productmrp = (Number(sellingprice) + Number(sellingstrs)).toFixed(4);

    $("#sell_gst_amount").val(sellingstrs);
    $("#product_mrp").val(productmrp);
    $("#offer_price").val(productmrp);

});

$("#profit_percent").keyup(function() {
    var costrate = $('#cost_rate').val();
    var profitper = $("#profit_percent").val();
    var extra_charge = $("#extra_charge").val();
    var cost_rate_with_extracharge = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);
    var profitval = ((Number(cost_rate_with_extracharge) * Number(profitper)) / Number(100)).toFixed(4);

    if (profitval <= 0) {
        $("#profit_amount").css('color', 'red');
    } else {
        $("#profit_amount").css('color', 'black');
    }

    if (profitper <= 0) {
        $("#profit_percent").css('color', 'red');
    } else {
        $("#profit_percent").removeAttr('color');
    }
    $("#profit_amount").val(profitval);
    var selling_mrp_price = (Number(cost_rate_with_extracharge) + Number(profitval)).toFixed(4);
    $("#selling_price").val(selling_mrp_price);
    var sellgstper = $("#sell_gst_percent").val();
    var sellingstrs = ((Number(selling_mrp_price) * Number(sellgstper)) / Number(100)).toFixed(4);
    $("#sell_gst_amount").val(sellingstrs);
    var productmrp = (Number(selling_mrp_price) + Number(sellingstrs)).toFixed(4);
    $("#product_mrp").val(productmrp);
    $("#offer_price").val(productmrp);


});




$("#extra_charge").keyup(function (){
    var cost_rate = $("#cost_rate").val();
    var extra_charge = $("#extra_charge").val();
    var cost_rate_with_extra = ((Number(cost_rate)) + (Number(extra_charge))).toFixed(4);
    var profit_percent = $("#profit_percent").val();
    var profit_amount = ((Number(profit_percent)) * (Number(cost_rate_with_extra)) / (Number(100))).toFixed(4);
    $("#profit_amount").val(profit_amount);
    var selling_price = ((Number(cost_rate_with_extra)) + (Number(profit_amount))).toFixed(4);
    $("#selling_price").val(selling_price);
    var selgstper = $("#sell_gst_percent").val();
    var sellinggstamt = (((Number(selling_price)) * (Number(selgstper)) / ((Number(100)) )).toFixed(4));
    $("#sell_gst_amount").val(sellinggstamt);
    var productmrp = (Number(selling_price) + Number(sellinggstamt)).toFixed(4);
    $("#sell_gst_amount").val(sellinggstamt);
    $("#product_mrp").val(productmrp);
    $("#offer_price").val(productmrp);

});
$("#sell_gst_percent").keyup(function()
{
    var sellingprice = $("#selling_price").val();
    var selgstper = $("#sell_gst_percent").val();
    var costrate = $("#cost_rate").val();

    var extra_charge = $("#extra_charge").val();
    var cost_rate_with_extra = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);
    var selligdiff = ((Number(sellingprice)) - (Number(cost_rate_with_extra))).toFixed(4);
    var sellinggstamt = (((Number(sellingprice)) * (Number(selgstper)) / ((Number(100)) )).toFixed(4));
    $("#sell_gst_amount").val(sellinggstamt);
    var productmrp = (Number(sellingprice) + Number(sellinggstamt)).toFixed(4);
    $("#sell_gst_amount").val(sellinggstamt);
    $("#product_mrp").val(productmrp);
    $("#offer_price").val(productmrp);

});


$("#offer_price").keyup(function() {

    var offerprice = $("#offer_price").val();
    var sellgstper = $("#sell_gst_percent").val();


    var eq1 = (Number(offerprice) * Number(sellgstper)).toFixed(4);
    var eq2 = (Number(100) + Number(sellgstper)).toFixed(4);
    var sellgstval = (Number(eq1) / Number(eq2)).toFixed(4);

    $("#product_mrp").val(offerprice);
    $("#sell_gst_amount").val(sellgstval);
    $("#product_mrp").val(offerprice);

    var costrate = $("#cost_rate").val();

    var sellingrate = ((Number(offerprice) - Number(sellgstval))).toFixed(4);
    $("#selling_price").val(sellingrate);

    var extra_charge = $("#extra_charge").val();
    var cost_rate_with_extracharge = ((Number(costrate)) + (Number(extra_charge))).toFixed(4);

    var profitamt = ((Number(sellingrate)) - (Number(cost_rate_with_extracharge))).toFixed(4);

    if (profitamt <= 0) {
        $("#profit_amount").css('color', 'red');
    } else {
        $("#profit_amount").css('color', 'black');
    }
    $("#profit_amount").val(profitamt);
    var profitper = $("#profit_percent").val();
    var ex1 = (Number(profitamt) * Number(100)).toFixed(4);
	
    if (costrate == 0) {
        costrate = 1;
    }
    if (cost_rate_with_extracharge == 0) {
        cost_rate_with_extracharge = 1;
    }

    var profitpernew = ((Number(ex1)) / (Number(cost_rate_with_extracharge))).toFixed(4);

    if (profitpernew <= 0) {
        $("#profit_percent").css('color', 'red');
    } else {
        $("#profit_percent").css('color', 'black');
    }
    $("#profit_percent").val(profitpernew);
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


