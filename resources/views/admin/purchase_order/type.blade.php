@extends('layouts.sidebar_collapse_admin')
<style>
.content-wrapper{
	background: #fff !important;
	height: auto !important;
}
.content-header {
display: none !important;
}
</style>
@section('admin-content')
<section class="tablePage">
  <div class="rightPannelTop">
    <div class="row">
      <div class="col-lg-4 col-md-3 col-sm-3 col-12">
        <div class="tabBox"> <a href="#" class="active"><span><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/dine-in.png" alt=""></span> Dine  in <i class="fas fa-bell"></i></a> </div>
      </div>
      <div class="col-lg-4 col-md-3 col-sm-3 col-12">
        <div class="tabBox"> <a href="#"><span><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/take-way.png" alt=""></span> Take Away</a> </div>
      </div>
      <div class="col-lg-4 col-md-3 col-sm-3 col-12">
        <div class="tabBox"> <a href="#"><span><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/online.png" alt=""></span> online</a> </div>
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
  </div>
  <div class="d-flex flex-wrap">
    <div class="leftPannel"> 
      
      <!-- <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
      </div> -->
      
      <ul class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <li><a href="#" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><span><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/floor.png" alt=""></span> Non AC Room</a></li>
        <li><a href="#" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><span><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/floor.png" alt=""></span> AC Room</a></li>
        <li><a href="#" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><span><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/floor.png" alt=""></span> Garden</a></li>
        <li><a href="#" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><span><img src="https://pos.subho.aqualeafitsol.com/assets/admin/images/floor.png" alt=""></span> First floor</a></li>
      </ul>
    </div>
    <div class="rightPannel">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <div class="row g-3">
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgBlue">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgGray">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgGray">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgYgreen">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgSafron">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgBlue">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgBlue">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgGray">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgTill">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgYgreen">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgSafron">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgGray">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgYgreen">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgSafron">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
              <div class="tableBox bgBlue">
                <div class="tableBoxTop d-flex align-items-center justify-content-between">
                  <h5>Table 1</h5>
                  <div class="countdownArea d-flex align-items-center"> <i class="far fa-clock"></i>
                    <div class="countdown"></div>
                  </div>
                </div>
                <div class="tableBoxBtm">
                  <ul>
                    <li><span>Ramesh Guha</span></li>
                    <li>Amount: <span>1,875.00</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">2</div>
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">3</div>
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">4</div>
      </div>
    </div>
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
@endsection 