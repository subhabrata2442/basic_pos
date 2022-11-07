@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <form method="post" action="{{ route('admin.supplier.edit', [base64_encode($data['supplier']->id)]) }}" class="needs-validation" id="supplier-form" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="span10 offset1">
            <div class="well">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body greybg">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="sup_code" class="form-label">Company Name</label>
                          <input type="text" class="form-control admin-input" id="supplier_company_name" name="supplier_company_name" value="{{ old('sup_code', $data['supplier']->company_name) }}" required autocomplete="off">
                          @error('supplier_company_name')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control admin-input" id="supplier_email" name="supplier_email" value="{{ old('email', $data['supplier']->email) }}" required autocomplete="off">
                          @error('supplier_email')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="sup_name" class="form-label">First Name</label>
                          <input type="text" class="form-control admin-input" id="supplier_first_name" name="supplier_first_name" value="{{ old('first_name', $data['supplier']->first_name) }}" required autocomplete="off">
                          @error('supplier_first_name')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone" class="form-label">Last Name / Surname</label>
                          <input type="text" class="form-control admin-input" id="supplier_last_name" name="supplier_last_name" value="{{ old('last_name', $data['supplier']->last_name) }}" required autocomplete="off">
                          @error('supplier_last_name')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="notes" class="form-label">Notes</label>
                          <textarea name="notes" rows="3" id="notes" class="form-control admin-textarea ">{{ old('notes', $data['supplier']->notes) }}</textarea>
                          @error('notes')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="supplier_due_days" class="form-label">Due Days</label>
                          <input type="text" class="form-control admin-input" id="supplier_due_days" name="supplier_due_days" value="{{ old('due_days', $data['supplier']->due_days) }}" required autocomplete="off">
                          @error('supplier_due_days')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="supplier_due_date" class="form-label">Due Date</label>
                          <input type="text" class="form-control admin-input" id="supplier_due_date" name="supplier_due_date" value="{{ old('due_date', $data['supplier']->due_date) }}" required autocomplete="off">
                          @error('supplier_due_date')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="span10 offset1">
            <div class="well">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body greybg">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="supplier_address1" class="form-label">Shop no.,Building,Street etc.</label>
                          <input type="text" class="form-control admin-input" id="supplier_address1" name="supplier_address1" value="{{ old('address', $data['supplier']->address) }}" required autocomplete="off">
                          @error('supplier_address1')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="supplier_address2" class="form-label">Address Line 2</label>
                          <input type="text" class="form-control admin-input" id="supplier_address2" name="supplier_address2" value="{{ old('supplier_address2', $data['supplier']->supplier_address2) }}" required autocomplete="off">
                          @error('supplier_address2')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="supplier_company_area" class="form-label">Area</label>
                          <input type="text" class="form-control admin-input" id="supplier_company_area" name="supplier_company_area" value="{{ old('area', $data['supplier']->area) }}" required autocomplete="off">
                          @error('supplier_company_area')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="supplier_company_zipcode" class="form-label">Pin / Zip Code</label>
                          <input type="text" class="form-control admin-input" id="supplier_company_zipcode" name="supplier_company_zipcode" value="{{ old('pin', $data['supplier']->pin) }}" required autocomplete="off">
                          @error('supplier_company_zipcode')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="supplier_company_city" class="form-label">City / Town</label>
                          <input type="text" class="form-control admin-input" id="supplier_company_city" name="supplier_company_city" value="{{ old('city', $data['supplier']->city) }}" required autocomplete="off">
                          @error('supplier_company_city')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="supplier_state_id" class="form-label">State</label>
                          <select name="supplier_state_id" id="supplier_state_id" class="form-control form-inputtext">
                            <option value="19" selected="" >West Bengal</option>
                          </select>
                          @error('supplier_state_id')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="supplier_country_id" class="form-label">Country</label>
                          <select name="supplier_country_id" id="supplier_country_id" class="form-control form-inputtext">
                            <option selected="" value="102">India</option>
                          </select>
                          @error('supplier_country_id')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="supplier_pan_no" class="form-label">PAN</label>
                          <input type="text" class="form-control admin-input" id="supplier_pan_no" name="supplier_pan_no" value="{{ old('pan', $data['supplier']->pan) }}" required autocomplete="off">
                          @error('supplier_pan_no')
                          <div class="error admin-error">{{ $message }}</div>
                          @enderror </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="span10 offset1">
            <div class="well">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body greybg">
                    <h5 class="hk-sec-title">Add Phone No <a href="javascript:;" id="companymobileplus"><i class="fa fa-plus"></i></a></h5>
                    <div id="repeat_companymobile">
                     @if(count($data['supplierMobile'])>0)
                     @php($count=0)
                     @foreach($data['supplierMobile'] as $mRow)
                      <div class="col-md-12 add_mobile_repeat_sec" id="add_mobile_sec_{{$count}}">
                        <label class="form-label">Phone No</label>
                        <input type="text" maxlength="100" name="supplier_company_mobile_no[]" id="supplier_company_mobile_no_1" value="{{$mRow->mobile}}" class="form-control form-inputtext" placeholder="" >
                        
                        <input type="hidden" name="supplier_company_dial_code[]" id="supplier_company_dial_code_{{$count}}" value="{{$mRow->dial_code}}">
                        @if($count!=0)
                        <a href="javascript:;" id="remove_mobile_{{$count}}" onclick="remove_companymobile_row('{{$count}}');" data-id='{{$count}}'>X</a>
                        @endif
                      </div>
                      
                     @php($count++)
                     @endforeach
                      @else
                      <div class="col-md-12 add_mobile_repeat_sec" id="add_mobile_sec_1">
                        <label class="form-label">Phone No</label>
                        <input type="text" maxlength="100" name="supplier_company_mobile_no[]" id="supplier_company_mobile_no_1" value="" class="form-control form-inputtext" placeholder="" >
                      </div>
                     @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="span10 offset1">
            <div class="well">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body greybg">
                    <h5 class="hk-sec-title">Supplier Banks<a href="javascript:;" id="bankplus"><i class="fa fa-plus"></i></a></h5>
                    <div id="repeat_bank">
                    @if(count($data['supplierBank'])>0)
                    @php($count=0)
                    @foreach($data['supplierBank'] as $bRow)
                      <div class="row" id="new_bank_{{$count}}">
                        <div class="col-md-3">
                          <label class="form-label">Bank Name</label>
                          <input type="text" maxlength="100" name="supplier_bank_name[]" id="supplier_bank_name" value="{{$bRow->bank_name}}" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Bank Account Name</label>
                          <input type="text" maxlength="100" name="supplier_bank_account_name[]" id="supplier_bank_account_name" value="{{$bRow->account_name}}" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Bank Account No.</label>
                          <input type="text" maxlength="20" name="supplier_bank_account_no[]" id="supplier_bank_account_no" value="{{$bRow->bank_account_no}}" class="form-control form-inputtext number" placeholder="" >
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Bank IFSC Code</label>
                          <input type="text" maxlength="11" name="supplier_bank_ifsc_code[]" id="supplier_bank_ifsc_code" value="{{$bRow->bank_ifsc_code}}" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <input type="hidden" name="supplier_bank_id[]" value="{{$bRow->id }}">
                         @if($count!=0)
                        <a href="javascript:;" id="remove_bank_{{$count}}" onclick="remove_bank_row('{{$count}}');" data-id='{{$count}}'>X</a>
                        @endif
                      </div>
                    @php($count++)
                    @endforeach
                    @else
                      <div class="row" id="new_bank_1">
                        <div class="col-md-3">
                          <label class="form-label">Bank Name</label>
                          <input type="text" maxlength="100" name="supplier_bank_name[]" id="supplier_bank_name" value="" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Bank Account Name</label>
                          <input type="text" maxlength="100" name="supplier_bank_account_name[]" id="supplier_bank_account_name" value="" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Bank Account No.</label>
                          <input type="text" maxlength="20" name="supplier_bank_account_no[]" id="supplier_bank_account_no" value="" class="form-control form-inputtext number" placeholder="" >
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Bank IFSC Code</label>
                          <input type="text" maxlength="11" name="supplier_bank_ifsc_code[]" id="supplier_bank_ifsc_code" value="" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <!--<input type="hidden" name="supplier_bank_id" id="supplier_bank_id" value="">--> 
                      </div>
                    @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="span10 offset1">
            <div class="well">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body greybg">
                    <h5 class="hk-sec-title">Supplier GST<a href="javascript:;" id="gstplus"><i class="fa fa-plus"></i></a></h5>
                    <div id="repleat_gst">
                    @if(count($data['supplierGst'])>0)
                    @php($count=0)
                    @foreach($data['supplierGst'] as $gRow)
                      <div class="row" id="new_gst_{{$count}}">
                        <div class="col-md-2">
                          <label class="form-label">Treatment</label>
                          <select id="supplier_treatment_id" name="supplier_treatment_id[]" class="form-control form-inputtext" onchange="showhide_gst(this);">
                            <option value="1" @if ($gRow->treatment_id == 1) selected @endif >Registered Business</option>
                            <option value="2" @if ($gRow->treatment_id == 2) selected @endif>Consumer</option>
                            <option value="3" @if ($gRow->treatment_id == 3) selected @endif>Overseas</option>
                            <option value="4" @if ($gRow->treatment_id == 4) selected @endif>Unregistered Business</option>
                            <option value="5" @if ($gRow->treatment_id == 5) selected @endif>Other</option>
                          </select>
                        </div>
                        <div class="col-md-2" id="supplier_gst" style="display:none;">
                          <label class="form-label">GSTIN</label>
                          <input type="text" onkeyup="getstate(this);" maxlength="15" name="supplier_gstin[]" id="supplier_gstin" value="{{$gRow->gstin}}" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <div class="col-md-1">
                          <label class="form-label">State</label>
                          <select id="state_id" name="state_id[]" class="form-control form-inputtext invalid">
                            <option value="">Select State</option>
                            <option value="1" @if ($gRow->state_id == 1) selected @endif >West Bengal</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">Address</label>
                          <input type="text" maxlength="20" name="supplier_address[]" id="supplier_address" value="{{$gRow->address}}" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">Area</label>
                          <input type="text" maxlength="20" name="supplier_area[]" id="supplier_area" value="{{$gRow->area}}" class="form-control form-inputtext" placeholder="">
                        </div>
                        <div class="col-md-1">
                          <label class="form-label">Zipcode</label>
                          <input type="text" maxlength="20" name="supplier_gst_zipcode[]" id="supplier_gst_zipcode" value="{{$gRow->gst_zipcode}}" class="form-control form-inputtext" placeholder="">
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">City</label>
                          <input type="text" maxlength="20" name="supplier_gst_city[]" id="supplier_gst_city" value="{{$gRow->gst_city}}" class="form-control form-inputtext" placeholder="">
                        </div>
                         <input type="hidden" name="supplier_gst_id[]" value="{{$gRow->id}}">
                        @if($count!=0)
                        <a href="javascript:;" id="remove_gst_{{$count}}" onclick="remove_gst_row('{{$count}}');" data-id='{{$count}}'>X</a>
                        @endif
                       
                      </div>
                    @php($count++)
                     @endforeach
                      @else
                      <div class="row" id="new_gst_1">
                        <div class="col-md-2">
                          <label class="form-label">Treatment</label>
                          <select id="supplier_treatment_id" name="supplier_treatment_id[]" class="form-control form-inputtext" onchange="showhide_gst(this);">
                            <option value="1">Registered Business</option>
                            <option value="2">Consumer</option>
                            <option value="3">Overseas</option>
                            <option value="4">Unregistered Business</option>
                            <option value="5">Other</option>
                          </select>
                        </div>
                        <div class="col-md-2" id="supplier_gst" style="display:none;">
                          <label class="form-label">GSTIN</label>
                          <input type="text" onkeyup="getstate(this);" maxlength="15" name="supplier_gstin[]" id="supplier_gstin" value="" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <div class="col-md-1">
                          <label class="form-label">State</label>
                          <select id="state_id" name="state_id[]" class="form-control form-inputtext invalid">
                            <option value="">Select State</option>
                            <option value="1">West Bengal</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">Address</label>
                          <input type="text" maxlength="20" name="supplier_address[]" id="supplier_address" value="" class="form-control form-inputtext" placeholder="" >
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">Area</label>
                          <input type="text" maxlength="20" name="supplier_area[]" id="supplier_area" value="" class="form-control form-inputtext" placeholder="">
                        </div>
                        <div class="col-md-1">
                          <label class="form-label">Zipcode</label>
                          <input type="text" maxlength="20" name="supplier_gst_zipcode[]" id="supplier_gst_zipcode" value="" class="form-control form-inputtext" placeholder="">
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">City</label>
                          <input type="text" maxlength="20" name="supplier_gst_city[]" id="supplier_gst_city" value="" class="form-control form-inputtext" placeholder="">
                        </div>
                        <!--<input type="hidden" name="supplier_gst_id" id="supplier_gst_id" value="">--> 
                      </div>
                    @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-12">
          <button class="commonBtn-btnTag" type="submit">Submit </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts') 
<script src="{{ url('assets/admin/js/supplier.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
$(document).ready(function () {
$("#supplier-form").validate({
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
        var formData = new FormData($(form)[0]);
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: "{{ route('admin.supplier.edit', [base64_encode($data['supplier']->id)]) }}",
            dataType: 'json',
            data: formData,
            success: function(data) {
                if (data[0].success == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Supplier Updated successfully',
                        showConfirmButton: false,
                        timer: 2500
                    });
					
                } else {
                    alert(data[0].error_message);
                }
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            },
            beforeSend: function() {
                $(".loadingSpan").show();
            },
            complete: function() {
                $(".loadingSpan").hide();
            }
        });
    }
});
 
/*$("[name^=child_name]").each(function() {
    $(this).rules("add", {
        required: true
    });
});*/
	
});

/*$('#category')
         .append($("<option></option>")
                     .attr('selected','selected')
                    .attr("value", 'hiii')
                    .text('hiii'));*/ 


</script> 
@endsection 