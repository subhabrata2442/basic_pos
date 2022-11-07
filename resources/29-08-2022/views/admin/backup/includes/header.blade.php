<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-dark"> 
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> </li>
  </ul>
  
  <!-- Right navbar links --> 
  
  <div class="profileDd ml-auto"> <a href="javascript:void(0)" class="toggleDropDown"><span><img src="{{ asset('' . \Auth::user()->avatar) }}"
                    alt=""></span> {{ \Auth::user()->name }} <i class="fas fa-caret-down"></i></a>
    <div class="profileDdInner displayHide">
      <div class="pdTop"> <span><img src="{{ asset('' . \Auth::user()->avatar) }}" alt=""></span>
        <h5>{{ \Auth::user()->name }}</h5>
        <h5>{{ \Auth::user()->email }}</h5>
        <!--<a href="{{ route('admin.profile') }}">View Profile</a>--> </div>
      <div class="pdBottom">
        <ul class="navbar-nav flex-wrap">
          <li class="nav-item" style="margin-right:5px;"> <a href="{{ route('admin.auth.logout') }}">Logout</a> </li>
          <!--<li class="d-flex justify-content-between align-items-center">
            <div class="moveName"> <span>Night mode</span> </div>
            <div>
              <ul>
                <li class="nav-item day-night-switch">
                  <input type="checkbox" class="dark_mode_toggle_checkbox" id="toggle_checkbox">
                  <label for="toggle_checkbox">
                  <div id="star">
                    <div class="star" id="star-1"><i class="fas fa-star"></i></div>
                    <div class="star" id="star-2"><i class="fas fa-star"></i></div>
                  </div>
                  <div id="moon"></div>
                  </label>
                </li>
              </ul>
            </div>
          </li>-->
        </ul>
      </div>
    </div>
  </div>
</nav>
<!-- /.navbar --> 
