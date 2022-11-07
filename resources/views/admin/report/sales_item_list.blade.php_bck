@extends('layouts.admin')
@section('admin-content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="d-flex justify-content-between align-items-center mb-4">
		<form method="get" id="search-form" class="form-inline" role="form">
			<input type="hidden" name="start_date" id="start_date" value="">
			<input type="hidden" name="end_date" id="end_date" value="">
			<div class="form-group">
				<label for="date_search" class="mr-3">Date Filter</label>
				<input type="text" class="form-control" name="datefilter" id="reportrange" placeholder="Select Date" autocomplete="off">
			</div>
			<button type="submit" class="btn btn-primary ml-3">Search</button>
		</form>
		<a href="javascript:;" id="item_wise_sale" data-date="" class="downloadBtn" target="_blank"><i class="fas fa-download"></i> Item Wise sales Download</a>
	  </div>
      <div class="table-responsive dataTable-design">
        <table id="sales_list" class="table table-bordered">
          <thead>
            <th>Invoice No.</th>
            <th>Supplier Name</th>
            <th>Sell Date</th>
            <th>Total Qty</th>
            <th>Gross Amount</th>
            <th>Discount Amount</th>
            <th>Sub Total</th>
            <th>Pay Amount</th>
            <th>Payment Method</th>
            
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

	var table = $('#sales_list').DataTable({
		processing: true,
		serverSide: true,
		searchDelay: 350,
		//ajax: "{{ route('admin.report.sales.item') }}",
        ajax: {
			url : "{{ route('admin.report.sales.item')}}",
			data: function (d) {
				d.start_date = $('input[name=start_date]').val();
				d.end_date = $('input[name=end_date]').val();
            }
		},
		columns: [
			{
				data: 'invoice_no',
				name: 'invoice_no'
			},	
			{
				data: 'supplier',
				name: 'supplier'
			},	
            {
				data: 'sell_date',
				name: 'sell_date'
			},
			{
				data: 'total_qty',
				name: 'total_qty'
			},
			{
				data: 'gross_amount',
				name: 'gross_amount',
			},
			{
				data: 'discount_amount',
				name: 'discount_amount'
			},
			{
				data: 'sub_total',
				name: 'sub_total'
			},
			{
				data: 'pay_amount',
				name: 'pay_amount'
			},
			{
				data: 'payment_method',
				name: 'payment_method'
			},
			
			
			
		]
	});

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });
    //Start daterange picker
    $('#reportrange').daterangepicker({
        //startDate: start,
        //endDate: end,
		autoUpdateInput: false,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    //cb(start, end);

	$('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      	$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
	  	$('#start_date').val(picker.startDate.format('YYYY-MM-DD'));
		$('#end_date').val(picker.endDate.format('YYYY-MM-DD'));
  	});
	//End Date range picker

    
    $('#item_wise_sale').on("click",function(){
		var start_date = $('input[name=start_date]').val();
		var end_date = $('input[name=end_date]').val();
        if(start_date == '' && end_date== ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select date!',
            })
        }else{
            var url = "{{route('admin.report.sales.product.item_wise')}}";
		    $(this).attr('href',url+'?start_date='+start_date+'&end_date='+end_date);
        }
        
		
	})

});

</script> 
@endsection 