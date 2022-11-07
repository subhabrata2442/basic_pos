@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="table-responsive dataTable-design">
        <div class="card">
          <div class="row"> @foreach ($data['permission'] as $value)
            <div class="col-md-6">
              <div class="form-group">
                <label for="password" class="form-label" id="role_{{ $value->id }}">{{ $value->title }}</label>
                <input type="checkbox" id="role_{{ $value->id }}" value="{{ $value->id }}" />
              </div>
            </div>
            @endforeach </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts') 
<script type="text/javascript">
</script> 
@endsection 