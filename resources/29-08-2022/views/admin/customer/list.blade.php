@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="table-responsive dataTable-design">
        <table id="customer_list" class="table table-bordered">
          <thead>
          	<th>Name</th>
            <th>Email</th>
            <th>Mobile No.</th>
            <th>Gender</th>
            <th>GSTIN</th>
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

	var table = $('#customer_list').DataTable({
		processing: true,
		serverSide: true,
		searchDelay: 350,
		ajax: "{{ route('admin.customer.list') }}",
		columns: [
			{
				data: 'customer_fname',
				name: 'customer_fname',
			},
			{
				data: 'customer_email',
				name: 'customer_email'
			},
			{
				data: 'customer_mobile',
				name: 'customer_mobile'
			},
			{
				data: 'gender',
				name: 'gender',
			},
			{
				data: 'customer_gstin',
				name: 'customer_gstin'
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