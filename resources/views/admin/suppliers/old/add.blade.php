@extends('layouts.admin')
@section('admin-content')
    <form method="post" action="{{ route('admin.supplier.add') }}" class="needs-validation" id="supplier-form" novalidate enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body greybg">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="sup_code" class="form-label">Supplier Name</label>
                    <input type="text" class="form-control admin-input" id="supplier_company_name" name="supplier_company_name" value="{{ old('supplier_company_name') }}" required autocomplete="off">
                    @error('supplier_company_name')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control admin-input" id="supplier_email" name="supplier_email" value="{{ old('supplier_email') }}" required autocomplete="off">
                    @error('supplier_email')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="sup_name" class="form-label">First Name</label>
                    <input type="text" class="form-control admin-input" id="supplier_first_name" name="supplier_first_name" value="{{ old('supplier_first_name') }}" required autocomplete="off">
                    @error('supplier_first_name')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone" class="form-label">Last Name / Surname</label>
                    <input type="text" class="form-control admin-input" id="supplier_last_name" name="supplier_last_name" value="{{ old('supplier_last_name') }}" required autocomplete="off">
                    @error('supplier_last_name')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="supplier_phone" class="form-label">Phone No</label>
                    <input type="text" class="form-control admin-input" id="supplier_phone" name="supplier_phone" value="{{ old('supplier_phone') }}" required autocomplete="off">
                    @error('supplier_phone')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="supplier_business_type" class="form-label">Business Type</label>
                    <select name="supplier_business_type" id="supplier_business_type" class="form-control form-inputtext">
                      <option value="">Select Type</option>
                      <option value="registered">Registered</option>
                      <option value="unregistered">Unregistered</option>
                    </select>
                    @error('supplier_business_type')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="supplier_registered_state_id" class="form-label">Business Registered State</label>
                    <select name="supplier_registered_state_id" id="supplier_registered_state_id" class="form-control form-inputtext">
                      <option value="">Select State</option>
                      <option value="19" selected="" >West Bengal</option>
                    </select>
                    @error('supplier_registered_state_id')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body greybg">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="supplier_address1" class="form-label">Shop no.,Building,Street etc.</label>
                    <input type="text" class="form-control admin-input" id="supplier_address1" name="supplier_address1" value="{{ old('supplier_address1') }}" required autocomplete="off">
                    @error('supplier_address1')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="supplier_address2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control admin-input" id="supplier_address2" name="supplier_address2" value="{{ old('supplier_address2') }}" autocomplete="off">
                    @error('supplier_address2')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="supplier_company_area" class="form-label">Area / Landmark</label>
                    <input type="text" class="form-control admin-input" id="supplier_company_area" name="supplier_company_area" value="{{ old('supplier_company_area') }}" required autocomplete="off">
                    @error('supplier_company_area')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="supplier_company_zipcode" class="form-label">Pin / Zip Code</label>
                    <input type="text" class="form-control admin-input" id="supplier_company_zipcode" name="supplier_company_zipcode" value="{{ old('supplier_company_zipcode') }}" required autocomplete="off">
                    @error('supplier_company_zipcode')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="supplier_country_id" class="form-label">Country</label>
                    <select name="supplier_country_id" id="supplier_country_id" class="form-control form-inputtext">
                      <option value="">Select Country</option>
                      <option selected="" value="102">India</option>
                    </select>
                    @error('supplier_country_id')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="supplier_state_id" class="form-label">State</label>
                    <select name="supplier_state_id" id="supplier_state_id" class="form-control form-inputtext">
                      <option value="">Select State</option>
                      <option value="19" selected="" >West Bengal</option>
                    </select>
                    @error('supplier_state_id')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="supplier_company_city" class="form-label">City / Town</label>
                    <input type="text" class="form-control admin-input" id="supplier_company_city" name="supplier_company_city" value="{{ old('supplier_company_city') }}" required autocomplete="off">
                    @error('supplier_company_city')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="supplier_pan_no" class="form-label">PAN</label>
                    <input type="text" class="form-control admin-input" id="supplier_pan_no" name="supplier_pan_no" value="{{ old('supplier_pan_no') }}" required autocomplete="off">
                    @error('supplier_pan_no')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                
                
                <div class="col-md-4" id="supplier_gstin_no_sec">
                  <div class="form-group">
                    <label for="supplier_gstin_no" class="form-label">GSTIN Number</label>
                    <input type="text" class="form-control admin-input" id="supplier_gstin_no" name="supplier_gstin_no" value="{{ old('supplier_gstin_no') }}" required autocomplete="off">
                    @error('supplier_gstin_no')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="supplier_supply_place" class="form-label">Place of Supply</label>
                    <input type="text" class="form-control admin-input" id="supplier_supply_place" name="supplier_supply_place" value="{{ old('supplier_supply_place') }}" required autocomplete="off">
                    @error('supplier_supply_place')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body greybg">
              <h5 class="hk-sec-title">Supplier additional Details</h5>
              <div id="repeat_bank">
                <div class="row repeatArea" id="new_bank_1">
                <div class="col-md-4">
                    <label class="form-label">Alternate Phone Number</label>
                    <input type="text" maxlength="100" name="supplier_bank_name[]" id="supplier_bank_name" value="" class="form-control form-inputtext" placeholder="" >
                  </div>
                  
                  <div class="col-md-4">
                    <label class="form-label">Alternate Email ID</label>
                    <input type="text" maxlength="100" name="supplier_bank_name[]" id="supplier_bank_name" value="" class="form-control form-inputtext" placeholder="" >
                  </div>
                  
                  <div class="col-md-4">
                    <label class="form-label">Website Address</label>
                    <input type="text" maxlength="100" name="supplier_bank_name[]" id="supplier_bank_name" value="" class="form-control form-inputtext" placeholder="" >
                  </div>
                  
                  <div class="col-md-4">
                    <label class="form-label">Bank Name</label>
                    <input type="text" maxlength="100" name="supplier_bank_name[]" id="supplier_bank_name" value="" class="form-control form-inputtext" placeholder="" >
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Bank Account Name</label>
                    <input type="text" maxlength="100" name="supplier_bank_account_name[]" id="supplier_bank_account_name" value="" class="form-control form-inputtext" placeholder="" >
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Bank Account No.</label>
                    <input type="text" maxlength="20" name="supplier_bank_account_no[]" id="supplier_bank_account_no" value="" class="form-control form-inputtext number" placeholder="" >
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Bank IFSC Code</label>
                    <input type="text" maxlength="11" name="supplier_bank_ifsc_code[]" id="supplier_bank_ifsc_code" value="" class="form-control form-inputtext" placeholder="" >
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
@endsection

