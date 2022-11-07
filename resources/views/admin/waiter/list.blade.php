@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="table-responsive dataTable-design">
        <table id="waiter_list" class="table table-bordered">
          <thead>
          	<th>Name</th>
            <th>Email</th>
            <th>Mobile No.</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Action</th>
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

	var table = $('#waiter_list').DataTable({
		processing: true,
		serverSide: true,
		searchDelay: 350,
		ajax: "{{ route('admin.restaurant.waiter.list') }}",
		columns: [
			{
				data: 'name',
				name: 'name',
			},
			{
				data: 'email',
				name: 'email'
			},
			{
				data: 'mobile',
				name: 'mobile'
			},
			{
				data: 'gender',
				name: 'gender',
			},
			{
				data: 'date_of_birth',
				name: 'date_of_birth'
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