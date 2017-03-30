<!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">H<b>4</b>k</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">H<b>4</b>cking Bad</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @if ( Auth::guest() )
            <li class="{{ Request::is('login') ? "active" : "" }}">
                <a href="{{ url('/login') }}">Login</a>
            </li>
            <li class="{{ Request::is('team/create') ? "active" : "" }}">
                <a href="{{ route('team.create') }}">Sign Up</a>
            </li>
          @else
            @if(session()->has('endtime'))
              <li class="">
                <a href="#">Timer here</a>
              </li>
            @endif
            @if(session()->has('user_in_round'))
              <li class="">
                <a href="#" class="btn btn-danger">End Round</a>
              </li>
            @endif
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{ url('/adminlte/dist/img/avatar.png') }}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{ url('/adminlte/dist/img/avatar.png') }}" class="img-circle" alt="User Image">

                  <p>
                    {{ Auth::user()->name }}
                    <small>{{ Auth::user()->email }}</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ route('password.request') }}" class="btn btn-default btn-flat">Change Password</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </nav>
  </header>