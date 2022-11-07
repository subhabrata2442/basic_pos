@extends('layouts.admin_pos')
@section('admin-content')
<div class="row"> 
<div class="col-lg-8 col-md-8">
    <div class="d-flex align-items-center justify-content-between">
      <div class="enterProduct d-flex align-items-center justify-content-between">
        <div class="enterProductInner d-flex"><input type="text" name="" id="" placeholder="Enter ITEM CODE or Scan Product"></div>
        <span><i class="fas fa-barcode"></i></span>
      </div>
      <div class="selectSale">
        <ul class="d-flex">
          <li>
            <input type="radio" id="r1" name="radio" value="" >
            <label for="r1">Sale</label>
          </li>
          <li>
            <input type="radio" id="r2" name="radio" value="" >
            <label for="r2">Sale Order</label>
          </li>
        </ul>
      </div>
    </div>
    <div class="w-100">
      <div class="tableFixHead table-1">
        <table>
          <thead>
            <tr>  	  	          	                                     
              <th>Barcode</th>
              <th>Iteams</th>
              <th>Stock</th>
              <th>MRP</th>
              <th>Qty.</th>
              <th>Disc%</th>
              <th>Disc Amt.</th>
              <th>Unit Price</th>
              <th>Total</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>10000001141</td>
              <td>bangla 250ml</td>
              <td>0</td>
              <td>
                <!-- <select name="" id="" class="input-3">
                  <option value="">700</option>
                </select> -->
                <input type="text" name="" id="" class="input-3" placeholder="700"> 
              </td>
              <td>01</td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="5"> 
              </td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="35.00000">
              </td>
              <td>593.22</td>
              <td>665.00</td>
              <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            <tr>
              <td>10000001141</td>
              <td>bangla 250ml</td>
              <td>0</td>
              <td>
                <!-- <select name="" id="" class="input-3">
                  <option value="">700</option>
                </select> -->
                <input type="text" name="" id="" class="input-3" placeholder="700"> 
              </td>
              <td>01</td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="5"> 
              </td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="35.00000">
              </td>
              <td>593.22</td>
              <td>665.00</td>
              <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            <tr>
              <td>10000001141</td>
              <td>bangla 250ml</td>
              <td>0</td>
              <td>
                <!-- <select name="" id="" class="input-3">
                  <option value="">700</option>
                </select> -->
                <input type="text" name="" id="" class="input-3" placeholder="700"> 
              </td>
              <td>01</td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="5"> 
              </td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="35.00000">
              </td>
              <td>593.22</td>
              <td>665.00</td>
              <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            <tr>
              <td>10000001141</td>
              <td>bangla 250ml</td>
              <td>0</td>
              <td>
                <!-- <select name="" id="" class="input-3">
                  <option value="">700</option>
                </select> -->
                <input type="text" name="" id="" class="input-3" placeholder="700"> 
              </td>
              <td>01</td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="5"> 
              </td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="35.00000">
              </td>
              <td>593.22</td>
              <td>665.00</td>
              <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            <tr>
              <td>10000001141</td>
              <td>bangla 250ml</td>
              <td>0</td>
              <td>
                <!-- <select name="" id="" class="input-3">
                  <option value="">700</option>
                </select> -->
                <input type="text" name="" id="" class="input-3" placeholder="700"> 
              </td>
              <td>01</td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="5"> 
              </td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="35.00000">
              </td>
              <td>593.22</td>
              <td>665.00</td>
              <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            <tr>
              <td>10000001141</td>
              <td>bangla 250ml</td>
              <td>0</td>
              <td>
                <!-- <select name="" id="" class="input-3">
                  <option value="">700</option>
                </select> -->
                <input type="text" name="" id="" class="input-3" placeholder="700"> 
              </td>
              <td>01</td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="5"> 
              </td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="35.00000">
              </td>
              <td>593.22</td>
              <td>665.00</td>
              <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            <tr>
              <td>10000001141</td>
              <td>bangla 250ml</td>
              <td>0</td>
              <td>
                <!-- <select name="" id="" class="input-3">
                  <option value="">700</option>
                </select> -->
                <input type="text" name="" id="" class="input-3" placeholder="700"> 
              </td>
              <td>01</td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="5"> 
              </td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="35.00000">
              </td>
              <td>593.22</td>
              <td>665.00</td>
              <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            <tr>
              <td>10000001141</td>
              <td>bangla 250ml</td>
              <td>0</td>
              <td>
                <!-- <select name="" id="" class="input-3">
                  <option value="">700</option>
                </select> -->
                <input type="text" name="" id="" class="input-3" placeholder="700"> 
              </td>
              <td>01</td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="5"> 
              </td>
              <td>
                <input type="text" name="" id="" class="input-3" placeholder="35.00000">
              </td>
              <td>593.22</td>
              <td>665.00</td>
              <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    

    <!-- <div class="w-100 productTable">
      <div class="tableFixHead">
        <table>
          <thead>
            <tr>  	  	          	                                     
              <th>Product Name</th>
              <th>Serial No</th>
              <th>Notes</th>
              <th>Rate</th>
              <th>Qty.</th>
              <th>Disc%</th>
              <th>Disc Amt.</th>
              <th>Unit Price</th>
              <th>Total</th>
              <th><a href="#"><i class="fas fa-plus-circle"></i></a></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td><input type="text" name="" id="" class="input-3" placeholder=""></td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> -->

    <div class="amountToPay d-flex w-100">
      <div class="atpLeft">
        <div class="atpLeftInner">
          <ul class="d-flex w-100">
            <li class="atpVall">Total Item -</li>
            <li class="atpinfo">12</li>
          </ul>
          <ul class="d-flex w-100">
            <li class="atpVall">Total -</li>
            <li class="atpinfo">₹415.70  <small>(inclusive all taxes)</small></li>
          </ul>
          <ul class="d-flex w-100">
            <li class="atpVall">Discount -</li>
            <li class="atpinfo">₹49.15</li>
          </ul>
          <ul class="d-flex w-100">
            <li class="atpVall">Tax -</li>
            <li class="atpinfo">₹8.44</li>
          </ul>
          <ul class="d-flex w-100 subTotal">
            <li class="atpVall">Sub Total-</li>
            <li class="atpinfo">₹415.70</li>
          </ul>
          <ul class="d-flex w-100">
            <li class="atpVall">Round Off -</li>
            <li class="atpinfo">(-) 0.70</li>
          </ul>
        </div>
      </div>
      <div class="atpMid d-flex justify-content-center align-items-center">
        <ul>
          <li><a href="#" class="applyCharge">Apply Charge</a></li>
          <li><a href="#" class="applyDiscount">Apply Discount </a></li>
        </ul>
      </div>
      <div class="atpRight d-flex justify-content-center align-items-center">
        <div class="text-center">
          <h6>Amount to pay</h6>
          <h3>₹415.00</h3>
        </div>
      </div>
    </div>

  </div>
  <div class="col-lg-4 col-md-4">
    <div class="srcArea relative">
      <input type="text" placeholder="Search by name" class="input-2">
      <span class="plusCircle"><i class="fas fa-plus-circle"></i></span>
    </div>

    <div class="dateSales">
      <ul class="d-flex justify-content-between align-items-center">
        <li><strong>Cashier :</strong> Alok Saha</li>
        <li class="d-flex align-items-center"><p>Date</p> <input type="date" placeholder="Search by name" class="input-2"></li>
      </ul>
    </div>

    <div class="customerDetails">
      <h4>Customer Details<span class="float-right" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="fas fa-info-circle"></i></span></h4>
      <div class="customerDetailsMid">
        <ul>
          <li>Customer Name : <span>Mithun Dey</span></li>
          <li>Contact Number : <span>0123456789</span></li>
          <!-- <li>Total Purchase : <span>0</span></li>
          <li>Loyalty Points : <span>0</span></li>
          <li>Member Ship : <span>Gold</span></li>
          <li>Member Ship Discount : <span> CONGRATS22 (50%)
          <li>Coupon : <span>GH569RT66</span></li> -->
        </ul>
      </div>
      <div class="customerDetailsBtm">
        <ul class="d-flex">	    
          <li>Last Bill No - <span>POSCN437</span></li>
          <li>Bill Amount - <span>₹17235</span></li>
          <li class="ml-auto"><i class="fas fa-print"></i></li>
        </ul>
      </div>
    </div>
    
    

    <div class="sidebar-widget text-center">
      <ul class="row">
        <li class="col-3"><a href="#"><span><i class="fas fa-ticket-alt"></i></span>Apply<br>Coupon</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-user-check"></i></span>Apply<br>Membership</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-calculator"></i></span>Calculator</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-credit-card"></i></span>Reedem Credit</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-hand-paper"></i></span>Hold</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-street-view"></i></span>View Hold</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-wallet"></i></span>Reset Bill</a></li>
        <li class="col-3"><a href="#"><span><i class="fas fa-luggage-cart"></i></span>Today Sale</a></li>
        <li class="payPrint col-6"><a href="#"><span><i class="fas fa-money-check"></i></span>pay</a></li>
        <li class="payPrint col-6"><a href="#"><span><i class="fas fa-print"></i></span>Print</a></li>
      </ul>
    </div>
  </div>

  <div class="col-12">
      <div class="topsellingProduct">
        <h4>Top Selling Sroducts</h4>
        <ul class="row">
          <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
          <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
          <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
          <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
          <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
          <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
          <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
          <li><a href="#"><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/1.png" alt=""><span>BANGLA 60UP</span></a></li>
        </ul>
      </div>
  </div>
  
</div>
@endsection

@section('scripts') 
<script src="{{ url('assets/admin/js/typeahead.min.js') }}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.1/typeahead.bundle.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.1/bloodhound.min.js"></script> 
<script src="{{ url('assets/admin/js/product.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
  // your custom ajax request here
  function ajaxRequest(params) {
    var url = 'https://examples.wenzhixin.net.cn/examples/bootstrap_table/data'
    $.get(url + '?' + $.param(params.data)).then(function (res) {
      params.success(res)
    })
  }
</script>
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<script>
var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};

var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

$('#scanBarcodeInput .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});




  $(document).ready(function(){
  $(".toggleBtn").click(function(){
    $(".toggleArea").slideToggle();
  });
});
</script> 
@endsection 