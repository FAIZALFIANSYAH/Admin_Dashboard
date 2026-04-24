<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Portfolio Admin</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->name }}</a>
                <small class="text-muted">{{ Auth::user()->roleLabel() }}</small>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('dashboard')
                <li class="nav-item">
                    <a href="{{ route('Dashboard.index') }}" class="nav-link {{ Request::routeIs('Dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endcan

                @can('hero')
                <li class="nav-item">
                    <a href="{{ route('hero.index') }}" class="nav-link {{ Request::routeIs('hero.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-rocket"></i>
                        <p>Hero Section</p>
                    </a>
                </li>
                @endcan

                @canany(['about', 'expertise', 'tools'])
                <li class="nav-item has-treeview {{ Request::routeIs('about.*', 'expertise.*', 'tools.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::routeIs('about.*', 'expertise.*', 'tools.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            About Me
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('about')
                        <li class="nav-item">
                            <a href="{{ route('about.index') }}" class="nav-link {{ Request::routeIs('about.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Description</p>
                            </a>
                        </li>
                        @endcan
                        @can('expertise')
                        <li class="nav-item">
                            <a href="{{ route('expertise.index') }}" class="nav-link {{ Request::routeIs('expertise.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Learning / Expertises</p>
                            </a>
                        </li>
                        @endcan
                        @can('tools')
                        <li class="nav-item">
                            <a href="{{ route('tools.index') }}" class="nav-link {{ Request::routeIs('tools.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tools</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @can('experience')
                <li class="nav-item">
                    <a href="{{ route('experience.index') }}" class="nav-link {{ Request::routeIs('experience.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Career Narrative</p>
                    </a>
                </li>
                @endcan

                @canany(['project', 'video'])
                <li class="nav-item has-treeview {{ Request::routeIs('project.*', 'video.*') ? 'menu-open' : '' }}">
                    <a href="{{ auth()->user()->can('project') ? route('project.index') : route('video.index') }}" class="nav-link {{ Request::routeIs('project.*', 'video.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-code"></i>
                        <p>
                            My Projects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('project')
                        <li class="nav-item">
                            <a href="{{ route('project.index') }}" class="nav-link {{ Request::routeIs('project.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project List</p>
                            </a>
                        </li>
                        @endcan
                        @can('video')
                        <li class="nav-item">
                            <a href="{{ route('video.index') }}" class="nav-link {{ Request::routeIs('video.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Video Projects</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @can('contact')
                <li class="nav-item">
                    <a href="{{ route('contact.index') }}" class="nav-link {{ Request::routeIs('contact.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Contact Settings</p>
                    </a>
                </li>
                @endcan

                @can('products')
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ Request::routeIs('products.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>
                @endcan

@can('users.index')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>user Management</p>
                    </a>
                </li>
                @endcan

@can('roles.index')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::routeIs('roles.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>role Management</p>
                    </a>
                </li>
                @endcan


                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link {{ Request::routeIs('profile.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>My Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
