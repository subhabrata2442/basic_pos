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
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="sup_code" class="form-label">Supplier Name</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_company_name" name="supplier_company_name" value="{{ old('supplier_company_name') }}" required autocomplete="off">
                    @error('supplier_company_name')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="sup_code" class="form-label">Supplier Owner Name</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_owner_name" name="supplier_owner_name" value="{{ old('supplier_owner_name') }}" required autocomplete="off">
                    @error('supplier_owner_name')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="sup_code" class="form-label">Address Line 1</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_address1" name="supplier_address1" value="{{ old('supplier_address1') }}"  autocomplete="off">
                    @error('supplier_address1')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="sup_code" class="form-label">Address Line 2</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_address2" name="supplier_address2" value="{{ old('supplier_address2') }}"  autocomplete="off">
                    @error('supplier_address2')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="supplier_company_area" class="form-label">Landmark / Area</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_company_area" name="supplier_company_area" value="{{ old('supplier_company_area') }}"  autocomplete="off">
                    @error('supplier_company_area')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="supplier_company_zipcode" class="form-label">Pin / Zip Code</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_company_zipcode" name="supplier_company_zipcode" value="{{ old('supplier_company_zipcode') }}" autocomplete="off">
                    @error('supplier_company_zipcode')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="supplier_country_id" class="form-label">Country</label>
                  </li>
                  <li class="vall">
                    <select name="supplier_country_id" id="supplier_country_id" class="form-control form-inputtext">
                      <option value="">Select Country</option>
                      <option selected="" value="102">India</option>
                    </select>
                    @error('supplier_country_id')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label class="form-label">Phone No</label>
                  </li>
                  <li class="vall">
                    <input type="text" maxlength="100" name="supplier_company_mobile_no" id="supplier_company_mobile_no" value="" class="form-control form-inputtext" placeholder="" >
                  </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="email" class="form-label">Email</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_email" name="supplier_email" value="{{ old('supplier_email') }}" autocomplete="off">
                    @error('supplier_email')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="email" class="form-label">Business Type</label>
                  </li>
                  <li class="vall">
                    <select name="supplier_business_type" id="supplier_business_type" class="form-control form-inputtext">
                      <option value="">Select Type</option>
                      <option value="registered">Registered</option>
                      <option value="unregistered">Unregistered</option>
                    </select>
                    @error('supplier_business_type')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="supplier_gstin_no" class="form-label">GSTIN Number</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_gstin_no" name="supplier_gstin_no" value="{{ old('supplier_gstin_no') }}" autocomplete="off">
                    @error('supplier_gstin_no')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="email" class="form-label">PAN Number</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_pan_no" name="supplier_pan_no" value="{{ old('supplier_pan_no') }}" autocomplete="off">
                    @error('supplier_pan_no')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="supplier_state_id" class="form-label">State</label>
                  </li>
                  <li class="vall">
                    <select name="supplier_state_id" id="supplier_state_id" class="form-control form-inputtext">
                      <option value="">Select State</option>
                      <option value="19" selected="" >West Bengal</option>
                    </select>
                    @error('supplier_state_id')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
              <div class="form-group">
                <ul class="row mdForm align-items-center">
                  <li class="inf">
                    <label for="supplier_state_id" class="form-label">City</label>
                  </li>
                  <li class="vall">
                    <input type="text" class="form-control admin-input" id="supplier_company_city" name="supplier_company_city" value="{{ old('supplier_company_city') }}" autocomplete="off">
                    @error('supplier_company_city')
                    <div class="error admin-error">{{ $message }}</div>
                    @enderror </li>
                </ul>
              </div>
            </div>
            <div class="col-12">
              <div class="advanceDetails"> <a href="javascript:;" class="advDetsBtn" id="supplier_additional_details_btn">Supplier additional Details</a> </div>
            </div>
            <div class="hideArea p-0" id="supplier_additional_details_sec" style="display:none">
              <div class="hideAreaInner d-flex flex-wrap">
                <div class="col-6">
                  <div class="form-group">
                    <ul class="row mdForm align-items-center">
                      <li class="inf">
                        <label for="email" class="form-label">Alternet Phone Number</label>
                      </li>
                      <li class="vall">
                        <input type="text" maxlength="100" name="alternet_phone[]" id="alternet_phone[]" value="" class="form-control form-inputtext" placeholder="" >
                      </li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <ul class="row mdForm align-items-center">
                      <li class="inf">
                        <label for="email" class="form-label">Alternet Email ID</label>
                      </li>
                      <li class="vall">
                        <input type="text" maxlength="100" name="alternet_email[]" id="alternet_email[]" value="" class="form-control form-inputtext" placeholder="" >
                      </li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <ul class="row mdForm align-items-center">
                      <li class="inf">
                        <label for="email" class="form-label">Website</label>
                      </li>
                      <li class="vall">
                        <input type="text" maxlength="100" name="supplier_website" id="supplier_website" value="" class="form-control form-inputtext" placeholder="" >
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <ul class="row mdForm align-items-center">
                      <li class="inf">
                        <label class="form-label">Bank Name</label>
                      </li>
                      <li class="vall">
                        <input type="text" maxlength="100" name="supplier_bank_name[]" id="supplier_bank_name" value="" class="form-control form-inputtext" placeholder="" >
                      </li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <ul class="row mdForm align-items-center">
                      <li class="inf">
                        <label class="form-label">Bank Account No.</label>
                      </li>
                      <li class="vall">
                        <input type="text" maxlength="20" name="supplier_bank_account_no[]" id="supplier_bank_account_no" value="" class="form-control form-inputtext number" placeholder="" >
                      </li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <ul class="row mdForm align-items-center">
                      <li class="inf">
                        <label class="form-label">Bank IFSC Code</label>
                      </li>
                      <li class="vall">
                        <input type="text" maxlength="11" name="supplier_bank_ifsc_code[]" id="supplier_bank_ifsc_code" value="" class="form-control form-inputtext" placeholder="" >
                      </li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <ul class="row mdForm align-items-center">
                      <li class="inf">
                        <label class="form-label">Branch Name</label>
                      </li>
                      <li class="vall">
                        <input type="text" maxlength="11" name="supplier_bank_branch_name[]" id="supplier_bank_branch_name" value="" class="form-control form-inputtext" placeholder="" >
                      </li>
                    </ul>
                  </div>
                </div>
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

$(document).on('click','#supplier_additional_details_btn',function(){
	 $('#supplier_additional_details_sec').toggle();
});

$(document).ready(function() {
    $("#supplier-form").validate({
        rules: {
            supplier_company_name: "required",
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
});


</script> 
@endsection 