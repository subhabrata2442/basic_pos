@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <form method="post" action="{{ route('admin.restaurant.waiter.edit', [base64_encode($data['waiter']->id)]) }}" class="needs-validation" novalidate enctype="multipart/form-data">
      @csrf
      <div class="card">
        <div class="row">
          <x-alert />
          <div class="col-md-4">
            <div class="form-group">
              <label for="name" class="form-label">Waiter Name</label>
              <input type="text" class="form-control admin-input" id="name" name="name" value="{{ old('name', $data['waiter']->name) }}" required autocomplete="off">
              @error('name')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" id="gender" class="form-control form-inputtext">
                <option value="">Select Gender</option>
                <option value="male" @if ($data['waiter']->gender == "male") selected @endif>Male</option>
                <option value="female" @if ($data['waiter']->gender == "female") selected @endif>Female</option>
                <option value="other" @if ($data['waiter']->gender == "other") selected @endif>Other</option>
              </select>
              @error('gender')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="mobile" class="form-label">Mobile No</label>
              <input type="text" class="form-control admin-input" id="mobile" name="mobile" value="{{ old('mobile', $data['waiter']->mobile) }}"  autocomplete="off">
              @error('mobile')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control admin-input" id="email" name="email" value="{{ old('email', $data['waiter']->email) }}"  autocomplete="off">
              @error('email')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
         
          <div class="col-md-4">
            <div class="form-group">
              <label for="date_of_birth" class="form-label">Date of Birth</label>
              <input type="date" class="form-control admin-input" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $data['waiter']->date_of_birth) }}"  autocomplete="off">
              @error('date_of_birth')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
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
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
$(document).ready(function(){
    $(".toggleBtn").click(function(){
      $(".toggleBox").slideToggle();
    });
  });
</script> 
@endsection 