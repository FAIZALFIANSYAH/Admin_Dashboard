<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Pengeshz</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ route('Dashboard.index') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('hero.index') }}" class="nav-link">
              <i class="nav-icon fas fa-rocket"></i>
              <p>Hero Section</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                About Me
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('about.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Description</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('expertise.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Learning / Expertises</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('tools.index') }}" class="nav-link"> <i class="far fa-circle nav-icon"></i>
                  <p>Tools</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route ('experience.index')}}" class="nav-link"> <i class="nav-icon fas fa-briefcase"></i>
              <p>Career Narrative</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{route ('project.index')}}" class="nav-link">
              <i class="nav-icon fas fa-code"></i>
              <p>
                My Projects
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route ('project.index')}}" class="nav-link"> <i class="far fa-circle nav-icon"></i>
                  <p>Project List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('video.index') }}" class="nav-link"> <i class="far fa-circle nav-icon"></i>
                  <p>Video Projects</p>
                </a>
              </li>
              
            </ul>
            <li class="nav-item">
    <a href="{{ route('contact.index') }}" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>Contact Settings</p>
    </a>
</li>
          </li>

        </ul>
      </nav>
    </div>
</aside>