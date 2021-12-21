<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{route('home')}}" class="simple-text logo-normal">
      {{ __('Ranking') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Admin User Settings') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'league' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('league') }}">
          <i class="material-icons">groups</i>
            <p>{{ __('League') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('category') }}">
          <i class="material-icons">category</i>
            <p>{{ __('Category') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'points' || $activePage == 'pointsedit') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#point" aria-expanded="true">
          <i class="material-icons">flag_circle</i>
          <p>{{ __('Points') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="point">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'points' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('points') }}">
                <span class="sidebar-mini"> PA </span>
                <span class="sidebar-normal">{{ __('Points Add') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'pointsedit' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('points.edit') }}">
                <span class="sidebar-mini"> PU </span>
                <span class="sidebar-normal"> {{ __('Points Edit') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'competitors' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('competitors') }}">
          <i class="material-icons">face</i>
          <p>{{ __('Competitors') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'event' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('event') }}">
          <i class="material-icons">festival</i>
          <p>{{ __('Event') }}</p>
        </a>
      </li>
      <li class="nav-item active-pro{{ $activePage == 'change' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('change') }}">
          <i class="material-icons">settings_suggest</i>
          <p>{{ __('Change option') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>