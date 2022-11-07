@extends('layouts.admin.adminLayout')
@section('dashboardContent') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title or '' }}</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('administrator/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">{{ $breadcumbs or 'No title'}}</li>
          </ol>
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid"> @include('messages.flash_messages')
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form action="" method="get">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="">Category</label>
                      <select class="selectOption" name="cat_id" id="category_id">
                        <option value="">Choose..</option>
                        
                        
                        
                        
                      
                      @foreach($category_list as $row)
                      
                        
                        
                        
                        <option value="{{ $row->id }}" @php if(isset($_GET['cat_id'])){if($row->id==$_GET['cat_id']){ echo 'selected="selected"';}} @endphp> {{ $row->label }} </option>
                        
                        
                        
                        
                      @endforeach
                    
                    
                      
                      
                      
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="form-group">
                      <label>Date:</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="date" class="form-control form-control-sm datetimepicker-input" value="{{ $current_date }}" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="">Time Slot</label>
                      <select class="selectOption" name="slot_id" id="time_slot_id">
                        <option value="">Choose..</option>
                        
                        
                        
                       @php
                        $i=1;
                       @endphp 
                      @foreach($time_slots as $row)
                        
                        
                        
                        <option value="{{ $row->id }}" data-id="{{$i}}" @php if(isset($_GET['slot_id'])){if($row->id==$_GET['slot_id']){ echo 'selected="selected"';}} @endphp> {{ $row->from_time }} - {{ $row->to_time }} </option>
                        
                        
                        @php
                         $i++;
                        @endphp
                        @endforeach
                    
                      
                      
                      
                      </select>
                    </div>
                  </div>
                  <!--<div class="col-lg-3 col-md-3 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="">Type</label>
                    <select class="selectOption" name="type_id" id="type_id">
                      <option value="">Choose..</option>
                      
                      @foreach($type_list as $row)
                      <option value="{{ $row->id }}" @php if(isset($_GET['type_id'])){if($row->id==$_GET['type_id']){ echo 'selected="selected"';}} @endphp> {{ $row->name }}</option>
                      @endforeach
                    
                    </select>
                  </div>
                </div>-->
                <input type="hidden" name="time_slot_number" id="time_slot_number" value="{{$time_slot_id}}" />
                  
                  <div class="col-12">
                    <div class="form-group w-100 d-flex justify-content-center">
                      <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> SEARCH</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        
        @if(isset($ffplay_bid_result['total_single_amount']))
        @if($ffplay_bid_result['total_single_amount']>0)
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><small class="badge badge-warning">FF PLAY</small> Single</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                  <thead>
                    <tr>
                      <th>Bid Number</th>
                      <th>Total Bid</th>
                      <th>Amount (₹)</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($ffplay_bid_result['single_bid_result'] as $row)
                  <tr>
                    <td>{{ $row['bid_number'] }}</td>
                    <td>{{ $row['total_bid'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" align="center" style="color:#F00">Total:</td>
                    <td>{{$ffplay_bid_result['total_single_amount']}}</td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><small class="badge badge-primary">FF LIVE</small> Single</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                  <thead>
                    <tr>
                      <th>Bid Number</th>
                      <th>Total Bid</th>
                      <th>Amount (₹)</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($result['singleBidResult'] as $row)
                  <tr>
                    <td>{{ $row['digit'] }}</td>
                    <td>{{ $row['totalBid'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" align="center" style="color:#F00">Total:</td>
                    <td>{{$result['totalSingleAmount']}}</td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        @if(isset($ffplay_bid_result['total_patti_amount']))
        @if($ffplay_bid_result['total_patti_amount']>0)
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><small class="badge badge-warning">FF PLAY</small> Patti</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                  <thead>
                    <tr>
                      <th>Bid Number</th>
                      <th>Total Bid</th>
                      <th>Amount (₹)</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($ffplay_bid_result['patti_bid_result'] as $row)
                  <tr>
                    <td>{{ $row['bid_number'] }}</td>
                    <td>{{ $row['total_bid'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" align="center" style="color:#F00">Total:</td>
                    <td>{{$ffplay_bid_result['total_patti_amount']}}</td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><small class="badge badge-primary">FF LIVE</small> Patti</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                  <thead>
                    <tr>
                      <th>Bid Number</th>
                      <th>Total Bid</th>
                      <th>Amount (₹)</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($result['pattiBidResult'] as $row)
                  <tr>
                    <td>{{ $row['digit'] }}</td>
                    <td>{{ $row['totalBid'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" align="center" style="color:#F00">Total:</td>
                    <td>{{$result['totalPattiAmount']}}</td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        @if(isset($ffplay_bid_result['total_jodi_amount']))
        @if($ffplay_bid_result['total_jodi_amount']>0)
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><small class="badge badge-warning">FF PLAY</small> Jodi</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                  <thead>
                    <tr>
                      <th>Bid Number</th>
                      <th>Total Bid</th>
                      <th>Amount (₹)</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($ffplay_bid_result['jodi_bid_result'] as $row)
                  <tr>
                    <td>{{ $row['bid_number'] }}</td>
                    <td>{{ $row['total_bid'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" align="center" style="color:#F00">Total:</td>
                    <td>{{$ffplay_bid_result['total_jodi_amount']}}</td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><small class="badge badge-primary">FF LIVE</small> Jodi</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                  <thead>
                    <tr>
                      <th>Bid Number</th>
                      <th>Total Bid</th>
                      <th>Amount (₹)</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($result['jodiBidResult'] as $row)
                  <tr>
                    <td>{{ $row['digit'] }}</td>
                    <td>{{ $row['totalBid'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" align="center" style="color:#F00">Total:</td>
                    <td>{{$result['totalJodiAmount']}}</td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        @if(isset($ffplay_bid_result['total_cp_Amount']))
        @if($ffplay_bid_result['total_cp_Amount']>0)
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><small class="badge badge-warning">FF PLAY</small> CP</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                  <thead>
                    <tr>
                      <th>Bid Number</th>
                      <th>Total Bid</th>
                      <th>Amount (₹)</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($ffplay_bid_result['cp_bid_result'] as $row)
                  <tr>
                    <td>{{ $row['bid_number'] }}</td>
                    <td>{{ $row['total_bid'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" align="center" style="color:#F00">Total:</td>
                    <td>{{$ffplay_bid_result['total_cp_Amount']}}</td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><small class="badge badge-primary">FF LIVE</small> CP</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                  <thead>
                    <tr>
                      <th>Bid Number</th>
                      <th>Total Bid</th>
                      <th>Amount (₹)</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($result['cpBidResult'] as $row)
                  <tr>
                    <td>{{ $row['digit'] }}</td>
                    <td>{{ $row['totalBid'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" align="center" style="color:#F00">Total:</td>
                    <td>{{$result['totalCpAmount']}}</td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@push('stylesheet')
@endpush
@push('scripts') 
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('public/front/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- InputMask --> 
<script src="{{ asset('public/front/plugins/moment/moment.min.js') }}"></script> 
<!-- Tempusdominus Bootstrap 4 --> 
<script src="{{ asset('public/front/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> 
<script src="{{ asset('public/front/plugins/chart.js/Chart.min.js') }}"></script> 
<script>
$(function () {
	//$('#example1').DataTable();
});

//Date picker
$('#reservationdate').datetimepicker({
	format: 'YYYY-MM-DD'
});

$('#category_id').change(function(e) {
    var category_id = $(this).val();
    if (category_id != '') {
        $.ajax({
            url: prop.ajaxurl,
            type: 'post',
            data: {
                category_id: category_id,
                action: 'get_slot',
                _token: prop.csrf_token
            },
            beforeSend: function() {},
            success: function(response) {
                $('#time_slot_id').html(response);
            }
        });
    }
});

$(document).on('change','#time_slot_id',function(){
	var time_slot_number = $('option:selected', this).attr('data-id');
	if (time_slot_number != '') {
		$('#time_slot_number').val(time_slot_number);
	}
});

</script> 


@endpush
@endsection 