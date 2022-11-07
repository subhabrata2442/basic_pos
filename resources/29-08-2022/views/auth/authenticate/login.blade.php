@extends('layouts.front')
@section('front-content')
<form class="" method="post" action="{{ route('auth.login') }}" autocomplete="off">
  @csrf
  <div class="d-flex h-100 w-100">
    <div class="log-regirter-img">
      <div class="log-regirter-img-box img-over-lay zidex"
                    style="background: url({{ asset('assets/img/log-bg.jpg') }}) no-repeat center center;">
        <div class="log-reg-logo-wrap"> <img class="img-block" src="{{ asset('assets/img/firefighter_logo.png') }}" alt=""> </div>
      </div>
    </div>
    <div class="log-regirter-wrap bg-patten log-bg d-flex justify-content-center align-items-center">
      <div class="log-regirter-box"> <span class="log-reg-logo"> <img class="img-block" src="{{ asset('assets/img/fire-logo.png') }}"> </span>
        <div class="log-regirter-info">
          <h3>log in</h3>
          <x-alert />
          <div class="form-group position-relative add-lft-icon"> <span class="left-icon"> <i class="fas fa-envelope"></i> </span>
            <input type="text" name="email" class="form-control inpyt-style" placeholder="Email"
                                autocomplete="new-email" value="{{ old('email') }}">
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror </div>
          <div class="form-group position-relative add-lft-icon add-rgt-icon"> <span class="left-icon"> <i class="fas fa-key"></i> </span>
            <input type="password" class="form-control inpyt-style" id="password-field" placeholder="Password" name="password" autocomplete="password-field">
            <!--<span class="rgt-icon" toggle="#password-field"> <i class="fas fa-eye-slash toggle-password"></i> </span>--> @error('password')
            <div class="error">{{ $message }}</div>
            @enderror </div>
          <div class="d-flex align-items-center justify-content-between">
            <li class="checkbox chk-wrap">
              <input type="checkbox" id="keep-me-logged" name="remember_me" value="1">
              <label for="keep-me-logged">keep me logged</label>
            </li>
            <li><a href="javascript:;" class="forget-pass">forget password</a></li>
          </div>
          <div class="log-reg-btn-wrap text-center">
            <ul class="align-items-center w-100 justify-content-center">
              <li>
                <button type="submit" class="log-reg-btn">log in</button>
              </li>
              <!--<li><a href="{{ route('auth.register') }}" class="dont-accont">Don't have an
                account?</a></li>-->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection 