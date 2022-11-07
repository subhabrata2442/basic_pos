@extends('layouts.front')
@section('front-content')
    <form class="" method="post" action="#" autocomplete="off">
        @csrf
        <div class="d-flex h-100 w-100">
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
                    <div class="log-regirter-info">
                        <h3>forget password</h3>

                        <x-alert />
                        <div class="form-group position-relative add-lft-icon">
                            <span class="left-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="text" name="email" class="form-control inpyt-style" placeholder="Email"
                                autocomplete="new-email" value="{{ old('email') }}">
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="log-reg-btn-wrap text-center">
                            <ul class="align-items-center w-100 justify-content-center">
                                <li><button type="submit" class="log-reg-btn">submit</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
