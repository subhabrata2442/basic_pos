@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <form method="post"
                    action="{{ route('admin.stock.supplier.edit', [base64_encode($data['supplier']->id)]) }}"
                    class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
          <x-alert />
          <div class="col-md-4">
            <div class="form-group">
              <label for="sup_code" class="form-label">Supplier Code</label>
              <input type="text" class="form-control admin-input" id="sup_code" name="sup_code"
                                    value="{{ old('sup_code', $data['supplier']->sup_code) }}" required
                                    autocomplete="off">
              @error('sup_code')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="sup_name" class="form-label">Name</label>
              <input type="text" class="form-control admin-input" id="sup_name" name="sup_name"
                                    value="{{ old('sup_name', $data['supplier']->sup_name) }}" required
                                    autocomplete="off">
              @error('sup_name')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control admin-input" id="phone" name="phone"
                                    value="{{ old('phone', $data['supplier']->phone) }}" required autocomplete="off">
              @error('phone')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control admin-input" id="email" name="email"
                                    value="{{ old('email', $data['supplier']->email) }}" required autocomplete="off">
              @error('email')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control admin-input" id="city" name="city"
                                    value="{{ old('city', $data['supplier']->city) }}" required autocomplete="off">
              @error('city')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pin" class="form-label">Pin Code</label>
              <input type="text" class="form-control admin-input" id="pin" name="pin"
                                    value="{{ old('pin', $data['supplier']->pin) }}" required autocomplete="off">
              @error('pin')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="address" class="form-label">Address</label>
              <textarea name="address" rows="3" id="address" class="form-control admin-textarea"
                                    required>{{ old('address', $data['supplier']->address) }}</textarea>
              @error('address')
              <div class="error admin-error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="notes" class="form-label">Notes</label>
              <textarea name="notes" rows="3" id="notes"
                                    class="form-control admin-textarea ">{{ old('notes', $data['supplier']->notes) }}</textarea>
              @error('notes')
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
<script></script> 
@endsection 