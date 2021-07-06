<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('Accounting Software') }}
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
          <i class="material-icons">person</i>
          <p>{{ __('Profiles') }}
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
          </ul>
        </div>
      </li>
       @can('manage_users')
      <li class="nav-item {{ ( $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExamplee" aria-expanded="true">
          <i class="material-icons">person</i>
          <p>{{ __('User Management') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExamplee">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('users.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('Users') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('roles.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('Roles') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'permissions' ? ' active' : '' }}">  
              <a class="nav-link" href="{{ route('permission.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('Permissions') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endcan
      <li class="nav-item{{ $activePage == 'categories' ? ' active' : '' }}">
        <a class="nav-link" href="/categories">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Categories') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'items' || $activePage == 'customers' || $activePage == 'invoices') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#sales" aria-expanded="true">
          <i class="material-icons">money</i>
          <p>{{ __('Sales') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="sales">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'items' ? ' active' : '' }}">
              <a class="nav-link" href="/items">
                <i class="material-icons">
                  category
                </i>
                <span class="sidebar-normal">{{ __('Items') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'customers' ? ' active' : '' }}">
              <a class="nav-link" href="/customers">
                <i class="material-icons">person_outline</i>
                <p style="display: inline-block; font-size:13px">{{ __('Customers') }} </p>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'invoices' ? ' active' : '' }}">
              <a class="nav-link" href="/invoices">
                <i class="material-icons">
                  receipt
                </i>
                <span class="sidebar-normal"> {{ __('Invoices') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://host.docker.internal:8001 " target="_blank">
          <i class="material-icons">chat</i>
          Chat
        </a>
      </li>
    </ul>
  </div>
</div>
