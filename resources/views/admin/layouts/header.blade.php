<header class="main-header">

  <!-- Logo -->
  <a href="{{ route('admin.dashboard.index') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">{{ env('APP_NAME') }}</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">{{ env('APP_NAME') }}</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('images/user.jpg') }}" class="user-image" alt="{{ auth()->user()->name }}">
            <span class="hidden-xs">{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('images/user.jpg') }}" class="img-circle" alt="{{ auth()->user()->name }}">
              <p>
                {{ __('lang.admin') }}
                <small style="direction:ltr">{{ '@' . auth()->user()->email }} </small>
              </p>
            </li>

            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="row">
                  <div class="col-sm-12">
                      <a style="display:block;" class="logout btn btn-default btn-flat" href="#"
                         onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                          {{ __('lang.logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </div>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
