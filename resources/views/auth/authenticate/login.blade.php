@extends('layouts.front')
@section('front-content')
<section class="loginWrap d-flex flex-wrap" style="background: url({{ asset('assets/img/login-bg-md.jpg') }}) no-repeat center center;">
  <div class="loginWrapLeft d-flex flex-wrap align-items-end">
    <img src="{{ asset('assets/img/left-img.png') }}" alt="">
  </div>
 
  <div class="loginWrapRight d-flex flex-wrap align-items-center justify-content-center" style="background: url({{ asset('assets/img/login-bg-right.jpg') }}) no-repeat center center;">
   <x-alert />
    <div class="loginFormFild">
      <form class="" method="post" action="{{ route('auth.login') }}" autocomplete="off">
      @csrf
      <div class="posLogo">
        <span><img src="{{ asset('assets/img/pos-logo.png') }}" alt=""></span>
      </div>
        <!-- <h3>Pos System</h3> -->
        <div class="logtextBox">
          <div class="form-group position-relative add-lft-icon"> <span class="left-icon"> <i class="fas fa-user"></i> </span>
            <input type="text" name="email" class="form-control inpyt-style" placeholder="Email" autocomplete="new-email" value="{{ old('email') }}">
            @error('email')
            <div class="error">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-group position-relative add-lft-icon add-rgt-icon"> <span class="left-icon"> <i class="fas fa-key"></i> </span>
            <input type="password" class="form-control inpyt-style" id="password-field" placeholder="Password" name="password" autocomplete="password-field">
            <span class="rgt-icon" toggle="#password-field"> <i class="fas fa-eye-slash toggle-password"></i> </span> @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <li class="checkbox chk-wrap">
              <input type="checkbox" id="keep-me-logged" name="remember_me" value="1">
              <label for="keep-me-logged">keep me logged</label>
            </li>
            <li><a href="javascript:;" class="forget-pass" data-bs-toggle="modal" data-bs-target="#exampleModal">forget password</a></li>
          </div>
        </div>
        <div class="log-reg-btn-wrap d-flex justify-content-center">
          <button type="submit" class="log-reg-btn">log in</button>
        </div>
      </form>
    </div>
  </div>
</section>

<div class="modal fade editPassword" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forget Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="get">
          <div class="form-group">
            <input type="password" class="form-control" id="" placeholder="New Password" name="">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="" placeholder="Confirm Password" name="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection 