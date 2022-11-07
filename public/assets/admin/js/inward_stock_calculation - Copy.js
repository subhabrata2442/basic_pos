function baseprice(obj) {
    var product_id = $(obj).attr('id').split('base_price_')[1];
    var tbl_row = $(obj).closest('tr').data('id');
    $("#product_detail_record").find("tr[data-id='" + tbl_row + "']").each(function() {
        var baseprice = $(this).find("#base_price_" + product_id).html();
        var freeqty = $(this).find("#free_qty_" + product_id).html();
        var qty = $(this).find("#product_qty_" + product_id).html();
        var total_qty_with = ((Number(freeqty)) + (Number(qty)));
        if (qty == 0) {
            qty = 1;
        }
        var discountpercent = $(this).find("#base_discount_percent_" + product_id).html();
        var discountamount = ((Number(baseprice)) * (Number(discountpercent)) / Number(100));
        $(this).find("#base_discount_amount_" + product_id).html(discountamount.toFixed(decimalpoints_forview));
        var costprice = ((Number(baseprice) - (Number(discountamount))));
        $(this).find("#cost_rate_" + product_id).html(costprice.toFixed(decimalpoints_forview));
        var schemepercent = $(this).find("#scheme_discount_percent_" + product_id).html();
        var cost_price_discount = $(this).find("#cost_rate_" + product_id).html();
        var schemeamount = ((Number(cost_price_discount) * Number(schemepercent)) / (Number(100)));
        $(this).find("#scheme_discount_amount_" + product_id).html(schemeamount.toFixed(decimalpoints_forview));
        var cost_final = (Number(cost_price_discount) - Number(schemeamount));
        $(this).find("#cost_rate_" + product_id).html(cost_final.toFixed(decimalpoints_forview));
        var cost_price_schm = $(this).find("#cost_rate_" + product_id).html();
        var freeamtbefore = 0;
        if (total_qty_with == 0) {
            freeamtbefore = ((Number(cost_price_schm)) * (Number(qty)) / ((Number(qty)) + (Number(freeqty))));
        } else {
            freeamtbefore = ((Number(cost_price_schm)) * (Number(qty)) / ((Number(total_qty_with))));
        }
        if (isNaN(freeamtbefore)) {
            freeamtbefore = 0;
        }
        var free_amount = ((Number(cost_price_schm)) - (Number(freeamtbefore)));
        var freepercent = (((Number(free_amount)) * (Number(100))) / (Number(cost_price_schm)));
        if (isNaN(freepercent)) {
            freepercent = 0;
        }
        $(this).find("#free_discount_percent_" + product_id).html(freepercent.toFixed(decimalpoints_forview));
        $(this).find("#free_discount_amount_" + product_id).html(free_amount.toFixed(decimalpoints_forview));
        var costpriceafterfree = ((Number(cost_price_schm)) - (Number(free_amount)));
        $(this).find("#cost_rate_" + product_id).html(costpriceafterfree.toFixed(decimalpoints_forview));
        var cost_rate = $(this).find("#cost_rate_" + product_id).html();
        var gstpercent = $(this).find("#gst_percent_" + product_id).html();
        var gstamount = ((Number(cost_rate)) * (Number(gstpercent)) / Number(100));
        $(this).find("#gst_amount_" + product_id).html(gstamount.toFixed(decimalpoints_forview));
        var gst_amt = $(this).find("#gst_amount_" + product_id).html();
        var cost_price = $(this).find("#cost_rate_" + product_id).html();
        var extracharge = $(this).find("#extra_charge_" + product_id).html();
        var cost_rate_for_profit = ((Number(cost_price)) + (Number(extracharge))).toFixed(decimalpoints_forview);
        var sellingprice = $(this).find("#sell_price_" + product_id).html();
        var profitamt = ((Number(sellingprice)) - (Number(cost_rate_for_profit)));
        $(this).find("#profit_amount_" + product_id).html(profitamt.toFixed(decimalpoints_forview));
        var profitpercent = 0;
        if (cost_rate_for_profit == '' || cost_rate_for_profit == '0.0000') {
            profitpercent = 100;
            $(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints_forview));
        } else {
            profitpercent = ((Number(100)) * (Number(profitamt)) / (Number(cost_rate_for_profit)));
            if (isNaN(profitpercent) == true) {
                profitpercent = 0;
            }
            $(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints_forview));
        }
        var totalqty = '';
        if (total_qty_with == 0) {
            totalqty = ((Number(freeqty)) + (Number(qty)));
        } else {
            totalqty = total_qty_with;
        }
        var totalcostval = (((Number(cost_rate)) + (Number(gst_amt))) * (Number(totalqty)));
        if (total_qty_with != 0 && !isNaN(total_qty_with)) {
            $(this).find("#total_cost_" + product_id).html(totalcostval.toFixed(decimalpoints_forview));
        } else {
            $(this).find("#total_cost_" + product_id).html(0);
        }
        totalcalculation();
    });
}

function extracharge(obj) {
    var product_id = $(obj).attr('id').split('extra_charge_')[1];
    var tbl_row = $(obj).closest('tr').data('id');
    $("#product_detail_record").find("tr[data-id='" + tbl_row + "']").each(function() {
        var cost_price = $(this).find("#cost_rate_" + product_id).html();
        var extracharge = $(this).find("#extra_charge_" + product_id).html();
        var costprice = ((Number(cost_price)) + (Number(extracharge))).toFixed(decimalpoints_forview);
        var sellingprice = $(this).find("#sell_price_" + product_id).html();
        var profitamt = ((Number(sellingprice)) - (Number(costprice)));
        $(this).find("#profit_amount_" + product_id).html(profitamt.toFixed(decimalpoints_forview));
        var profitpercent = ((Number(100)) * (Number(profitamt)) / (Number(costprice)));
        if (isNaN(profitpercent) == true) {
            profitpercent = 0;
        }
        $(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints_forview));
    });
}

function discountpercent(obj) {
    var product_id = $(obj).attr('id').split('base_discount_percent_')[1];
    var tbl_row = $(obj).closest('tr').data('id');
    $("#product_detail_record").find("tr[data-id='" + tbl_row + "']").each(function() {
        var freeqty = $(this).find("#free_qty_" + product_id).html();
        var qty = $(this).find("#product_qty_" + product_id).html();
        var total_qty_with = ((Number(freeqty)) + (Number(qty)));
        if (qty == 0) {
            qty = 1;
        }
        var baseprice = $(this).find("#base_price_" + product_id).html();
        var discountpercent = $(this).find("#base_discount_percent_" + product_id).html();
        var discountamount = ((Number(baseprice) * Number(discountpercent)) / Number(100));
        $(this).find("#base_discount_amount_" + product_id).html(discountamount.toFixed(decimalpoints_forview));
        var finalcost_rate_afterdiscount = ((Number(baseprice)) - (Number(discountamount)));
        $(this).find("#cost_rate_" + product_id).html(finalcost_rate_afterdiscount.toFixed(decimalpoints_forview));
        var cost_dis = $(this).find("#cost_rate_" + product_id).html();
        var schemepercent = $(this).find("#scheme_discount_percent_" + product_id).html();
        var schemeamt = ((Number(schemepercent)) * ((Number(cost_dis))) / Number(100));
        $(this).find("#scheme_discount_amount_" + product_id).html(schemeamt.toFixed(decimalpoints_forview));
        var finalcost_rate_afterscheme = ((Number(cost_dis)) - (Number(schemeamt)));
        $(this).find("#cost_rate_" + product_id).html(finalcost_rate_afterscheme.toFixed(decimalpoints_forview));
        var cost_sch = $(this).find("#cost_rate_" + product_id).html();
        var freeamtbefore = 0;
        if (total_qty_with == 0) {
            freeamtbefore = ((Number(cost_sch)) * (Number(qty)) / ((Number(qty)) + (Number(freeqty))));
        } else {
            freeamtbefore = ((Number(cost_sch)) * (Number(qty)) / ((Number(total_qty_with))));
        }
        var freepercent = 0;
        var free_amount = ((Number(cost_sch)) - (Number(freeamtbefore)));
        if (free_amount != 0) {
            freepercent = (((Number(free_amount)) * (Number(100))) / (Number(cost_sch)));
        }
        $(this).find("#free_discount_percent_" + product_id).html(freepercent.toFixed(decimalpoints_forview));
        $(this).find("#free_discount_amount_" + product_id).html(free_amount.toFixed(decimalpoints_forview));
        var costpriceafterfree = ((Number(cost_sch)) - (Number(free_amount)));
        $(this).find("#cost_rate_" + product_id).html(costpriceafterfree.toFixed(decimalpoints_forview));
        var cost = $(this).find("#cost_rate_" + product_id).html();
        var costgst = $(this).find("#gst_percent_" + product_id).html();
        var costgstamt = (Number(cost) * Number(costgst) / Number(100));
        $(this).find("#gst_amount_" + product_id).html(costgstamt.toFixed(decimalpoints_forview));
        var cost_price = $(this).find("#cost_rate_" + product_id).html();
        var extracharge = $(this).find("#extra_charge_" + product_id).html();
        var cost_rate = ((Number(cost_price)) + (Number(extracharge))).toFixed(decimalpoints_forview);
        var sellingprice = $(this).find("#sell_price_" + product_id).html();
        var profitamt = ((Number(sellingprice)) - (Number(cost_rate)));
        $(this).find("#profit_amount_" + product_id).html(profitamt.toFixed(decimalpoints_forview));
        var profitpercent = ((Number(100)) * (Number(profitamt)) / (Number(cost_rate)));
        if (isNaN(profitpercent) == true) {
            profitpercent = 0;
        }
        $(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints_forview));
        var totalqty = '';
        if (total_qty_with == 0) {
            totalqty = ((Number(freeqty)) + (Number(qty)));
        } else {
            totalqty = total_qty_with;
        }
        var cost_rate_fnl = $(this).find("#cost_rate_" + product_id).html();
        var cost_amt_gst = $(this).find("#gst_amount_" + product_id).html();
        var totalcostval = (((Number(cost_rate_fnl)) + (Number(cost_amt_gst))) * (Number(totalqty)));
        if (total_qty_with != 0 && !isNaN(total_qty_with)) {
            $(this).find("#total_cost_" + product_id).html(totalcostval.toFixed(decimalpoints_forview));
        }
        totalcalculation();
    });
}

