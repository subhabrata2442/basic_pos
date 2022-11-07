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
			<input type="hidden" name="item_id" value="{{$data['item_id']}}" id="item_id">
			<input type="hidden" name="start_date" id="start_date" value="">
			<input type="hidden" name="end_date" id="end_date" value="">
			{{-- <div class="form-group">
				<label for="date_search" class="mr-3">Date</label>
				<input type="text" class="form-control" name="datefilter" id="reportrange" placeholder="Select Date" autocomplete="off">
			</div>
			<button type="submit" class="btn btn-primary ml-3">Search</button> --}}
		</form>
		{{-- <a href="javascript:;" id="download" data-date="" class="downloadBtn"><i class="fas fa-download"></i> Download</a> --}}
	  </div>
	  
      <div class="table-responsive dataTable-design">
		{{-- <input type="data" name="date_filter" class="form-control searchDate" placeholder="Date"> --}}
        <table id="stock_product" class="table table-bordered">
          <thead>
			<th>Product Name</th>
            <th>Barcode</th>
			<th>Measure</th>
			<th>Qty</th>
            <th>MRP</th>
            <th>Total Cost</th>
            <th>Date</th>
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



/* $(document).on('change','#product_upload_file',function(){
	this.form.submit();
}); */

$(function() {
	var table = $('#stock_product').DataTable({
		/* dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>", */
		processing: true,
		serverSide: true,
		searchDelay: 350,
		searching: false,
		ajax: {
			url : "{{ route('admin.report.sales.product')}}",
			data: function (d) {
				d.start_date = $('input[name=start_date]').val();
				d.end_date = $('input[name=end_date]').val();
				d.id = $('input[name=item_id]').val();
            }
		},
		columns: [
			{
				data: 'product_name',
				name: 'product_name'
			},	
			{
				data: 'barcode',
				name: 'barcode'
			},	
			{
				data: 'measure',
				name: 'measure'
			},	
			{
				data: 'product_qty',
				name: 'product_qty'
			},	
			{
				data: 'product_mrp',
				name: 'product_mrp'
			},	
			{
				data: 'total_cost',
				name: 'total_cost'
			},	
			{
				data: 'created_at',
				name: 'created_at'
			},		
		]
		
	});
	/* $(".searchDate").keyup(function(){
        table.draw();
    }); */

	$('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

	$('#download').on("click",function(){
		var start_date = $('input[name=start_date]').val();
		//alert(start_date);
		var end_date = $('input[name=end_date]').val();
		var url = "{{route('admin.report.sales.product.download')}}";
		$(this).attr('href',url+'?start_date='+start_date+'&end_date='+end_date);
	})
	//Start date range picker
	/* var start = moment().subtract(29, 'days');
    var end = moment();
	 */

   /*  function cb(start, end) {
        //$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#reportrange').val(start.format('D-MM-YYYY') + ' - ' + end.format('D-MM-YYYY'));
		$('#start_date').val(start.format('YYYY-MM-DD'));
		$('#end_date').val(end.format('YYYY-MM-DD'));
    } */

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
});
</script> 
@endsection 