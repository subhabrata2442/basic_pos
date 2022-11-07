@extends('layouts.admin_dashboard')
@section('mainContent')
<header>
  <div class="container-fluid p-h-40">
    <div class="row justify-content-between align-items-center">
      <div class="col-auto logo"> Bazimath Drinks PVT LTD. <small>New Town branch</small> </div>
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
          <div class="col-lg-3 col-md-3 col-sm-4 col-12 "> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #198699;"><span>Dashboard</span><img src="{{ url('assets/admin/new/images/icon/1.svg') }}" alt=""/></a> </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #553daa;"><span>Contacts</span><img src="{{ url('assets/admin/new/images/icon/2.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #2e7fe6;"><span>Inventory</span><img src="{{ url('assets/admin/new/images/icon/3.svg') }}" alt=""/></a> </div>
          <div class="col-lg-2 col-md-2 col-sm-4 col-12"> <a href="{{ route('admin.purchase.inward_stock') }}" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #d64f35;"><span>Purchase</span><img src="{{ url('assets/admin/new/images/icon/6.svg') }}" alt=""/></a> </div>
          <div class="col-lg-5 col-md-5 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #d64f35;"><span>Coupons & Membership</span><img src="{{ url('assets/admin/new/images/icon/4.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #f76ce1;"><span>Sales</span><img src="{{ url('assets/admin/new/images/icon/5.svg') }}" alt=""/></a> </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #b81249;"><span>Bank / Cash</span><img src="{{ url('assets/admin/new/images/icon/7.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="{{ route('admin.pos.pos_create') }}" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #203966;"><span>POS</span><img src="{{ url('assets/admin/new/images/icon/8.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="{{ route('admin.supplier.list') }}" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #910b95;"><span>Supplier</span><img src="{{ url('assets/admin/new/images/icon/9.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #0f54b2;"><span>Accounting</span><img src="{{ url('assets/admin/new/images/icon/10.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #e08300;"><span>Report</span><img src="{{ url('assets/admin/new/images/icon/11.svg') }}" alt=""/></a> </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #506aad;"><span>Report (BETA)</span><img src="{{ url('assets/admin/new/images/icon/12.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #052d72;"><span>Utilities</span><img src="{{ url('assets/admin/new/images/icon/14.svg') }}" alt=""/></a> </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #8ca32f;"><span>Settings</span><img src="{{ url('assets/admin/new/images/icon/15.svg') }}" alt=""/></a> </div>
          <div class="col-lg-2 col-md-2 col-sm-4 col-12"> <a href="#" class="metroBox d-flex align-items-center justify-content-center wow zoomIn" style="background: #e77272;"><span>Versions</span><img src="{{ url('assets/admin/new/images/icon/13.svg') }}" alt=""/></a> </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 