function schemepercent(obj) {
    var tbl_row = $(obj).closest('tr').data('id');
    $("#product_detail_record").find("tr[data-id='" + tbl_row + "']").each(function() {
        var product_id = $(obj).attr('id').split('scheme_discount_percent_')[1];
        var baseprice = $(this).find("#base_price_" + product_id).html();
        var freeqty = $(this).find("#free_qty_" + product_id).html();
        var qty = $(this).find("#product_qty_" + product_id).html();
        var total_qty_with = ((Number(freeqty)) + (Number(qty)));
        if (qty == 0) {
            qty = 1;
        }
        var discountpercent = $(this).find("#base_discount_percent_" + product_id).html();
        var discountamount = ((Number(baseprice) * Number(discountpercent)) / Number(Number(100)));
        $(this).find("#base_discount_amount_" + product_id).html(discountamount.toFixed(decimalpoints_forview));
        var finalcost_rate_afterdiscount = ((Number(baseprice)) - (Number(discountamount)));
        $(this).find("#cost_rate_" + product_id).html(finalcost_rate_afterdiscount.toFixed(decimalpoints_forview));
        var cost_rate_after_discount = $(this).find("#cost_rate_" + product_id).html();
        var schemepercent = $(this).find("#scheme_discount_percent_" + product_id).html();
        var schemeamt = ((Number(cost_rate_after_discount)) * (Number(schemepercent)) / Number(100));
        $(this).find("#scheme_discount_amount_" + product_id).html(schemeamt.toFixed(decimalpoints_forview));
        var finalcostprice = ((Number(cost_rate_after_discount)) - (Number(schemeamt)));
        $(this).find("#cost_rate_" + product_id).html(finalcostprice.toFixed(decimalpoints_forview));
        var cost_rate_after_scheme = $(this).find("#cost_rate_" + product_id).html();
        var freeamtbefore = 0;
        if (total_qty_with == 0) {
            freeamtbefore = ((Number(cost_rate_after_scheme)) * (Number(qty)) / ((Number(qty)) + (Number(freeqty))));
        } else {
            freeamtbefore = ((Number(cost_rate_after_scheme)) * (Number(qty)) / ((Number(total_qty_with))));
        }
        var free_amount = ((Number(cost_rate_after_scheme)) - (Number(freeamtbefore)));
        var freepercent = 0;
        if (free_amount != 0) {
            freepercent = (((Number(free_amount)) * (Number(100))) / (Number(cost_rate_after_scheme)));
        }
        $(this).find("#free_discount_percent_" + product_id).html(freepercent.toFixed(decimalpoints_forview));
        $(this).find("#free_discount_amount_" + product_id).html(free_amount.toFixed(decimalpoints_forview));
        var costpriceafter_freeamt = ((Number(cost_rate_after_scheme)) - (Number(free_amount)));
        $(this).find("#cost_rate_" + product_id).html(costpriceafter_freeamt.toFixed(decimalpoints_forview));
        var cost_rate_fn = $(this).find("#cost_rate_" + product_id).html();
        var costgst = $(this).find("#gst_percent_" + product_id).html();
        var costgstamt = (Number(cost_rate_fn) * Number(costgst) / Number(100));
        $(this).find("#gst_amount_" + product_id).html(costgstamt.toFixed(decimalpoints_forview));
        var sellingprice = $(this).find("#sell_price_" + product_id).html();
        var cost_price = $(this).find("#cost_rate_" + product_id).html();
        var extracharge = $(this).find("#extra_charge_" + product_id).html();
        var cost_rate = ((Number(cost_price)) + (Number(extracharge))).toFixed(decimalpoints_forview);
        var profitamt = ((Number(sellingprice)) - (Number(cost_rate)));
        $(this).find("#profit_amount_" + product_id).html(profitamt.toFixed(decimalpoints_forview));
        var profitpercent = ((Number(100)) * (Number(profitamt)) / (Number(cost_rate)));
        if (isNaN(profitpercent) == true) {
            profitpercent = 0;
        }
        $(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints_forview));
        if (qty == 0) {
            qty = 1;
        }
        var cost_rate_fnl = $(this).find("#cost_rate_" + product_id).html();
        var totalqty = '';
        if (total_qty_with == 0) {
            totalqty = ((Number(freeqty)) + (Number(qty)));
        } else {
            totalqty = total_qty_with;
        }
        var cost_amt_gst = $(this).find("#gst_amount_" + product_id).html();
        var totalcostval = (((Number(cost_rate_fnl)) + (Number(cost_amt_gst))) * (Number(totalqty)));
        if (total_qty_with != 0 && !isNaN(total_qty_with)) {
            $(this).find("#total_cost_" + product_id).html(totalcostval.toFixed(decimalpoints_forview));
        }
        totalcalculation();
    });
}


$(document).on('keyup','.p_product_qty',function(){
	var product_id	= $(this).attr('id').split('product_qty_')[1];
	var tbl_row		= $(this).closest('tr').data('id');
	setTimeout(function() {
		$("#product_record_sec").find("tr[data-id='" + tbl_row + "']").each(function() {
			if (tbl_row != '' && tbl_row != undefined && tbl_row != 0) {
				var p_qty = Number($(this).find("#product_qty_" + product_id).html());
				if(p_qty>0){
					var freeqty = Number($(this).find("#free_qty_" + product_id).html());
					var gstamount = $(this).find("#gst_amount_" + product_id).html();
					
					if (p_qty == '' || p_qty == 0 || isNaN(p_qty)) {
						p_qty = 1;
					}
					
					var total_qty = (Number(freeqty) + Number(p_qty));
					
					var base_price = $(this).find("#base_price_" + product_id).html();
					var discount_percent = $(this).find("#base_discount_percent_" + product_id).html();
            		var discount_amount = ((Number(base_price) * Number(discount_percent)) / 100);
					$(this).find("#base_discount_amount_" + product_id).html(discount_amount.toFixed(decimalpoints));
					
					var total_cost_rate = (Number(base_price) * Number(total_qty));
					$(this).find("#total_cost_rate_" + product_id).html(total_cost_rate.toFixed(decimalpoints));
					
					var finalcost_rate_afterdiscount = ((Number(base_price)) - (Number(discount_amount)));
					var scheme_percent = $(this).find("#scheme_discount_percent_" + product_id).html();
					var schemeamt = ((Number(finalcost_rate_afterdiscount)) * (Number(scheme_percent)) / (Number(100)));
					$(this).find("#scheme_discount_amount_" + product_id).html(schemeamt.toFixed(decimalpoints));
					
					var finalcost_price_afterscheme = ((Number(finalcost_rate_afterdiscount)) - (Number(schemeamt)));
					$(this).find("#cost_rate_" + product_id).html(finalcost_price_afterscheme.toFixed(decimalpoints));
					
					var finalcost_original_price_afterscheme = $(this).find("#cost_rate_" + product_id).html();
					var freeamtbefore = 0;
					if (total_qty == 0 || isNaN(total_qty)) {
						freeamtbefore = ((Number(finalcost_original_price_afterscheme)) * (Number(p_qty)) / ((Number(p_qty)) + (Number(freeqty))));
					} else {
						freeamtbefore = ((Number(finalcost_original_price_afterscheme)) * (Number(p_qty)) / ((Number(total_qty))));
					}
					
					var free_amount = ((Number(finalcost_original_price_afterscheme)) - (Number(freeamtbefore)));
					if (free_amount == 0) {
						$(this).find("#free_discount_percent_" + product_id).html(0);
					} else {
						var freepercent = (((Number(free_amount)) * (Number(100))) / (Number(finalcost_original_price_afterscheme)));
						$(this).find("#free_discount_percent_" + product_id).html(freepercent.toFixed(decimalpoints));
					}
					
					
					
					$(this).find("#free_discount_amount_" + product_id).html(free_amount.toFixed(decimalpoints));
					var costpriceafterfree = ((Number(finalcost_original_price_afterscheme)) - (Number(free_amount)));
					$(this).find("#cost_rate_" + product_id).html(costpriceafterfree.toFixed(decimalpoints));
					var costprice_free = $(this).find("#cost_rate_" + product_id).html();
					var gst_percent = $(this).find("#gst_percent_" + product_id).html();
					var gstamt = ((Number(costprice_free)) * (Number(gst_percent)) / (Number(100)));
					$(this).find("#gst_amount_" + product_id).html(gstamt.toFixed(decimalpoints));
					var gst_amt_cost = $(this).find("#gst_amount_" + product_id).html();
					
					var total_cost = (((Number(costprice_free)) + (Number(gst_amt_cost))) * (Number(total_qty)));
					var cost_price = $(this).find("#cost_rate_" + product_id).html();
					var extracharge = $(this).find("#extra_charge_" + product_id).html();
					var cost_rate = ((Number(cost_price)) + (Number(extracharge))).toFixed(decimalpoints);
					var sellingprice = $(this).find("#sell_price_" + product_id).html();
					var profitamt = ((Number(sellingprice)) - (Number(cost_rate)));
					$(this).find("#profit_amount_" + product_id).html(profitamt.toFixed(decimalpoints));
					var profitpercent = ((Number(100)) * (Number(profitamt)) / (Number(cost_rate)));
					if (isNaN(profitpercent) == true) {
						profitpercent = 0;
					}
					
					$(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints));
					if (total_qty != 0 && !isNaN(total_qty)) {
						$(this).find("#total_cost_" + product_id).html(total_cost.toFixed(decimalpoints));
					} else {
						$(this).find("#total_cost_" + product_id).html(0.0000);
					}
					
					final_calculation();
				}else{
					toastr.error('Qty should be 0');
				}
				
			}
		});
	}, 500);

});

