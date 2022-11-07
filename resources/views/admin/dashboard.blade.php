@extends('layouts.admin_dashboard')
@section('mainContent')

@php
$branch_id 			= Session::get('branch_id');
$company_name		= App\Models\Common::get_user_settings($where=['option_name'=>'company_name'],$branch_id);
$company_address	= App\Models\Common::get_user_settings($where=['option_name'=>'company_address'],$branch_id);
$is_branch 			= Session::get('is_branch');


//print_r($company_name);exit;

@endphp
<header>
  <div class="container-fluid p-h-40">
    <div class="row justify-content-between align-items-center">
      <div class="col-auto logo"> {{$company_name}}<small>{{$company_address}}</small> </div>
      <div class="col-auto logOut"> <a href="{{ route('admin.auth.logout') }}"><i class="fas fa-lock"></i>Logout</a> </div>
    </div>
  </div>
</header>
<section class="artReleases">
  <div class="container-fluid p-h-40">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-7 col-12">
        <div class="posCarouselArea">
          <div class="owl-carousel owl-theme posCarousel">
            <div class="item">
              <div class="pcInner">
                <h4>Today's</h4>
                <div class="pcInnerTop w-100">
                  <ul class="d-flex">
                    <li style="background: #4e50df;"><span>0.00</span>Sale ₹</li>
                    <li style="background: #5c74dd;"><span>0.00</span>Net Profit ₹</li>
                    <li style="background: #506aad;"><span>0.00</span>Sale Return ₹</li>
                  </ul>
                </div>
                <div class="pcInnerBtm w-100">
                  <div class="pcInnerBtmInner row row-cols-3">
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Cash</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Card</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Cheque</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Wallet</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Unpaid Amt.</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Net Banking</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Credit Not</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Debit Note</span> 0</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="pcInner pciType-2">
                <h4>This Month</h4>
                <div class="pcInnerTop w-100">
                  <ul class="d-flex">
                    <li style="background: #e68b8b;"><span>0.00</span>Sale ₹</li>
                    <li style="background: #506aad;"><span>0.00</span>Net Profit ₹</li>
                    <li style="background: #ea9354;"><span>0.00</span>Sale Return ₹</li>
                  </ul>
                </div>
                <div class="pcInnerBtm w-100">
                  <div class="pcInnerBtmInner row row-cols-3">
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Cash</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Card</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Cheque</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Wallet</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Unpaid Amt.</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Net Banking</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Credit Not</span> 0</div>
                    </div>
                    <div class="col pcInnerBtmBox">
                      <div class="pibbInner"><span>Debit Note</span> 0</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="billArea">
                <h4>LATEST BILLS</h4>
                <div class="billBox">
                  <table class="table table-striped table-success">
                    <thead>
                      <tr>
                        <th scope="col">Bill No.</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Disc. ₹</th>
                        <th scope="col">Amount ₹</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>10%</td>
                        <td>300</td>
                      </tr>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>10%</td>
                        <td>300</td>
                      </tr>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>10%</td>
                        <td>300</td>
                      </tr>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>10%</td>
                        <td>300</td>
                      </tr>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>10%</td>
                        <td>300</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="billBox">
                  <h4>TOP SELLING PRODUCTS</h4>
                  <table class="table table-striped table-success">
                    <thead>
                      <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Barcode</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Amount ₹</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>300</td>
                      </tr>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>300</td>
                      </tr>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>300</td>
                      </tr>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>300</td>
                      </tr>
                      <tr>
                        <td>1234</td>
                        <td>Rahul</td>
                        <td>4</td>
                        <td>300</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="billBox">
                  <h4>LOW / OUT OF STOCK PRODUCTS</h4>
                  <table class="table table-striped table-success">
                    <thead>
                      <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Barcode</th>
                        <th scope="col">pCode</th>
                        <th scope="col">In Stock</th>
                        <th scope="col">Stock Alert</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Rahul</td>
                        <td>1234</td>
                        <td>4</td>
                        <td>200</td>
                        <td>0</td>
                      </tr>
                      <tr>
                        <td>Rahul</td>
                        <td>1234</td>
                        <td>4</td>
                        <td>200</td>
                        <td>0</td>
                      </tr>
                      <tr>
                        <td>Rahul</td>
                        <td>1234</td>
                        <td>4</td>
                        <td>200</td>
                        <td>0</td>
                      </tr>
                      <tr>
                        <td>Rahul</td>
                        <td>1234</td>
                        <td>4</td>
                        <td>200</td>
                        <td>0</td>
                      </tr>
                      <tr>
                        <td>Rahul</td>
                        <td>1234</td>
                        <td>4</td>
                        <td>200</td>
                        <td>0</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-7 col-12">
        <div class="row metroBoxArea">
          <div class="col-lg-3 col-md-3 col-sm-4 col-12 "> <a href="javascript:;" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #198699;"><span>Dashboard</span><img src="{{ url('assets/admin/new/images/icon/1.svg') }}" alt=""/></a> </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12"> <a href="javascript:;" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #553daa;"><span>Contacts</span><img src="{{ url('assets/admin/new/images/icon/2.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="javascript:;" data-href="{{ route('admin.report.inventory') }}" data-is_branch="{{$is_branch}}" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #2e7fe6;"><span>Inventory</span><img src="{{ url('assets/admin/new/images/icon/3.svg') }}" alt=""/></a> </div>
          <div class="col-lg-2 col-md-2 col-sm-4 col-12"> <a href="{{ route('admin.purchase.inward_stock') }}"  data-href="{{ route('admin.purchase.inward_stock') }}" data-is_branch="{{$is_branch}}" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #d64f35;"><span>Purchase</span><img src="{{ url('assets/admin/new/images/icon/6.svg') }}" alt=""/></a> </div>
          <div class="col-lg-5 col-md-5 col-sm-4 col-12"> <a href="{{ route('admin.purchase.stock.transfer') }}" class="metroBox d-flex align-items-center justify-content-center wow zoomIn " style="background: #d64f35;"><span>Stock Transfer </span><img src="{{ url('assets/admin/new/images/icon/4.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="{{ route('admin.report.sales.report.stock_transfer') }}"  data-href="{{ route('admin.report.sales.report.stock_transfer') }}" data-is_branch="{{$is_branch}}" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #f76ce1;"><span>Stock Transfer Report</span><img src="{{ url('assets/admin/new/images/icon/5.svg') }}" alt=""/></a> </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #b81249;"><span>Bank / Cash</span><img src="{{ url('assets/admin/new/images/icon/7.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="javascript:;" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #203966;"><span>POS</span><img src="{{ url('assets/admin/new/images/icon/8.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="javascript:;" data-href="{{ route('admin.supplier.list') }}" data-is_branch="{{$is_branch}}" class="check_url_permision metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #910b95;"><span>Supplier</span><img src="{{ url('assets/admin/new/images/icon/9.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #0f54b2;"><span>Accounting</span><img src="{{ url('assets/admin/new/images/icon/10.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="{{ route('admin.report.purchase') }}" data-href="{{ route('admin.report.purchase') }}" data-is_branch="{{$is_branch}}" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #e08300;"><span>Purchase Report</span><img src="{{ url('assets/admin/new/images/icon/11.svg') }}" alt=""/></a> </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #506aad;"><span>Report (BETA)</span><img src="{{ url('assets/admin/new/images/icon/12.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #052d72;"><span>Utilities</span><img src="{{ url('assets/admin/new/images/icon/14.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="{{ route('admin.setting') }}" data-is_branch="{{$is_branch}}" class="check_url_permision metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #8ca32f;"><span>Settings</span><img src="{{ url('assets/admin/new/images/icon/15.svg') }}" alt=""/></a> </div>
          <div class="col-lg-2 col-md-2 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn disabled_home_btn" style="background: #e77272;" ><span>Versions</span><img src="{{ url('assets/admin/new/images/icon/13.svg') }}" alt=""/></a> </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade dbModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-6"> <a href="javascript:;" data-href="{{ route('admin.pos.pos_create') }}" data-is_branch="Y" class="check_url_permision gotoPos"> <img src="{{ url('assets/admin/images/off-counter.svg') }}" alt=""> <span>Off Counter</span> </a> </div>
          <div class="col-6"> <a href="javascript:;" data-href="{{ route('admin.pos.bar_dine_in_table_booking') }}" data-is_branch="{{$is_branch}}" class="check_url_permision gotoPos"> <img src="{{ url('assets/admin/images/bar-cum-restaurannt-01.svg') }}" alt=""> <span>Bar Cum Restaurant</span> </a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 
@section('scripts') 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script> 
<script>
$(document).on('click','.check_url_permision',function(){
	var is_branch	= $(this).data('is_branch');
	var href		= $(this).data('href');
	if(is_branch=='Y'){
		window.location.replace(href);
	}else{
		Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'you don\'t have permission to access!'
})
	}
	
	
});
</script> 
@endsection