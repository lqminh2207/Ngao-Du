<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown mt-3">
                        <div class="user-pic"><img src="{{ asset('xtreme/assets/images/users/1.jpg') }}" alt="users" class="rounded-circle" width="40" /></div>
                        <div class="user-content hide-menu ml-2">
                            <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 user-name font-medium">Le Quang Minh <i class="fa fa-angle-down"></i></h5>
                                <span class="op-5 user-email">varun@gmail.com</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user mr-1 ml-1"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet mr-1 ml-1"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email mr-1 ml-1"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off mr-1 ml-1"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <li class="p-15 mt-2"><a href="javascript:void(0)" class="btn btn-block create-btn text-white no-block d-flex align-items-center"><i class="fa fa-plus-square"></i> <span class="hide-menu ml-1">Create New</span> </a></li>
                <!-- User Profile-->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Ngao Du</span></li>
                <li class="sidebar-item"><a href="{{ route('types.index') }}" class="sidebar-link"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Types </span></a></li>
                <li class="sidebar-item"><a href="{{ route('destinations.index') }}" class="sidebar-link"><i class="mdi mdi-code-equal"></i><span class="hide-menu"> Destinations </span></a></li>
                <li class="sidebar-item"><a href="{{ route('tours.index') }}" class="sidebar-link"><i class="mdi mdi-dns"></i><span class="hide-menu"> Tours </span></a></li>
                <li class="sidebar-item"><a href="{{ route('bookings.index') }}" class="sidebar-link"><i class="mdi mdi-cube-send"></i><span class="hide-menu"> Booking </span></a></li>
                <li class="sidebar-item"><a href="{{ route('contacts.index') }}" class="sidebar-link"><i class="mdi mdi-creation"></i><span class="hide-menu"> Contact </span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>