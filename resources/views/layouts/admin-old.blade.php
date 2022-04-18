<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <!--   <link rel="shortcut icon" href="dash-assets/images/favicon.ico"> -->
    <!-- App css -->
    <link href="/dash-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="/dash-assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/dash-assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
    @yield('style')
</head>
<body>
    <!-- Begin page -->
    <div id="wrapper">
        
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="d-none d-sm-block">
                    <form class="app-search">
                        <div class="app-search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                    <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-bell-outline noti-icon"></i>
                        <span class="noti-icon-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="font-16 text-white m-0">
                            <span class="float-right">
                                <a href="#" class="text-white">
                                    <small>Clear All</small>
                                </a>
                            </span>Notification
                            </h5>
                        </div>
                        <div class="slimscroll noti-scroll">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-success">
                                    <i class="mdi mdi-settings-outline"></i>
                                </div>
                                <p class="notify-details">New settings
                                    <small class="text-muted">There are new settings available</small>
                                </p>
                            </a>
                            
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="mdi mdi-bell-outline"></i>
                                </div>
                                <p class="notify-details">Updates
                                    <small class="text-muted">There are 2 new updates available</small>
                                </p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-danger">
                                    <i class="mdi mdi-account-plus"></i>
                                </div>
                                <p class="notify-details">New user
                                    <small class="text-muted">You have 10 unread messages</small>
                                </p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Caleb Flakelar commented on Admin
                                    <small class="text-muted">4 days ago</small>
                                </p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-secondary">
                                    <i class="mdi mdi-heart"></i>
                                </div>
                                <p class="notify-details">Carlos Crouch liked
                                    <b>Admin</b>
                                    <small class="text-muted">13 days ago</small>
                                </p>
                            </a>
                        </div>
                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-primary notify-item notify-all">
                            View all
                            <i class="fi-arrow-right"></i>
                        </a>
                    </div>
                </li>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-email-outline noti-icon"></i>
                        <span class="noti-icon-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="font-16 text-white m-0">
                            <span class="float-right">
                                <a href="#" class="text-white">
                                    <small>Clear All</small>
                                </a>
                            </span>Messages
                            </h5>
                        </div>
                        <div class="slimscroll noti-scroll">
                            <div class="inbox-widget">
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="/dash-assets/images/users/avatar-1.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Chadengle</p>
                                        <p class="inbox-item-text text-truncate">Hey! there I'm available...</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="/dash-assets/images/users/avatar-2.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Tomaslau</p>
                                        <p class="inbox-item-text text-truncate">I've finished it! See you so...</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="/dash-assets/images/users/avatar-3.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Stillnotdavid</p>
                                        <p class="inbox-item-text text-truncate">This theme is awesome!</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="/dash-assets/images/users/avatar-4.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Kurafire</p>
                                        <p class="inbox-item-text text-truncate">Nice to meet you</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="/dash-assets/images/users/avatar-5.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Shahedk</p>
                                        <p class="inbox-item-text text-truncate">Hey! there I'm available...</p>
                                    </div>
                                </a>
                                </div> <!-- end inbox-widget -->
                            </div>
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-primary notify-item notify-all">
                                View all
                                <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ auth()->user()->image ?? asset('dash-assets/images/users/avatar-1.jpg')}}" alt="user-image" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-outline"></i>
                                <span>Profile</span>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-settings-outline"></i>
                                <span>Settings</span>
                            </a>
                            <!-- item-->
                            <div class="dropdown-divider"></div>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout-variant"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                        <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                     <li>
                        <a href="{{ url('/admin') }}" class="active"><i class="fa fa-home mr-1"></i>Home</a>
                    </li>
                    <!-- <li>
                        <a href="#" class="active"><i class="fa fa-search mr-1"></i>Search</a>
                    </li>
                    <li>
                        <a href="#" class=""><i class="far fa-file-alt mr-1"></i>Campaigns</a>
                    </li>
                    <li>
                        <a href="#" class=""><i class="fa fa-cog mr-1"></i>Settings</a> -->
                    </li>
                  

                </ul>
            </div>
          
            <!-- end Topbar -->
            <div>
                
                <!-- ========== Left Sidebar Start ========== -->
                <div class="left-side-menu">
                    <div class="slimscroll-menu">
                        <!--- Sidemenu -->
                        <div id="sidebar-menu">
                            <ul class="metismenu" id="side-menu">
                                <!-- <li>
                                        <a href="{{ route('admin.lists.index') }}"><i class="fa fa-list"></i><span>Lists</span></a>
                                </li>
                                <li>
                                        <a href="{{ route('admin.companies.index') }}"><i class="fa fa-building text-danger"></i><span>Companies</span></a>
                                </li>
                                <li>
                                        <a href="{{ route('admin.accounts.index') }}"><i class="fa fa-user-plus text-primary"></i><span>Accounts</span></a>
                                </li> -->
                                 <!--  <li>
                                    <a href="javascript: void(0);">
                                        <i class="fa fa-user-plus " style="color: blue;"></i>
                                        <span> People </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li> 
                                            <a href="#">
                                            <i class="far fa-file-alt text-success"></i>
                                        <span> List </span></a>
                                    </li>
                                    <li>
                                            <a href="#">
                                        <i class="fa fa-envelope text-primary"></i>
                                        <span> Name & Email </span>
                                    </a>
                                  </li>
                                  <li>
                                       <a href="#">
                                        <i class="fa fa-building text-danger"></i>
                                        <span> Company </span>
                                    </a>
                                  </li>
                                    <li>
                                    <a href="#">
                                        <i class="fa fa-map text-warning"></i>
                                        <span> Account HQ Location </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user-plus" style="color:aqua"></i>
                                        <span> Employees </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-map text-warning"></i>
                                        <span> Account HQ Location </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user-plus" style="color:aqua"></i>
                                        <span> Employees </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-industry " style="color:chartreuse"></i>
                                        <span> Industry </span>
                                    </a>
                                </li>
                                    </ul>
                                </li> -->
                                <!-- <li>
                                    <a href="javascript: void(0);">
                                        <i class="fa fa-building " style="color: red;"></i>
                                        <span> Companies </span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li> 
                                            <a href="#">
                                            <i class="far fa-file-alt text-success"></i>
                                        <span> List </span></a>
                                    </li>
                                    <li>
                                            <a href="#">
                                        <i class="fa fa-envelope text-primary"></i>
                                        <span> Name & Email </span>
                                    </a>
                                  </li>
                                  <li>
                                       <a href="#">
                                        <i class="fa fa-building text-danger"></i>
                                        <span> Company </span>
                                    </a>
                                  </li>
                                    <li>
                                    <a href="#">
                                        <i class="fa fa-map text-warning"></i>
                                        <span> Account HQ Location </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user-plus" style="color:aqua"></i>
                                        <span> Employees </span>
                                    </a>
                                </li>
                                    </ul>
                                </li> -->
                                @can('user_management_access')
                                <li>
                                    <a href="javascript: void(0);">
                                        <i class="fa fa-user-circle " style="color: blue;"></i>
                                        <span> Users Management </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href="{{ route('admin.permissions.index') }}">Permissions </a></li>
                                        <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                                          <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                                    </ul>
                                </li>
                                <li>
                                        <a href="{{ url('admin/messages') }}"><i data-feather="file-plus" class="fa-fw fas fa-comments nav-icon text-success"></i><span>Messages</span></a>
                                </li>
                                <li>
                                        <a href="{{ url('admin/paid-users') }}"><i data-feather="file-plus" class="fa-fw fas fa-users nav-icon text-success"></i><span>Paid Users</span></a>
                                </li>
                                <li>
                                    <a href="javascript: void(0);">
                                        <i class="fa fa-user-circle " style="color: blue;"></i>
                                        <span> Xero </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href="{{ route('admin.xero.accounts') }}">Accounts</a></li>
                                    </ul>
                                </li>
                                @endcan
                                 <li>
                                    <a href="javascript: void(0);">
                                        <i class="fa fa-cog"></i>
                                        <span>Settings </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li>
                                                <a href="{{ url('/banner/view') }}">Banners</a>
                                        </li>
                                        <li>
                                                <a href="{{ url('/feature/view') }}">Features</a>
                                        </li>
                                        <li>
                                                <a href="{{ url('/service/view') }}">Services</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- End Sidebar -->
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -left -->
                </div>
                <!-- Left Sidebar End -->
                <!-- ============================================================== -->
                <!-- Start Page Content here -->
                <!-- ============================================================== -->
                <div class="content-page">
                    <div class="content">
                        <ul class="top-mobile-manu mt-5">
                        
                             <li class="active">
                                <a href="#" class=""><i class="fa fa-home mr-1"></i>Home</a>
                            </li>
                            <li>
                                <a href="#" class=""><i class="fa fa-search mr-1"></i>Search</a>
                            </li>
                            <li>
                                <a href="#" class=""><i class="far fa-file-alt mr-1"></i>Campaigns</a>
                            </li>
                            <li>
                                <a href="#" class=""><i class="fa fa-cog mr-1"></i>Settings</a>
                            </li>
                        </ul>

                        @yield('content')

                    </div>
                <!-- Footer Start -->
                        <footer class="footer">
                            <div class="container-fluid">
                                <div class="row">
                                </div>
                            </div>
                        </footer>
                    <!-- end Footer -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
        
        <!-- Vendor js -->
        <script src="/dash-assets/js/vendor.min.js"></script>
        <!--Morris Chart-->
        <script src="/dash-assets/libs/morris-js/morris.min.js"></script>
        <script src="/dash-assets/libs/raphael/raphael.min.js"></script>
        <!-- /Dashboard init js-->
        <script src="/dash-assets/js/pages//dashboard.init.js"></script>
        <!-- App js -->
        <script src="/dash-assets/js/app.min.js"></script>

        @yield('scripts')
        
    </body>
    
</html>