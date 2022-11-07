@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      
      <div class="table-responsive dataTable-design">
        <table id="purchase_list" class="table table-bordered">
          <thead>
			<th>Action</th>
            <th>Invoice No.</th>
            <th>TP Pass.</th>
            <th>Inward date</th>
            <th>Purchase date</th>
            <th>Supplier Name</th>
            <th>Total Qty</th>
            <th>Total Cost</th>
            
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

	var table = $('#purchase_list').DataTable({
		processing: true,
		serverSide: true,
		searchDelay: 350,
		ajax: "{{ route('admin.report.counter.counter_purchase') }}",
		columns: [
			{
				data: 'action',
				name: 'action',
                orderable: false, searchable: false
			},
			{
				data: 'invoice_no',
				name: 'invoice_no'
			},	
			{
				data: 'tp_no',
				name: 'tp_no'
			},	
			{
				data: 'inward_date',
				name: 'inward_date'
			},
			{
				data: 'purchase_date',
				name: 'purchase_date',
			},
			{
				data: 'supplier_id',
				name: 'supplier_id'
			},
			{
				data: 'total_qty',
				name: 'total_qty'
			},
			{
				data: 'sub_total',
				name: 'sub_total'
			},
			
			
		]
	});

});
$(document).on('click', '#delete_inward_stock', function() {
            var url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location = url;
                }
            })
        });
</script> 
@endsection 