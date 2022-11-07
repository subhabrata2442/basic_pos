{{-- @dd(\Route::currentRouteName()) --}}
@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <form method="post" action="{{ route('admin.user.edit', [base64_encode($data['users']->id)]) }}"
                    class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
          <x-alert />
          <div class="profile-dtls-head">
            <div class="avatar-upload">
              <div class="avatar-edit">
                <input type='file' id="imageUpload" name="user_avatar" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>
              </div>
              <div class="avatar-preview">
                <div id="imagePreview"
                                        style="background-image: url({{ asset('' . $data['users']->avatar) }});"> </div>
              </div>
              @error('user_avatar')
              <div class="error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="full_name" class="form-label">Name</label>
              <input type="text" class="form-control admin-input" id="full_name" name="full_name"
                                    value="{{ old('full_name', $data['users']->name) }}" required autocomplete="off">
              @error('full_name')
              <div class="error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="Email" class="form-label">Email</label>
              <input type="text" class="form-control admin-input" id="Email" name="email"
                                    value="{{ old('email', $data['users']->email) }}" required autocomplete="off">
              @error('email')
              <div class="error">{{ $message }}</div>
              @enderror </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control admin-input" id="phone" name="phone"
                                    value="{{ old('phone', $data['users']->phone) }}" required autocomplete="off">
              @error('phone')
              <div class="error">{{ $message }}</div>
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