$(document).on('keyup','.p_free_qty',function(){
	var product_id	= $(this).attr('id').split('free_qty_')[1];
	var tbl_row		= $(this).closest('tr').data('id');
	
	setTimeout(function() {
		$("#product_record_sec").find("tr[data-id='" + tbl_row + "']").each(function() {
			if (tbl_row != '' && tbl_row != undefined && tbl_row != 0) {
				var p_qty = Number($(this).find("#product_qty_" + product_id).html());
				if(p_qty>0){
					var freeqty = Number($(this).find("#free_qty_" + product_id).html());
					var gstamount = $(this).find("#gst_amount_" + product_id).html();
					
					if (p_qty == '' || p_qty == 0 || isNaN(p_qty)) {
						p_qty = 1;
					}
					
					var total_qty = (Number(freeqty) + Number(p_qty));
					
					var base_price = $(this).find("#base_price_" + product_id).html();
					var discount_percent = $(this).find("#base_discount_percent_" + product_id).html();
            		var discount_amount = ((Number(base_price) * Number(discount_percent)) / 100);
					
					var finalcost_rate_afterdiscount = ((Number(base_price)) - (Number(discount_amount)));
					var scheme_percent = $(this).find("#scheme_discount_percent_" + product_id).html();
					var schemeamt = ((Number(finalcost_rate_afterdiscount)) * (Number(scheme_percent)) / (Number(100)));
					$(this).find("#scheme_discount_amount_" + product_id).html(schemeamt.toFixed(decimalpoints));
					
					var finalcost_price_afterscheme = ((Number(finalcost_rate_afterdiscount)) - (Number(schemeamt)));
					var finalcost_original_price_afterscheme = finalcost_price_afterscheme.toFixed(decimalpoints);
					var freeamtbefore = 0;
					if (total_qty == 0 || isNaN(total_qty)) {
						freeamtbefore = ((Number(finalcost_original_price_afterscheme)) * (Number(p_qty)) / ((Number(p_qty)) + (Number(freeqty))));
					} else {
						freeamtbefore = ((Number(finalcost_original_price_afterscheme)) * (Number(p_qty)) / ((Number(total_qty))));
					}
					
					var free_amount = ((Number(finalcost_original_price_afterscheme)) - (Number(freeamtbefore)));
            		var freepercent = (((Number(free_amount)) * (Number(100))) / (Number(finalcost_price_afterscheme)));
					
					$(this).find("#free_discount_amount_" + product_id).html(free_amount.toFixed(decimalpoints));
            		$(this).find("#free_discount_percent_" + product_id).html(freepercent.toFixed(decimalpoints));
					
					final_calculation();
				}else{
					toastr.error('Qty should not be less than 0');
				}
				
			}
		});
	}, 1000);

});

