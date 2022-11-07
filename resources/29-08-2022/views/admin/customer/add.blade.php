@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <form method="post" action="{{ route('admin.customer.add') }}" class="needs-validation" novalidate enctype="multipart/form-data">
      @csrf
      <div class="card">
        <div class="row">
          <x-alert />
          <div class="col-md-4">
            <div class="form-group">
              <label for="customer_fname" class="form-label">Customer First Name</label>
              <input type="text" class="form-control admin-input" id="customer_fname" name="customer_fname" value="{{ old('customer_fname') }}" required autocomplete="off">
              @error('customer_fname')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="customer_last_name" class="form-label">Customer Last Name</label>
              <input type="text" class="form-control admin-input" id="customer_last_name" name="customer_last_name"
                                    value="{{ old('customer_last_name') }}" required autocomplete="off">
              @error('customer_last_name')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" id="gender" class="form-control form-inputtext">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
              @error('gender')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="customer_mobile" class="form-label">Mobile No</label>
              <input type="text" class="form-control admin-input" id="customer_mobile" name="customer_mobile" value="{{ old('customer_mobile') }}"  autocomplete="off">
              @error('customer_mobile')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="customer_email" class="form-label">Email</label>
              <input type="text" class="form-control admin-input" id="customer_email" name="customer_email" value="{{ old('customer_email') }}"  autocomplete="off">
              @error('customer_email')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="alert_product_qty" class="form-label">GSTIN</label>
              <input type="text" class="form-control admin-input" id="customer_gstin" name="customer_gstin" value="{{ old('customer_gstin') }}"  autocomplete="off">
              @error('customer_gstin')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="customer_date_of_birth" class="form-label">Date of Birth</label>
              <input type="text" class="form-control admin-input" id="customer_date_of_birth" name="customer_date_of_birth" value="{{ old('customer_date_of_birth') }}"  autocomplete="off">
              @error('customer_date_of_birth')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row"> 
          <div class="col-md-3">
            <div class="form-group">
              <label for="customer_address" class="form-label">Flat no.,Building,Street etc.</label>
              <input type="text" class="form-control admin-input" id="customer_address" name="customer_address" value="{{ old('customer_address') }}" autocomplete="off">
              @error('customer_address')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="customer_area" class="form-label">Area</label>
              <input type="text" class="form-control admin-input" id="customer_area" name="customer_area" value="{{ old('customer_area') }}" autocomplete="off">
              @error('customer_area')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="customer_city" class="form-label">City / Town</label>
              <input type="text" class="form-control admin-input" id="customer_city" name="customer_city" value="{{ old('customer_city') }}" autocomplete="off">
              @error('customer_city')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="customer_pincode" class="form-label">Pin / Zip Code</label>
              <input type="text" class="form-control admin-input" id="customer_pincode" name="customer_pincode" value="{{ old('customer_pincode') }}" autocomplete="off">
              @error('customer_pincode')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="customer_state_id" class="form-label">State / Region</label>
              <select name="customer_state_id" id="customer_state_id" class="form-control form-inputtext">
                <option value="">Select State</option>
                <option value="1">West Bengal</option>
              </select>
              @error('customer_address')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="customer_country_id" class="form-label">Country</label>
              <select name="customer_country_id" id="customer_country_id" class="form-control form-inputtext">
                <option value="">Select Country</option>
                <option value="1">India</option>
              </select>
              @error('customer_address')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="outstanding_duedays" class="form-label">Credit Period(days)</label>
              <input type="text" class="form-control admin-input" id="outstanding_duedays" name="outstanding_duedays" value="{{ old('outstanding_duedays') }}" autocomplete="off">
              @error('outstanding_duedays')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="source" class="form-label">How did you came to know about us?</label>
              <select name="source" id="source" class="form-control form-inputtext">
                <option value="">Select Source</option>
                <option value="1">CUSTOMER</option>
                <option value="2">DIRECT MARKETING</option>
                <option value="3">Google</option>
                <option value="4">TELE MARKETING</option>
              </select>
              @error('source')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row">
          <div class="card-body greybg">
            <h5 class="hk-sec-title">Customer Children Data <a href="javascript:;" id="cust_child_plus"><i class="fa fa-plus"></i></a></h5>
            <div id="repeat_child">
              <div class="row add_child_repeat_sec" id="child_1">
                <div class="col-md-3">
                  <label class="form-label">Children Name</label>
                  <input type="text" maxlength="100" name="child_name[]" value="" class="form-control form-inputtext" placeholder="" >
                </div>
                <div class="col-md-3">
                  <label class="form-label">Children Birth Date</label>
                  <input type="text" maxlength="100" name="child_date_of_birth[]" value="" class="form-control form-inputtext" placeholder="" >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row">
          <div class="card-body greybg">
            <h5 class="hk-sec-title">Customer Delivery Address</h5>
            <div>
              <input type="checkbox" id="delivery_address" name="delivery_address" value="yes" checked="checked"> <label for="delivery_address" class="toggleBtn"> Same as above</label>
            </div>
          </div>
        </div>
        <div class="card-body toggleBox" style="display: none;">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="customer_delivery_address" class="form-label">Flat no.,Building,Street etc.</label>
                <input type="text" class="form-control admin-input" id="customer_delivery_address" name="customer_delivery_address" value="{{ old('customer_delivery_address') }}" autocomplete="off">
                @error('customer_delivery_address')
                <div class="error admin-error">{{ $message }}</div>
                @enderror </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="customer_delivery_area" class="form-label">Area</label>
                <input type="text" class="form-control admin-input" id="customer_delivery_area" name="customer_delivery_area" value="{{ old('customer_delivery_area') }}" autocomplete="off">
                @error('customer_delivery_area')
                <div class="error admin-error">{{ $message }}</div>
                @enderror </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="customer_delivery_city" class="form-label">City / Town</label>
                <input type="text" class="form-control admin-input" id="customer_delivery_city" name="customer_delivery_city" value="{{ old('customer_delivery_city') }}" autocomplete="off">
                @error('customer_delivery_city')
                <div class="error admin-error">{{ $message }}</div>
                @enderror </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="customer_delivery_pincode" class="form-label">Pin / Zip Code</label>
                <input type="text" class="form-control admin-input" id="customer_delivery_pincode" name="customer_delivery_pincode" value="{{ old('customer_delivery_pincode') }}" autocomplete="off">
                @error('customer_delivery_pincode')
                <div class="error admin-error">{{ $message }}</div>
                @enderror </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="customer_delivery_state_id" class="form-label">State / Region</label>
                <select name="customer_delivery_state_id" id="customer_delivery_state_id" class="form-control form-inputtext">
                  <option value="">Select State</option>
                  <option value="1">West Bengal</option>
                </select>
                @error('customer_delivery_state_id')
                <div class="error admin-error">{{ $message }}</div>
                @enderror </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="customer_delivery_country_id" class="form-label">Country</label>
                <select name="customer_delivery_country_id" id="customer_delivery_country_id" class="form-control form-inputtext">
                  <option value="">Select Country</option>
                  <option value="1">India</option>
                </select>
                @error('customer_delivery_country_id')
                <div class="error admin-error">{{ $message }}</div>
                @enderror </div>
            </div>
          </div>
        </div>

      </div>
      <div class="card">
        <div class="row">
          <div class="row">
            <div class="col-12">
              <button class="commonBtn-btnTag" type="submit">Submit </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts') 
<script src="{{ url('assets/admin/js/customer.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
$(document).ready(function(){
    $(".toggleBtn").click(function(){
      $(".toggleBox").slideToggle();
    });
  });
</script>
@endsection 