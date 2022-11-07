@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="table-responsive dataTable-design">
        <table id="waiter_list" class="table table-bordered">
          <thead>
          	<th>Floor/Room Name</th>
            <th>Total Table</th>
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
		ajax: "{{ route('admin.restaurant.table.list') }}",
		columns: [
			{
				data: 'title',
				name: 'title',
			},
			{
				data: 'total_table',
				name: 'total_table'
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