@section('scripts') 
<script src="{{ url('assets/admin/js/supplier.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
$(document).ready(function() {
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
                url: "{{ route('admin.supplier.add') }}",
                dataType: 'json',
                data: formData,
                success: function(data) {
                    if (data[0].success == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Supplier Created successfully',
                            showConfirmButton: false,
                            timer: 2500
                        });
						window.location.replace("{{ route('admin.supplier.list') }}");
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data[0].error_message,
                        })
                        //alert(data[0].error_message);
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

    $("[name^=child_name]").each(function() {
        $(this).rules("add", {
            required: true
        });
    });

    /*$("[name^=child_birthday]").each(function() {
        $(this).rules("add", {
            required: true
        });
    });
    $("[name^=child_grade]").each(function() {
        $(this).rules("add", {
            required: true
        });
    });
    $("[name^=child_class_type_desc]").each(function() {
        $(this).rules("add", {
            required: true
        });
    });

    $("[name^=child_classes_desc]").each(function() {
        $(this).rules("add", {
            required: true
        });
    });*/

    /*$("[name^=child_class_type]").each(function() {
        $(this).rules("add", {
            required: true,
            checkValue: true
        });
    });*/


    /*$("input.referencePhone").each(function(){
            $(this).rules("add", {
                required: true,
                minlength: 10,
                messages: {
                    required: "Specify your reference phone number",
                    minlength: "Not long enough"
                }
            } );            
        });*/

    /*$.validator.addMethod("checkValue", function (value, element) {
            var response = ((value > 0) && (value <= 100)) || ((value == 'test1') || (value == 'test2'));
            return response;
        }, "invalid value");	*/

});


</script> 
@endsection 