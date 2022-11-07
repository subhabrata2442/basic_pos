$(document).on('click', '#companymobileplus', function(){
	var count 	= $('#repeat_companymobile .add_mobile_repeat_sec').length;
	var id		= count+1;
	
	var html_contactplus = '';
	html_contactplus += '<div class="col-md-11 add_mobile_repeat_sec" id="add_mobile_sec_'+id+'"> ' +
        '<label class="form-label">Phone No.</label> ' +
        '<input style="width: 100%;" type="tel" autocomplete="off" name="supplier_company_mobile_no[]" id="supplier_company_mobile_no'+id+'"  value="" maxlength="15" class="form-control form-inputtext mobileregax number" placeholder="">' +
        ' <input type="hidden" name="supplier_company_dial_code[]" id="supplier_company_dial_code_'+id+'" value=""> ' +
        '<a href="javascript:;" id="remove_bank_'+id+'" class="delete_btn" onclick="remove_companymobile_row('+id+');" data-id='+id+'>' +
        'X' +
        '</div></div>';
	$("#repeat_companymobile").append(html_contactplus);
		
	
	/*$("#mobile_"+id).find('.mobileregax').each(function ()
    {
        var idofinput = $(this).attr('id');

        var input = document.querySelector('#mobile_'+id+' #'+idofinput);

        window.intlTelInput(input, {
            initialCountry: "in",
            separateDialCode: true,
            autoPlaceholder: false,
            utilsScript: "{{URL::to('/')}}/public/build/js/utils.js",
        });
    });*/
});

function remove_companymobile_row(removeid){
	$("#add_mobile_sec_"+removeid).remove();
}

$(document).on('click', '#bankplus', function(){
	var count 	= $('#repeat_bank .row').length;
	var id		= count+1;
	var html_bank = '';

    html_bank += '<div class="row repeatArea" id="new_bank_'+id+'">' +
        '<div class="col-md-3"><label class="form-label">Bank Name</label>' +
        '<input type="text" maxlength="100" name="supplier_bank_name[]" id="supplier_bank_name_'+id+'" value="" class="form-control form-inputtext invalid" placeholder=""> </div>' +
        '<div class="col-md-3"> ' +
        '<label class="form-label">Bank Account Name</label>' +
        ' <input type="text" maxlength="100" name="supplier_bank_account_name[]" id="supplier_bank_account_name_'+id+'" value="" class="form-control form-inputtext invalid" placeholder="">' +
        '</div>' +
        '<div class="col-md-3"> <label class="form-label">Bank Account No.</label> ' +
        '<input type="text" maxlength="20" name="supplier_bank_account_no[]" id="supplier_bank_account_no_'+id+'" value="" class="form-control form-inputtext invalid" placeholder="">' +
        '</div>' +
        '<div class="col-md-2"> <label class="form-label">Bank IFSC Code</label>' +
        '<input type="text" maxlength="100" name="supplier_bank_ifsc_code[]" id="supplier_bank_ifsc_code_'+id+'" value="" class="form-control form-inputtext" placeholder=""> </div>' +
        '<div class="col-md-1"><label></label><a href="javascript:;" class="delete_btn" id="remove_bank_'+id+'" onclick="remove_bank_row('+id+');" data-id='+id+'>' +
        'X </a></div> ' +
        '</div>';

    $("#repeat_bank").append(html_bank);
});

function remove_bank_row(removeid){
	$("#new_bank_"+removeid).remove();
}