/*$(document).on('keyup','.p_free_qty',function(){
	var product_id	= $(this).attr('id').split('free_qty_')[1];
	var tbl_row		= $(this).closest('tr').data('id');
	
	setTimeout(function() {
		$("#product_record_sec").find("tr[data-id='" + tbl_row + "']").each(function() {
			if (tbl_row != '' && tbl_row != undefined && tbl_row != 0) {
				var p_qty = Number($(this).find("#product_qty_" + product_id).html());
				if(p_qty>0){
					var freeqty = Number($(this).find("#free_qty_" + product_id).html());
					var gstamount = $(this).find("#gst_amount_" + product_id).html();
					
					if (p_qty == '' || p_qty == 0 || isNaN(p_qty)) {
						p_qty = 1;
					}
					
					var total_qty = (Number(freeqty) + Number(p_qty));
					
					var base_price = $(this).find("#base_price_" + product_id).html();
					var discount_percent = $(this).find("#base_discount_percent_" + product_id).html();
            		var discount_amount = ((Number(base_price) * Number(discount_percent)) / 100);
					$(this).find("#base_discount_amount_" + product_id).html(discount_amount.toFixed(decimalpoints));
					
					//var total_cost_rate = (Number(base_price) * Number(total_qty));
					//$(this).find("#total_cost_rate_" + product_id).html(total_cost_rate.toFixed(decimalpoints));
					
					var finalcost_rate_afterdiscount = ((Number(base_price)) - (Number(discount_amount)));
					var scheme_percent = $(this).find("#scheme_discount_percent_" + product_id).html();
					var schemeamt = ((Number(finalcost_rate_afterdiscount)) * (Number(scheme_percent)) / (Number(100)));
					$(this).find("#scheme_discount_amount_" + product_id).html(schemeamt.toFixed(decimalpoints));
					
					var finalcost_price_afterscheme = ((Number(finalcost_rate_afterdiscount)) - (Number(schemeamt)));
					$(this).find("#cost_rate_" + product_id).html(finalcost_price_afterscheme.toFixed(decimalpoints));
					
					var finalcost_original_price_afterscheme = $(this).find("#cost_rate_" + product_id).html();
					var freeamtbefore = 0;
					if (total_qty == 0 || isNaN(total_qty)) {
						freeamtbefore = ((Number(finalcost_original_price_afterscheme)) * (Number(p_qty)) / ((Number(p_qty)) + (Number(freeqty))));
					} else {
						freeamtbefore = ((Number(finalcost_original_price_afterscheme)) * (Number(p_qty)) / ((Number(total_qty))));
					}
					
					var free_amount = ((Number(finalcost_original_price_afterscheme)) - (Number(freeamtbefore)));
            		var freepercent = (((Number(free_amount)) * (Number(100))) / (Number(finalcost_price_afterscheme)));
					
					$(this).find("#free_discount_amount_" + product_id).html(free_amount.toFixed(decimalpoints));
            		$(this).find("#free_discount_percent_" + product_id).html(freepercent.toFixed(decimalpoints));
					
					var costpriceafterfree = ((Number(finalcost_original_price_afterscheme)) - (Number(free_amount)));
					$(this).find("#cost_rate_" + product_id).html(costpriceafterfree.toFixed(decimalpoints));
					var costprice_free = $(this).find("#cost_rate_" + product_id).html();
					var gst_percent = $(this).find("#gst_percent_" + product_id).html();
					var gstamt = ((Number(costprice_free)) * (Number(gst_percent)) / (Number(100)));
					$(this).find("#gst_amount_" + product_id).html(gstamt.toFixed(decimalpoints));
					var gst_amt_cost = $(this).find("#gst_amount_" + product_id).html();
					
					var total_cost = (((Number(costprice_free)) + (Number(gst_amt_cost))) * (Number(total_qty)));
					var cost_price = $(this).find("#cost_rate_" + product_id).html();
					var extracharge = $(this).find("#extra_charge_" + product_id).html();
					var cost_rate = ((Number(cost_price)) + (Number(extracharge))).toFixed(decimalpoints);
					var sellingprice = $(this).find("#sell_price_" + product_id).html();
					var profitamt = ((Number(sellingprice)) - (Number(cost_rate)));
					$(this).find("#profit_amount_" + product_id).html(profitamt.toFixed(decimalpoints));
					var profitpercent = ((Number(100)) * (Number(profitamt)) / (Number(cost_rate)));
					if (isNaN(profitpercent) == true) {
						profitpercent = 0;
					}
					
					$(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints));
					if (total_qty != 0 && !isNaN(total_qty)) {
						$(this).find("#total_cost_" + product_id).html(total_cost.toFixed(decimalpoints));
					} else {
						$(this).find("#total_cost_" + product_id).html(0.0000);
					}
					
					final_calculation();
				}else{
					toastr.error('Qty should not be less than 0');
				}
				
			}
		});
	}, 1000);

});*/

