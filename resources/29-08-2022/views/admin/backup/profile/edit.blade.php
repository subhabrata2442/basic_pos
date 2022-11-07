@extends('layouts.admin')
@section('admin-content')
    <div class="row">

        <div class="col-12">
            <div class="view-profile-box box-bg">
                <x-alert />
                <h3>Profile Edit</h3>
                <form action="{{ route('admin.profile.edit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-dtls-head">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" name="user_avatar" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview"
                                    style="background-image: url({{ asset('' . \Auth::user()->avatar) }});">
                                </div>
                            </div>
                            @error('user_avatar')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="profile-dtls-body inputgap-btm">
                        <div class="form-group position-relative add-lft-icon">
                            <span class="left-icon"><i class="fas fa-user"></i></span>
                            <input type="text" name="full_name" class="form-control inpyt-style" placeholder="Full Name"
                                autocomplete="off" value="{{ old('full_name', \Auth::user()->name) }}">
                            @error('full_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group position-relative add-lft-icon">
                            <span class="left-icon"><i class="fas fa-envelope"></i></span>
                            <input type="text" name="email" class="form-control inpyt-style" placeholder="Email"
                                autocomplete="off" value="{{ old('email', \Auth::user()->email) }}">
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group position-relative add-lft-icon">
                            <span class="left-icon"><i class="fas fa-phone"></i></span>
                            <input type="text" name="phone" class="form-control inpyt-style" placeholder="Phone Number"
                                autocomplete="off" value="{{ old('phone', \Auth::user()->phone) }}">
                            @error('phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-dtls-ftr text-center">
                        <button type="submit" class="commonBtn-btnTag"><span class="btnTag-icon"><i
                                    class="fas fa-upload"></i></span>update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
