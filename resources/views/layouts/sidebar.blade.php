<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      @if( !Auth::guest() )
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ url('/adminlte/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
      @endif
      
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      @if( !Auth::guest() )
        @if( Auth::user()->isAdmin())
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">ADMIN Panel</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('user') ? "active" : "" }}"><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
            <li class="{{ Request::is('accessgroup') ? "active" : "" }}"><a href="{{ route('accessgroup.index') }}"><i class="fa fa-group"></i> <span>Access Groups</span></a></li>
            <li class="{{ Request::is('category') ? "active" : "" }}"><a href="{{ route('category.index') }}"><i class="fa fa-cubes"></i> <span>Categories</span></a></li>
            <li class="{{ Request::is('round') ? "active" : "" }}"><a href="{{ route('round.index') }}"><i class="fa fa-flag"></i> <span>Rounds</span></a></li>
            <li class="{{ Request::is('problem') ? "active" : "" }}"><a href="{{ route('problem.index') }}"><i class="fa fa-puzzle-piece"></i> <span>Problems</span></a></li>
            <li><a href="#"><i class="fa  fa-trophy"></i> <span>Leaderboard</span></a></li>
          </ul>
          <!-- /.sidebar-menu -->
        @endif

        @if( Auth::user()->isParticipant())
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Participant Panel</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Route::is('team.edit') ? "active" : "" }}"><a href="{{ route('team.edit', Auth::user()->UserProfile->id) }}"><i class="fa fa-user"></i> <span>Team Profile</span></a></li>
            <li class="{{ Route::is('user.indexparticipantround') ? "active" : "" }}"><a href="{{ route('user.indexparticipantround', Auth::user()->id) }}"><i class="fa fa-flag"></i> <span>My Rounds</span></a></li>
            @if(session()->has('round'))
              <li class="{{ Route::is('user.indexparticipantproblem') ? "active" : "" }}"><a href="{{ route('user.indexparticipantproblem', Auth::user()->id) }}"><i class="fa fa-puzzle-piece"></i> <span>My Problems</span></a></li>
            @endif
            @if(session()->has('leaderboard'))
              <li class=""><a href="#"><i class="fa fa-trophy"></i> <span>LeaderBoard</span></a></li>
            @endif
            <li><a href="#"><i class="fa fa-bomb"></i> <span>Rules</span></a></li>
          </ul>
          <!-- /.sidebar-menu -->
        @endif
      @endif
      
    </section>
    <!-- /.sidebar -->
  </aside>