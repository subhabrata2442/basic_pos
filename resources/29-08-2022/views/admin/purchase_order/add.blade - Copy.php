@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-8">
    <form method="post" action="{{ route('admin.product.add') }}" class="needs-validation" novalidate enctype="multipart/form-data">
      @csrf
      <div class="card">
        <div class="card-body">
          <!--<h5>Category</h5>-->
          <h5>Menu</h5>
          <div class="row align-items-center">
            <div class="col-6">
              <div class="form-group has-search"><span class="fa fa-search form-control-feedback"></span>
                <div class="circle-loader" data-loader="circle-side"></div>
                <input type="text" class="form-control" placeholder="Search">
              </div>
            </div>
            <div class="col-2"></div>
            <div class="col-4 text-right font12">8 results</div>
          </div>
          <div class="row menu-item-list pl-2 pr-2">
            <div class="col-md-3 mb-3 pl-1 pr-1">
              <div class="row items no-gutters align-items-center rounded w-100">
                <div class="col-5 position-relative"><img class="rounded lozad loaded" data-background-image="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png" data-src="https://demo.bastisapp.com/backoffice/../upload/3/9376fd05-80a2-11ec-859e-99479722e411.png" src="https://demo.bastisapp.com/backoffice/../upload/3/9376fd05-80a2-11ec-859e-99479722e411.png" data-loaded="true" style="background-image: url(&quot;https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png&quot;);"></div>
                <div class="col-7 text-center p-1">
                  <p class="m-0 text-truncate"><b>Cheesy Eggdesal Meal</b></p>
                  <p class="m-0 text-green text-truncate">Small $97.00</p>
                  <p class="m-0 text-green text-truncate">Medium $100.00</p>
                  <p class="m-0 text-green text-truncate">Large $110.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3 pl-1 pr-1">
              <div class="row items no-gutters align-items-center rounded w-100">
                <div class="col-5 position-relative"><img class="rounded lozad loaded" data-background-image="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png" data-src="https://demo.bastisapp.com/backoffice/../upload/3/ad40eaff-80a9-11ec-859e-99479722e411.png" src="https://demo.bastisapp.com/backoffice/../upload/3/ad40eaff-80a9-11ec-859e-99479722e411.png" data-loaded="true" style="background-image: url(&quot;https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png&quot;);"></div>
                <div class="col-7 text-center p-1">
                  <p class="m-0 text-truncate"><b>Breakfast Rice Bowl Duo</b></p>
                  <p class="m-0 text-green text-truncate"> $289.00</p>
                  <p class="m-0 text-green text-truncate">Large $4.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3 pl-1 pr-1">
              <div class="row items no-gutters align-items-center rounded w-100">
                <div class="col-5 position-relative"><img class="rounded lozad loaded" data-background-image="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png" data-src="https://demo.bastisapp.com/backoffice/../upload/3/fa6e06df-80aa-11ec-859e-99479722e411.png" src="https://demo.bastisapp.com/backoffice/../upload/3/fa6e06df-80aa-11ec-859e-99479722e411.png" data-loaded="true" style="background-image: url(&quot;https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png&quot;);"></div>
                <div class="col-7 text-center p-1">
                  <p class="m-0 text-truncate"><b>Breakfast Sandwich Duo</b></p>
                  <p class="m-0 text-green text-truncate"> $249.00</p>
                  <p class="m-0 text-green text-truncate">Large $500.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3 pl-1 pr-1">
              <div class="row items no-gutters align-items-center rounded w-100">
                <div class="col-5 position-relative"><img class="rounded lozad loaded" data-background-image="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png" data-src="https://demo.bastisapp.com/backoffice/../upload/3/f5ee2bfc-80a2-11ec-859e-99479722e411.png" src="https://demo.bastisapp.com/backoffice/../upload/3/f5ee2bfc-80a2-11ec-859e-99479722e411.png" data-loaded="true" style="background-image: url(&quot;https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png&quot;);"></div>
                <div class="col-7 text-center p-1">
                  <p class="m-0 text-truncate"><b> Hot Fudge Sundae </b></p>
                  <p class="m-0 text-green text-truncate"> $32.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3 pl-1 pr-1">
              <div class="row items no-gutters align-items-center rounded w-100">
                <div class="col-5 position-relative"><img class="rounded lozad" data-background-image="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png" data-src="https://demo.bastisapp.com/backoffice/../upload/3/68c79292-80ae-11ec-859e-99479722e411.png" src="https://demo.bastisapp.com/backoffice/../upload/3/68c79292-80ae-11ec-859e-99479722e411.png"></div>
                <div class="col-7 text-center p-1">
                  <p class="m-0 text-truncate"><b> Hot Caramel Sundae </b></p>
                  <p class="m-0 text-green text-truncate"> $32.00</p>
                  <p class="m-0 text-green text-truncate">Small $20.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3 pl-1 pr-1">
              <div class="row items no-gutters align-items-center rounded w-100">
                <div class="col-5 position-relative"><img class="rounded lozad" data-background-image="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png" data-src="https://demo.bastisapp.com/backoffice/../upload/3/4567abc3-a081-11ec-84fa-93303474abfe.webp" src="https://demo.bastisapp.com/backoffice/../upload/3/4567abc3-a081-11ec-84fa-93303474abfe.webp"></div>
                <div class="col-7 text-center p-1">
                  <p class="m-0 text-truncate"><b>New New Product</b></p>
                  <p class="m-0 text-green text-truncate">Large $111.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3 pl-1 pr-1">
              <div class="row items no-gutters align-items-center rounded w-100">
                <div class="col-5 position-relative"><img class="rounded lozad" data-background-image="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png" data-src="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/default-image.png" src="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/default-image.png"></div>
                <div class="col-7 text-center p-1">
                  <p class="m-0 text-truncate"><b>sdfsd</b></p>
                  <p class="m-0 text-green text-truncate"> $4545.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3 pl-1 pr-1">
              <div class="row items no-gutters align-items-center rounded w-100">
                <div class="col-5 position-relative"><img class="rounded lozad" data-background-image="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/placeholder.png" data-src="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/default-image.png" src="https://demo.bastisapp.com/backoffice/themes/classic/assets/images/default-image.png"></div>
                <div class="col-7 text-center p-1">
                  <p class="m-0 text-truncate"><b>Food Thing</b></p>
                  <p class="m-0 text-green text-truncate">Small $3.00</p>
                  <p class="m-0 text-green text-truncate"> $5.36</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-4 position-relative">
    <div class="card">
      <div class="card-body">
        <div class="input-group mb-3">
          <select class="custom-select select2-hidden-accessible" id="inputGroupSelect02" data-select2-id="select2-data-inputGroupSelect02" tabindex="-1" aria-hidden="true">
          </select>
          <div class="input-group-append">
            <label class="input-group-text cursor-pointer btn-green" for="inputGroupSelect02"><i class="fa fa-user"></i></label>
          </div>
        </div>
        <h5 class="mb-2">Items</h5>
        <div class="pos-order-details nice-scroll p-2 pb-0" tabindex="2" style="overflow-y: hidden; outline: none;">
          <div class="row">
            <div class="col-2 d-flex justify-content-center"><img class="rounded img-40" src="https://demo.bastisapp.com/backoffice/../upload/3/fa6e06df-80aa-11ec-859e-99479722e411.png"></div>
            <div class="col-5 d-flex justify-content-start flex-column">
              <p class="mb-1">Breakfast Sandwich Duo <!----></p>
              <p class="m-0 font11">$249.00</p>
              <div class="mt-1 mb-1 quantity-wrap">
                <div class="quantity d-flex justify-content-between align-items-center">
                  <div><a href="javascript:;" class="rounded-pill qty-btn"><i class="zmdi zmdi-minus"></i></a></div>
                  <div class="qty">1</div>
                  <div><a href="javascript:;" class="rounded-pill qty-btn"><i class="zmdi zmdi-plus"></i></a></div>
                </div>
              </div>
              <!----><!----></div>
            <div class="col-4 d-flex justify-content-start flex-column text-right pr-0 pl-0"><a href="javascript:;" class="rounded-pill circle-button ml-auto mb-1"><i class="zmdi zmdi-close"></i></a>$249.00</div>
          </div>
          <hr>
        </div>
        <div class="pt-3">
          <div class="row mb-1">
            <div class="col-2 d-flex justify-content-center"></div>
            <div class="col-6 d-flex justify-content-start flex-column">Sub total (1 items)</div>
            <div class="col-3 d-flex justify-content-start flex-column text-right">$249.00</div>
          </div>
          <div class="row mb-1">
            <div class="col-2 d-flex justify-content-center"></div>
            <div class="col-6 d-flex justify-content-start flex-column">tps (5% included)</div>
            <div class="col-3 d-flex justify-content-start flex-column text-right">$12.45</div>
          </div>
          <hr>
          <div class="row mb-1">
            <div class="col-2 d-flex justify-content-center"></div>
            <div class="col-6 d-flex justify-content-start flex-column">
              <h6 class="m-0">Total</h6>
            </div>
            <div class="col-3 d-flex justify-content-start flex-column text-right">
              <h6 class="m-0">$249.00</h6>
            </div>
          </div>
          <div class="btn-group btn-group-lg w-100 mt-3" role="group" aria-label="Large button group">
            <button type="button" class="btn btn-secondary text-left">
            <p class="m-0"><i class="zmdi zmdi-label"></i></p>
            <p class="m-0">Promo</p>
            </button>
            <button type="button" class="btn btn-secondary text-left">
            <p class="m-0"><i class="zmdi zmdi-money-off"></i></p>
            <p class="m-0">Discount</p>
            </button>
            <button type="button" class="btn btn-secondary text-left">
            <p class="m-0"><i class="zmdi zmdi-refresh"></i></p>
            <p class="m-0">Reset</p>
            </button>
          </div>
          <button class="btn-green btn w-100 mt-2">
          <div class="d-flex justify-content-between align-items-center">
            <div class="flex-col text-left">
              <p class="m-0"><b>Proceed to pay</b></p>
              <p class="m-0"><i>1 Items</i></p>
            </div>
            <div class="flex-col">
              <h5>$249.00</h5>
            </div>
          </div>
          </button>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-body"><a href="javascript:;" class="btn btn-black btn-circle rounded-pill"><i class="zmdi zmdi-close font20"></i></a>
            <h4 class="m-0 mb-3 mt-3">Customer</h4>
            <form class="forms mt-2 mb-2">
              <div class="row">
                <div class="col">
                  <div class="form-label-group">
                    <input class="form-control form-control-text" placeholder="" id="first_name" type="text" maxlength="255">
                    <label for="first_name" class="required">First Name</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-label-group">
                    <input class="form-control form-control-text" placeholder="" id="last_name" type="text" maxlength="255">
                    <label for="last_name" class="required">Last Name</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-label-group">
                    <input class="form-control form-control-text" placeholder="" id="email_address" type="text" maxlength="200">
                    <label for="email_address" class="required">Email address</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-label-group">
                    <input class="form-control form-control-text" placeholder="" id="contact_phone" type="text" maxlength="20">
                    <label for="contact_phone" class="required">Contact Phone</label>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-green pl-4 pr-4" disabled=""><span>Submit</span>
            <div class="m-auto circle-loader" data-loader="circle-side"></div>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-body"><a href="javascript:;" class="btn btn-black btn-circle rounded-pill"><i class="zmdi zmdi-close font20"></i></a>
            <h4 class="m-0 mb-3 mt-3">Have a promo code?</h4>
            <form class="forms mt-2 mb-2">
              <div class="form-label-group">
                <input class="form-control form-control-text" placeholder="" id="promo_code" type="text" maxlength="20">
                <label for="promo_code" class="required">Add promo code</label>
              </div>
            </form>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-green pl-4 pr-4" disabled=""><span>Apply</span>
            <div class="m-auto circle-loader" data-loader="circle-side"></div>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-body"><a href="javascript:;" class="btn btn-black btn-circle rounded-pill"><i class="zmdi zmdi-close font20"></i></a>
            <h4 class="m-0 mb-3 mt-3">Create Payment</h4>
            <div class="menu-categories medium mb-3 mt-4 d-flex"><a class="text-center rounded align-self-center text-center">
              <h6 class="m-0">Total Due</h6>
              <h5 class="m-0 text-green word_wrap">$249.00</h5>
              </a><a class="text-center rounded align-self-center text-center">
              <h6 class="m-0">Pay Left</h6>
              <h5 class="m-0 text-danger word_wrap">$0.00</h5>
              </a><a class="text-center rounded align-self-center text-center">
              <h6 class="m-0">Change</h6>
              <h5 class="m-0 text-orange word_wrap">$0.00</h5>
              </a></div>
            <div class="row">
              <div class="col">
                <div class="form-label-group">
                  <input class="form-control form-control-text" placeholder="" id="receive_amount" type="text" maxlength="14" data-mask="#*.##" data-mask-raw-value="0" data-mask-inited="true">
                  <label for="receive_amount" class="required">Receive amount</label>
                </div>
              </div>
              <div class="col">
                <div class="form-label-group">
                  <select class="form-control custom-select form-control-select" id="payment_code">
                    <option value="cod">Cash On delivery</option>
                    <option value="ocr">Credit/Debit Card</option>
                    <option value="paypal">Paypal</option>
                    <option value="stripe">Stripe</option>
                    <option value="razorpay">Razorpay</option>
                    <option value="mercadopago">Mercadopago</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <textarea placeholder="Add order note" class="form-control form-control-select">
           </textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-green pl-4 pr-4" disabled=""><span>Submit</span>
            <div class="m-auto circle-loader" data-loader="circle-side"></div>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addproducts_features">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title dnamic_feature_title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="container"></div>
      <form id="productfeaturesform">
        <input type="hidden" id="product_features_type" autocomplete="off">
        <div class="modal-body">
          <div class="input-group input-group-default floating-label">
            <label class="form-label dnamic_feature_name"> </label>
            <input class="form-control form-inputtext" autocomplete="off" name="product_feature_data_value" id="product_feature_data_value" maxlength="100" type="text" placeholder=" ">
          </div>
          <span id="sizeerr" style="color: red;font-size: 15px"></span> </div>
        <div class="modal-footer"><a href="javascript:;" data-dismiss="modal" class="btn">Close</a>
          <button type="button" id="productfeaturessave" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts') 
<script src="{{ url('assets/admin/js/product.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
  $(document).ready(function(){
  $(".toggleBtn").click(function(){
    $(".toggleArea").slideToggle();
  });
});
</script> 
@endsection 