@extends('layouts.front')
@section('front-content')
    <div class="d-flex h-100 w-100 register">
        <div class="log-regirter-img">
            <div class="log-regirter-img-box img-over-lay zidex"
                style="background: url({{ asset('assets/img/log-bg.jpg') }}) no-repeat center center;">
                <div class="log-reg-logo-wrap">
                    <img class="img-block" src="{{ asset('assets/img/firefighter_logo.png') }}" alt="">
                </div>
            </div>
        </div>

        <div class="log-regirter-wrap bg-patten log-bg d-flex justify-content-center align-items-center">
            <div class="log-regirter-box">
                <span class="log-reg-logo">
                    <img class="img-block" src="{{ asset('assets/img/fire-logo.png') }}">
                </span>
                <form class="" method="post" action="{{ route('auth.register') }}">
                    @csrf
                    <div class="log-regirter-info">
                        <h3>Register</h3>
                        <div class="row">
                            <x-alert />
                            <div class="col-12">
                                <div class="form-group position-relative add-lft-icon">
                                    <span class="left-icon">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="full_name" class="form-control inpyt-style"
                                        placeholder="Full Name" autocomplete="off" value="{{ old('full_name') }}">
                                    @error('full_name')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group position-relative add-lft-icon">
                                    <span class="left-icon">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="text" name="email" class="form-control inpyt-style" placeholder="Email"
                                        autocomplete="off" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group position-relative add-lft-icon">
                                    <span class="left-icon">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="text" class="form-control inpyt-style" name="ph_no"
                                        placeholder="Phone Number" autocomplete="off" value="{{ old('ph_no') }}">
                                    @error('ph_no')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group position-relative add-lft-icon add-rgt-icon">
                                    <span class="left-icon">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control inpyt-style"
                                        id="password-field" placeholder="Password" autocomplete="new-password">
                                    <span class="rgt-icon" toggle="#password-field">
                                        <i class="fas fa-eye-slash toggle-password"></i>
                                    </span>
                                    @error('password')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group position-relative add-lft-icon">
                                    <span class="left-icon">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" name="password_confirmation" class="form-control inpyt-style"
                                        id="password-field1" placeholder="Confirm Password" autocomplete="off">
                                    @error('password')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="log-reg-btn-wrap text-center">
                            <ul class="align-items-center w-100 justify-content-center">
                                <li><button type="submit" class="log-reg-btn">register</button></li>
                                <li><a href="{{ route('auth.login') }}" class="dont-accont">Have an account? log
                                        in</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
