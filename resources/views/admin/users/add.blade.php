@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <form method="post" action="{{ route('admin.user.add') }}" class="needs-validation" id="user-form" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
          <x-alert />
          <div class="col-md-4">
            <div class="form-group">
              <label for="full_name" class="form-label">Name</label>
              <input type="text" class="form-control admin-input" id="full_name" name="full_name" value="" required autocomplete="off">
              @error('full_name')
              <div class="error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="Email" class="form-label">Email</label>
              <input type="text" class="form-control admin-input" id="Email" name="email" value="" required autocomplete="off">
              @error('email')
              <div class="error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control admin-input" id="phone" name="phone" value="" required autocomplete="off">
              @error('phone')
              <div class="error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone" class="form-label">Roll</label>
              <select name="roll" id="roll" class="form-control form-inputtext">
                <option value="">Select roll</option>
                
                
                      @foreach ($data['role'] as $value)
                      
                
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                
                
                      @endforeach
                    
              
              </select>
              @error('phone')
              <div class="error">{{ $message }}</div>
              @enderror </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control admin-input" id="password" name="password" autocomplete="off">
              @error('password')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-12">
            <button class="commonBtn-btnTag" type="submit">Submit </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection 