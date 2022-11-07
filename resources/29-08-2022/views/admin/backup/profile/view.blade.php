@extends('layouts.admin')
@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="view-profile-box box-bg">
                <h3>User Profile</h3>
                <div class="profile-dtls-head">
                    <span class="profile-img-view">
                        <img src="{{ asset('' . \Auth::user()->avatar) }}" alt="">
                    </span>
                </div>
                <div class="profile-dtls-body">
                    <ul class="">
                        <li class="d-flex">
                            <div class="dtls-heading">name :</div>
                            <div class="dtls-info">{{ \Auth::user()->name }}</div>
                        </li>
                        <li class="d-flex">
                            <div class="dtls-heading">email :</div>
                            <div class="dtls-info">{{ \Auth::user()->email }}</div>
                        </li>
                        <li class="d-flex">
                            <div class="dtls-heading">phone number :</div>
                            <div class="dtls-info">{{ \Auth::user()->phone }}</div>
                        </li>
                    </ul>
                </div>
                <div class="profile-dtls-ftr text-center">
                    <a href="{{ Route('admin.profile.edit') }}" class="commonBtn-aTag"><span class="aTag-icon"><i
                                class="fas fa-pen"></i></span>edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