$(document).on('click', '#gstplus', function(){
	var count 	= $('#repleat_gst .row').length;
	var id		= count+1;
	
	var html = '';
    var state_block = '';
    var tratment_block = '';
	
	
	state_block = '<option value="1">West Bengal</option>';
	
	tratment_block = '<option value="1">Registered Business</option><option value="2">Consumer</option><option value="3">Overseas</option><option value="4">Unregistered Business</option><option value="5">Other</option>';
	
	html += '<div class="row repeatArea"  id="new_gst_'+id+'">' +
        '<div class="col-md-1">' +
        '<label class="form-label">Treatment</label>' +

        '<select id="supplier_treatment_id" name="supplier_treatment_id[]" class="form-control form-inputtext" onchange="showhide_gst(this);" >'+tratment_block+'</select>' +
        '</div>' +

        '<div class="col-md-2" id="supplier_gst"> <label class="form-label">GSTIN</label>' +
        '<input type="text" maxlength="15" onkeyup="getstate(this);" name="supplier_gstin[]" id="supplier_gstin" value="" class="form-control form-inputtext invalid" placeholder="">' +
        '</div>' +

        '<div class="col-md-1"> <label class="form-label">State</label>' +
        '<select name="state_id[]" id="state_id" class="form-control form-inputtext invalid"> <option value="">Select State</option>'+state_block+'</select>' +
        '</div>' +
        '<div class="col-md-2"> ' +
        '<label class="form-label">Address</label> ' +
        '<input type="text" maxlength="255" name="supplier_address[]" id="supplier_address" value="" class="form-control form-inputtext" placeholder=""> </div>' +
        '<div class="col-md-2"> <label class="form-label">Area</label> <input type="text" maxlength="20" name="supplier_area[]" id="supplier_area" value="" class="form-control form-inputtext" placeholder=""> </div>' +
        '<div class="col-md-1"> <label class="form-label">Zipcode</label>' +
        '<input type="text" maxlength="20" name="supplier_gst_zipcode[]" id="supplier_gst_zipcode" value="" class="form-control form-inputtext" placeholder="">' +
        '</div>' +
        '<div class="col-md-2"> <label class="form-label">City</label>' +
        '<input type="text" maxlength="20" name="supplier_gst_city[]" id="supplier_gst_city" value="" class="form-control form-inputtext" placeholder="">' +
        ' </div><div class="col-md-1"><label></label><a href="javascript:;" class="delete_btn" id="remove_gst_'+id+'" onclick="remove_gst_row('+id+');" data-id='+id+'>' +
        'X</a></div> ' +
        '</div>';

    $("#repleat_gst").append(html);

});

function remove_gst_row(removeid){
	$("#new_gst_"+removeid).remove();
}

$(document).on('click', '#contactplus', function(){
	var count 	= $('#repeat_contact .row').length;
	var id		= count+1;
	
	var html_contact = '';
    var saluation_block = '';
	
	saluation_block += '<option value="1">Mr.</option><option value="2">Miss</option><option value="3">Ms.</option><option value="4">Dear.</option>';
	
	html_contact += ' <div class="row repeatArea" id="new_contact_'+id+'"> ' +
        '<div class="col-md-1"> <label class="form-label"></label> ' +
        '   <select id="salutation_id" name="salutation_id[]" class="form-control form-inputtext" >'+saluation_block+'</select> ' +
        '</div><div class="col-md-2"> <label class="form-label">First Name</label> ' +
        '<input type="text" maxlength="100" name="supplier_contact_firstname[]" id="supplier_contact_firstname" value="" class="form-control form-inputtext invalid" placeholder=""> </div>' +
        '<div class="col-md-1"> <label class="form-label">Last Name</label>' +
        ' <input type="text" maxlength="100" name="supplier_contact_lastname[]" id="supplier_contact_lastname" value="" class="form-control form-inputtext" placeholder=""> </div>' +
        '<div class="col-md-1"> <label class="form-label">Designation</label>' +
        ' <input type="text" maxlength="100" name="supplier_contact_designation[]" id="supplier_contact_designation" value="" class="form-control form-inputtext" placeholder=""> </div>' +
        '<div class="col-md-2"> <label class="form-label">Email Id</label> ' +
        '<input type="text" maxlength="100" name="supplier_contact_email_id[]" id="supplier_contact_email_id" value="" class="form-control form-inputtext invalid" placeholder=""> </div>' +
        ' <div class="col-md-1"> <label class="form-label">Date of Birth</label> <input type="text" maxlength="100" name="supplier_date_of_birth[]" id="supplier_date_of_birth" value="" class="form-control form-inputtext" placeholder=""> </div><div class="col-md-2"> ' +
        '<label class="form-label">Mobile No.</label>' +
        ' <input style="width:100%" type="text" maxlength="100" name="supplier_contact_mobile_no[]" id="supplier_contact_mobile_no" value="" class="form-control form-inputtext mobileregax invalid" placeholder=""> <input type="hidden" name="supplier_contact_dial_code" id="supplier_contact_dial_code" value=""> </div>' +
        '<div class="col-md-2"> <label class="form-label">Whatsapp No.</label> ' +
        '<input style="width:100%;" type="text" maxlength="100" name="supplier_whatsapp_no[]" id="supplier_whatsapp_no" value="" class="form-control form-inputtext mobileregax" placeholder="">' +
        '<input type="hidden" name="supplier_whatsapp_dial_code" id="supplier_whatsapp_dial_code" value=""></div>' +
        '<input type="hidden" name="supplier_contact_details_id" id="supplier_contact_details_id" value="">'+
        '<div class="col-md-0"><label></label>' +
        '<a href="javascript:;" id="remove_contact_'+id+'" class="delete_btn" onclick="remove_contact_row('+id+');" data-id='+id+'>X</a></div> ' +
        '</div></div>';
		
		$("#repeat_contact").append(html_contact);
});
function remove_contact_row(removeid)
{
    $("#new_contact_"+removeid).remove();
}