function final_calculation() {
    $("#qty_total").html('0');
    $("#gross_amount").html('₹0');
    $("#tax_amount").html('');
	$("#sub_total").html('');
	
    var qty_total 		= 0;
    var gross_amount 	= 0;
    var tax_amount 		= 0;
    var total_cost 		= 0;
	
	$("#product_record_sec tr").each(function(index, e) {
        var product_id = $(this).attr('id').split('product_')[1];
        var tbl_row = $(this).data('id');
        $(this).find('td').each(function() {
			if ($(this).attr('id') == "total_cost_rate_" + product_id) {
				var cost_rate_val = $(this).html();
				if ($.isNumeric(cost_rate_val)) {
					gross_amount += (Number(cost_rate_val));	
                }
			}
			if ($(this).attr('id') == "total_cost_" + product_id) {
                var totalcostval = $(this).html();
                if ($.isNumeric(totalcostval)) {
                    total_cost += (Number(totalcostval));
                }
            }
			if ($(this).attr('id') == "product_qty_" + product_id || $(this).attr('id') == "free_qty_" + product_id) {
				var totalqty = $(this).html();
				if (totalqty == '') {
                    totalqty = 0;
				}
				qty_total += (Number(totalqty));
            }
        });
    });
	
    //var finalcost = (total_cost.toFixed(decimalpoints));
    var gross_amount 	= (gross_amount.toFixed(decimalpoints));	
	var sub_total		= (total_cost.toFixed(decimalpoints));
	
	var tax_amount 		= ((Number(sub_total)) - (Number(gross_amount)));
		tax_amount		= (tax_amount.toFixed(decimalpoints));
	
	$("#qty_total").html(qty_total);
	$("#gross_amount").html('₹'+gross_amount);
	$("#tax_amount").html('₹'+tax_amount);
	$("#sub_total").html('₹'+sub_total);
}

function offerprice(obj) {
    var product_id = $(obj).attr('id').split('offer_price_')[1];
    var tbl_row = $(obj).closest('tr').data('id');
    $("#product_detail_record").find("tr[data-id='" + tbl_row + "']").each(function() {
        var offerprice = $(this).find("#offer_price_" + product_id).html();
        var sellinggstpercent = $(this).find("#selling_gst_percent_" + product_id).html();
        var x = ((Number(offerprice)) * (Number(sellinggstpercent)));
        var y = ((Number(100)) + Number(sellinggstpercent));
        var sellgstamt = ((Number(x)) / (Number(y)));
        $(this).find("#selling_gst_amount_" + product_id).html(sellgstamt.toFixed(decimalpoints_forview));
        var sellingpercentage = (((Number(100)) * (Number(sellgstamt))) / (Number(offerprice)));
        var sellingprice = ((Number(offerprice) - (Number(sellgstamt))));
        $(this).find("#sell_price_" + product_id).html(sellingprice.toFixed(decimalpoints_forview));
        var cost_price = $(this).find("#cost_rate_" + product_id).html();
        var extracharge = $(this).find("#extra_charge_" + product_id).html();
        var cost_rate = ((Number(cost_price)) + (Number(extracharge))).toFixed(decimalpoints_forview);
        var selling_price = $(this).find("#sell_price_" + product_id).html();
        var profitamt = ((Number(selling_price)) - (Number(cost_rate)));
        $(this).find("#profit_amount_" + product_id).html(profitamt.toFixed(decimalpoints_forview));
        var profitpercent = ((Number(100)) * (Number(profitamt)) / (Number(cost_rate)));
        if (isNaN(profitpercent) == true) {
            profitpercent = 0;
        }
        $(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints_forview));
    });
}

function costgstpercent(obj) {
    var product_id = $(obj).attr('id').split('gst_percent_')[1];
    var tbl_row = $(obj).closest('tr').data('id');
    $("#product_detail_record").find("tr[data-id='" + tbl_row + "']").each(function() {
        var costrate = $(this).find("#cost_rate_" + product_id).html();
        var gstpercent = $(this).find("#gst_percent_" + product_id).html();
        var gstamount = ((Number(costrate)) * (Number(gstpercent)) / Number(100));
        $(this).find("#gst_amount_" + product_id).html(gstamount.toFixed(decimalpoints_forview));
        var finaltotalcost = ((Number(costrate)) + (Number(gstamount))).toFixed(decimalpoints_forview);
        var product_qty = $(this).find("#product_qty_" + product_id).html();
        var free_qty = $(this).find("#free_qty_" + product_id).html();
        var total_qty = ((Number(product_qty)) + (Number(free_qty)));
        var totalcostval = ((Number(total_qty)) * (Number(finaltotalcost)));
        if (total_qty != 0) {
            $(this).find("#total_cost_" + product_id).html(totalcostval.toFixed(decimalpoints_forview));
        }
        totalcalculation();
    });
}

function sellinggstpercent(obj) {
    var product_id = $(obj).attr('id').split('selling_gst_percent_')[1];
    var tbl_row = $(obj).closest('tr').data('id');
    $("#product_detail_record").find("tr[data-id='" + tbl_row + "']").each(function() {
        var sellinggstpercent = $(this).find("#selling_gst_percent_" + product_id).html();
        var offer_price = $(this).find("#offer_price_" + product_id).html();
        var sellprice = $(this).find("#sell_price_" + product_id).html();
        var sellingamiunt = (((Number(offer_price)) * (Number(sellinggstpercent))) / ((Number(100)) + Number(sellinggstpercent)));
        $(this).find("#selling_gst_amount_" + product_id).html(sellingamiunt.toFixed(decimalpoints_forview));
        var selling_amt = $(this).find("#selling_gst_amount_" + product_id).html();
        var selling_price = ((Number(offer_price)) - (Number(selling_amt)));
        $(this).find("#sell_price_" + product_id).html(selling_price.toFixed(decimalpoints_forview));
        var sellingprice = $(this).find("#sell_price_" + product_id).html();
        var costprice = $(this).find("#cost_rate_" + product_id).html();
        var extracharge = $(this).find("#extra_charge_" + product_id).html();
        var cost_rate = ((Number(costprice)) + (Number(extracharge))).toFixed(decimalpoints_forview);
        var profitamt = ((Number(sellingprice)) - (Number(cost_rate)));
        $(this).find("#profit_amount_" + product_id).html(profitamt.toFixed(decimalpoints_forview));
        var profitpercent = ((Number(100)) * (Number(profitamt)) / (Number(cost_rate)));
        if (isNaN(profitpercent) == true) {
            profitpercent = 0;
        }
        $(this).find("#profit_percent_" + product_id).html(profitpercent.toFixed(decimalpoints_forview));
    });
}