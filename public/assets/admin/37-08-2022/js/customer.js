$(document).on('click', '#cust_child_plus', function(){
	var count 	= $('#repeat_child .add_child_repeat_sec').length;
	var id		= count+1;
	
	var html_contactplus = '';
	html_contactplus += '<div class="row add_child_repeat_sec repeatArea" id="child_'+id+'"><div class="col-md-3"><label class="form-label">Children Name</label><input type="text" maxlength="100" name="child_name[]" value="" class="form-control form-inputtext" placeholder="" ></div><div class="col-md-3"><label class="form-label">Children Birth Date</label><input type="text" maxlength="100" name="child_date_of_birth[]" value="" class="form-control form-inputtext" placeholder=""></div><div class="col-md-3"><a href="javascript:;" class="delete_btn" id="remove_child_'+id+'" onclick="remove_child_row('+id+');" data-id="'+id+'">X</a></div></div>';
	$("#repeat_child").append(html_contactplus);
});

function remove_child_row(removeid){
	$("#child_"+removeid).remove();
}