@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="table-responsive dataTable-design">
        <table id="user-table" class="table table-bordered">
          <thead>
          <th>Name</th>
            <th>Actions</th>
              </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts') 
<script type="text/javascript">
$(function() {
	var table = $('#user-table').DataTable({
		processing: true,
		serverSide: true,
		searchDelay: 350,
		ajax: "{{ route('admin.user.manageRole') }}",
		columns: [
			{
				data: 'name',
				name: 'name'
			},
			{
				data: 'action',
				name: 'action',
				orderable: false,
				searchable: false
			},
		]
	});
});
   
    </script> 
@endsection 