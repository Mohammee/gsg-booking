<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('gsg.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="margin-left: 0">
        <span class="brand-text font-weight-light">Booking System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="font-size: 18px">{{ Auth::user()->name }}</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open"></li>
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->url() == route('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
                </li>
                <li
                    class="nav-item
                    @if (request()->url() == route('members.admins') ||
                            request()->url() == route('members.users') ||
                            request()->url() == route('members.create')) menu-is-opening menu-open @endif
                    ">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>
                            Members
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('members.admins') }}"
                                class="nav-link {{ request()->url() == route('members.admins') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('members.users') }}"
                                class="nav-link {{ request()->url() == route('members.users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('members.create') }}"
                                class="nav-link {{ request()->url() == route('members.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item
                    @if (request()->url() == route('trainingHalls.index') ||
                            request()->url() == route('workspaces.index') ||
                            request()->url() == route('officeSpaces.create')) menu-is-opening menu-open @endif
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Office spaces
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('trainingHalls.index') }}"
                                class="nav-link {{ request()->url() == route('trainingHalls.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Training Halls</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('workspaces.index') }}"
                                class="nav-link {{ request()->url() == route('workspaces.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Workspaces</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('officeSpaces.create') }}"
                                class="nav-link {{ request()->url() == route('officeSpaces.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                    </ul>


                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Bookings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List of Bookings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Booking Requests</p>
                                <span class="badge badge-info right">6</span>

                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn nav-link ">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </button>
                    </form>

                </li>
            </ul>
        </nav>
    </div>
</aside>
