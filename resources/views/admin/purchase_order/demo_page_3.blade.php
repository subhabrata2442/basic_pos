@extends('layouts.sidebar_collapse_admin')
<style>
  .content-wrapper{
    background: #fff !important;
  }
  .content-header {
    display: none !important;
  }
</style>
@section('admin-content')

<section class="tablePage">
  <!-- <div class="rightPannelTop">
    <div class="row">
      <div class="col-lg-4 col-md-3 col-sm-3 col-12">
        <div class="tabBox">
          <a href="#" class="active"><span><img src="{{ url('assets/admin/images/dine-in.png') }}" alt=""></span> Dine  in <i class="fas fa-bell"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-md-3 col-sm-3 col-12">
        <div class="tabBox">
          <a href="#"><span><img src="{{ url('assets/admin/images/take-way.png') }}" alt=""></span> Take Away</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-3 col-sm-3 col-12">
        <div class="tabBox">
          <a href="#"><span><img src="{{ url('assets/admin/images/online.png') }}" alt=""></span> online</a>
        </div>
      </div>
    </div>
  </div>

  <div class="tableIndicate d-flex justify-content-center">
    <ul class="d-flex flex-wrap">
      <li><span style="background: #9ab3bd;"></span> Blank Table</li>
      <li><span style="background: #00bff3;"></span> Running Table</li>
      <li><span style="background: #39b54a;"></span> Printed Table</li>
      <li><span style="background: #fdc689;"></span> Paid Table</li>
      <li><span style="background: #f7941d;"></span> Running KOT Table</li>
    </ul>
  </div> -->


  <div class="filterTable d-flex flex-wrap">
    <div class="filterTableLeft d-flex flex-wrap">
      <div class="ftMenu">
        <div class="ftMenuTop">
          <div class="catalogsearch-box">
            <span id="select-box-category">food</span>
            <div id="categories-box" style="display:none;">
                <input style="display:none;" type="text" value="" id="qsearch">
                <ul class="cat-list dd-container" id="cat">
                    <li class="catItem top">food</li>
                    <li class=" catItem">Drinks</li>
                </ul>
            </div>
        </div>
        </div>
        <div class="ftMenuBtm">
          <ul>
            <li><a href="#">Welcome Drink</a></li>
            <li><a href="#">Soup</a></li>
            <li><a href="#">Salad</a></li>
            <li><a href="#">Starters</a></li>
            <li><a href="#">Main Course</a></li>
            <li><a href="#">Dessert</a></li>
            <li><a href="#">Chinese</a></li>
            <li><a href="#">Mexican</a></li>
            <li><a href="#">Italian</a></li>
          </ul>
        </div>

      </div>
      <div class="ftDetails">
        <div class="relative mb-4 onlineTab">
          <input type="text" name="" id="" placeholder="Search By Order ID" class="co-searchInput">
          <button class="co-searchBtn"><i class="fas fa-search"></i></button>
        </div>
        <div class="ftDetailsInner">
          <div class="row g-3">
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Chocolate<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Cool Blue</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Banana<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Chocolate<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Cool Blue</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Green Apple<br>Mojito</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Chocolate<br>Smoothie</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <div class="ftBox">
                <a href="#">
                  <img src="{{ url('assets/admin/images/food-1.png') }}" alt="">
                  <span>Cool Blue</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="filterTableRight">
      <div class="filterTableInner">
        <h4>Table - 1</h4>
        <ul class="d-flex flex-wrap justify-content-between">
          <li><span><img src="{{ url('assets/admin/images/user.png') }}" alt=""></span> Mr. Subho Saha</li>
          <li><span><img src="{{ url('assets/admin/images/call.png') }}" alt=""></span> 9830012345</li>
          <li><a href="#"><img src="{{ url('assets/admin/images/plus.png') }}" alt=""></a></li>
        </ul>
        <div class="table-responsive whiteBg ftiTable">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Sl</th>
                <th scope="col" class="text-center">Mame</th>
                <th scope="col" class="text-center">Size</th>
                <th scope="col" class="text-center">Rate</th>
                <th width="120" scope="col" class="text-center">Qty</th>
                <th scope="col" class="text-center">Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
              <tr>
                <td>1.</td>
                <td class="text-center">Tandori Chicken</td>
                <td class="text-center">Full</td>
                <td class="text-center">320.00</td>
                <td class="text-center">
                  <div>
                    <div class="priceControl d-flex">
                      <button class="controls2" value="-">-</button>
                      <input type="number" class="qtyInput2" value="0" data-max-lim="20">
                      <button class="controls2" value="+">+</button>
                  </div>
                  </div>
                  
                </td>
                <td class="text-center">315.00</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="table-responsive whiteBg">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" width="65%">QTY : 09</th>
                <th scope="col" class="text-right">Total:</th>
                <th scope="col" class="text-right">7,291.00</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="w-100 printBill">
          <ul class="d-flex">
            <li class="col"><a href="#">KO Print</a></li>
            <li class="col"><a href="#">Print Bill</a></li>
            <li class="col"><a href="#">Pay</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-center mt-3">
    <a href="#" class="backBtn"><i class="fas fa-arrow-left"></i> Back</a>
  </div>
</section>

@endsection



@section('scripts') 
<script>
  var timer2 = "5:01";
  var interval = setInterval(function() {


    var timer = timer2.split(':');
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);
    --seconds;
    minutes = (seconds < 0) ? --minutes : minutes;
    seconds = (seconds < 0) ? 59 : seconds;
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    //minutes = (minutes < 10) ?  minutes : minutes;
    $('.countdown').html(minutes + ':' + seconds);
    if (minutes < 0) clearInterval(interval);
    //check if both minutes and seconds are 0
    if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
    timer2 = minutes + ':' + seconds;
  }, 1000);
</script>

<script>
  var qty = 0, maxlim;
  $('.priceControl .controls2').on('click', function () {
      qty = $(this).siblings('.qtyInput2').val();
      maxlim = $(this).siblings('.qtyInput2').attr('data-max-lim');
      console.log(maxlim);
      if (($(this).val() == '+') && (parseInt(maxlim) > qty)) {
          qty++;
      } else if ($(this).val() == '-' && qty > 1) {
          qty--;
      }
      $(this).siblings('.qtyInput2').val(qty);

  });
</script>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function () {
      var qsearch, select, ul, li, a, i;
      qsearch = document.getElementById("qsearch");
      select = document.getElementById("select-box-category");
      ul = document.getElementById("categories-box");
      document.querySelector('body').addEventListener("click",
          function () {
              ul.style.display = 'none';
          });
      select.addEventListener('click', function (e) {
          e.stopPropagation();
          if (ul.style.display === 'none') {
              ul.style.display = 'block';
          } else {
              ul.style.display = 'none';
          }
      });
      li = ul.getElementsByTagName("li");
      for (i = 0; i < li.length; i++) {
          a = li[i];
          a.addEventListener("click", function () {
              qsearch.value = this.getAttribute(
                  "data-q");
              select.innerHTML = this.innerHTML;
          });
      }
  });

  window.onload = function () {
      var form = document.getElementById("search_mini_form");
      form.onsubmit = function () {
          var search = document.getElementById("search");
          var qsearch = document.getElementById("qsearch");
          var csearch = qsearch.value ? '&cat=' + qsearch.value :
              '';
          window.location = form.action + '/?q=' + search.value +
              csearch;
          return false;
      };
  };
</script>
@endsection 