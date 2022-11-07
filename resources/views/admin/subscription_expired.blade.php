@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="alert alert-danger" role="alert"> “Your subscription has expired on {{$data['ends_at']}}. Contact <strong>Administrator</strong> to renew your license.” </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection 