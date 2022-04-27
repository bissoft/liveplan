<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <!-- <link rel="icon" href="{{asset('dash-assets/images/favicon-32x32.png')}}" type="image/png" /> -->
    <!--plugins-->
    <link href="{{asset('dash-assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dash-assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('dash-assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('dash-assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('dash-assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('dash-assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('dash-assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('dash-assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('dash-assets/css/icons.css')}}" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('dash-assets/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('dash-assets/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{asset('dash-assets/css/header-colors.css')}}" />
    @yield('style')
</head>

<body>


    <div class="wrapper">


        <!--**********************************
            Header start
        ***********************************-->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>

                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">

                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                        class="alert-count">7</span>
                                    <i class='bx bx-bell'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">Notifications</p>
                                            <p class="msg-header-clear ms-auto">Marks all as read</p>
                                        </div>
                                    </a>
                                    <div class="header-notifications-list">
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-primary text-primary"><i
                                                        class="bx bx-group"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Customers<span
                                                            class="msg-time float-end">14 Sec
                                                            ago</span></h6>
                                                    <p class="msg-info">5 new user registered</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-danger text-danger"><i
                                                        class="bx bx-cart-alt"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Orders <span
                                                            class="msg-time float-end">2 min
                                                            ago</span></h6>
                                                    <p class="msg-info">You have recived new orders</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-success text-success"><i
                                                        class="bx bx-file"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">24 PDF File<span
                                                            class="msg-time float-end">19 min
                                                            ago</span></h6>
                                                    <p class="msg-info">The pdf files generated</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-warning text-warning"><i
                                                        class="bx bx-send"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">Time Response <span
                                                            class="msg-time float-end">28 min
                                                            ago</span></h6>
                                                    <p class="msg-info">5.1 min avarage time response</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-info text-info"><i
                                                        class="bx bx-home-circle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Product Approved <span
                                                            class="msg-time float-end">2 hrs ago</span></h6>
                                                    <p class="msg-info">Your new product has approved</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-danger text-danger"><i
                                                        class="bx bx-message-detail"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Comments <span
                                                            class="msg-time float-end">4 hrs
                                                            ago</span></h6>
                                                    <p class="msg-info">New customer comments recived</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-success text-success"><i
                                                        class='bx bx-check-square'></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">Your item is shipped <span
                                                            class="msg-time float-end">5 hrs
                                                            ago</span></h6>
                                                    <p class="msg-info">Successfully shipped your item</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-primary text-primary"><i
                                                        class='bx bx-user-pin'></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New 24 authors<span
                                                            class="msg-time float-end">1 day
                                                            ago</span></h6>
                                                    <p class="msg-info">24 new authors joined last week</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-warning text-warning"><i
                                                        class='bx bx-door-open'></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">Defense Alerts <span
                                                            class="msg-time float-end">2 weeks
                                                            ago</span></h6>
                                                    <p class="msg-info">45% less alerts last 4 weeks</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <a href="javascript:;">
                                        <div class="text-center msg-footer">View All Notifications</div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-message-list">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset(auth()->user()->image??'dash-assets/images/avatars/avatar-2.png')}}" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{auth()->user()->name??''}}</p>

                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{url('profile')}}"><i
                                        class="bx bx-user"></i><span>Profile</span></a>
                            </li>
                            <li><a class="dropdown-item" href="{{url('/admin')}}"><i
                                        class='bx bx-home-circle'></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i
                                        class='bx bx-log-out-circle'></i>
                                        <span>Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    </form>
                                
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>


        {{-- <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                       
                        <ul class="navbar-nav header-right">
                        	<li class="nav-item dropdown header-profile">
                        		@php
                        			$user = auth()->user();
                        			$organizations = \App\Xero\XeroOrganization::all();
                        			$organization = $organizations->where('id', $user->xero_organization_id)->first();
                        		@endphp

                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
									<div class="header-info">
										@if ($organization)
											<span>{{ $organization->Name }}</span>
											<small>selected organization</small>
										@else
											<span>Select Organization</span>
										@endif
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                	<a href="javascript:void(0)" class="dropdown-item ai-icon change-organization" data-id="">None</a>
                                	@if ($organizations->count())
	                                	@foreach ($organizations as $organization)
	                                    	<a href="javascript:void(0)" class="dropdown-item ai-icon change-organization" data-id="{{ $organization->id }}">{{ $organization->Name }}</a>
	                                    @endforeach
	                                @endif
                                </div>
                            </li>
							<li class="nav-item">
								<div class="input-group search-area d-lg-inline-flex d-none">
									<div class="input-group-append">
										<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
									</div>
									<input type="text" class="form-control" placeholder="Search here...">
								</div>
							</li>
							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell bell-link" href="javascript:void(0)">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M2.23779 10.2492L4.66679 11.7064V8.30554L2.23779 10.2492Z" fill="#67636D"/>
										<path d="M1.1665 12.327V23.3334C1.16852 23.8531 1.28817 24.3656 1.5165 24.8325L9.20134 17.15L1.1665 12.327Z" fill="#67636D"/>
										<path d="M26.4832 24.8325C26.7115 24.3656 26.8311 23.8531 26.8332 23.3334V12.327L18.7983 17.15L26.4832 24.8325Z" fill="#67636D"/>
										<path d="M23.3335 8.30554V11.7064L25.7625 10.2492L23.3335 8.30554Z" fill="#67636D"/>
										<path d="M21.0492 13.0772C21.024 12.998 21.0076 12.9162 21.0002 12.8334V7.00004C21.0002 6.69062 20.8773 6.39388 20.6585 6.17508C20.4397 5.95629 20.1429 5.83337 19.8335 5.83337H8.16684C7.85742 5.83337 7.56067 5.95629 7.34188 6.17508C7.12309 6.39388 7.00017 6.69062 7.00017 7.00004V12.8334C6.99274 12.9162 6.97631 12.998 6.95117 13.0772L14.0002 17.3064L21.0492 13.0772Z" fill="#67636D"/>
										<path d="M17.3262 3.50003L14.7292 1.4222C14.5222 1.25653 14.2651 1.16626 14 1.16626C13.7349 1.16626 13.4777 1.25653 13.2708 1.4222L10.6738 3.50003H17.3262Z" fill="#67636D"/>
										<path d="M16.7358 18.3855L14.6008 19.6688C14.4194 19.7778 14.2117 19.8354 14 19.8354C13.7883 19.8354 13.5806 19.7778 13.3991 19.6688L11.2641 18.3855L3.16748 26.4833C3.63438 26.7117 4.14691 26.8313 4.66665 26.8333H23.3333C23.853 26.8313 24.3656 26.7117 24.8325 26.4833L16.7358 18.3855Z" fill="#67636D"/>
									</svg>
									<span class="badge light text-white bg-primary rounded-circle">6</span>
                                </a>
							</li>
							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link  ai-icon" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M23.3333 19.8333H23.1187C23.2568 19.4597 23.3295 19.065 23.3333 18.6666V12.8333C23.3294 10.7663 22.6402 8.75902 21.3735 7.12565C20.1068 5.49228 18.3343 4.32508 16.3333 3.80679V3.49996C16.3333 2.88112 16.0875 2.28763 15.6499 1.85004C15.2123 1.41246 14.6188 1.16663 14 1.16663C13.3812 1.16663 12.7877 1.41246 12.3501 1.85004C11.9125 2.28763 11.6667 2.88112 11.6667 3.49996V3.80679C9.66574 4.32508 7.89317 5.49228 6.6265 7.12565C5.35983 8.75902 4.67058 10.7663 4.66667 12.8333V18.6666C4.67053 19.065 4.74316 19.4597 4.88133 19.8333H4.66667C4.35725 19.8333 4.0605 19.9562 3.84171 20.175C3.62292 20.3938 3.5 20.6905 3.5 21C3.5 21.3094 3.62292 21.6061 3.84171 21.8249C4.0605 22.0437 4.35725 22.1666 4.66667 22.1666H23.3333C23.6428 22.1666 23.9395 22.0437 24.1583 21.8249C24.3771 21.6061 24.5 21.3094 24.5 21C24.5 20.6905 24.3771 20.3938 24.1583 20.175C23.9395 19.9562 23.6428 19.8333 23.3333 19.8333Z" fill="#67636D"/>
										<path d="M9.98193 24.5C10.3863 25.2088 10.971 25.7981 11.6767 26.2079C12.3823 26.6178 13.1839 26.8337 13.9999 26.8337C14.816 26.8337 15.6175 26.6178 16.3232 26.2079C17.0289 25.7981 17.6136 25.2088 18.0179 24.5H9.98193Z" fill="#67636D"/>
									</svg>
									<span class="badge light text-white bg-primary rounded-circle">4</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div id="dlab_W_Notification1" class="widget-media dz-scroll p-3 height380">
										<ul class="timeline">
											<li>
												<div class="timeline-panel">
													<div class="media mr-2">
														<img alt="image" width="50" src="/images/avatar/1.jpg">
													</div>
													<div class="media-body">
														<h6 class="mb-1">Dr sultads Send you Photo</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media mr-2 media-info">
														KG
													</div>
													<div class="media-body">
														<h6 class="mb-1">Resport created successfully</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media mr-2 media-success">
														<i class="fa fa-home"></i>
													</div>
													<div class="media-body">
														<h6 class="mb-1">Reminder : Treatment Time!</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											 <li>
												<div class="timeline-panel">
													<div class="media mr-2">
														<img alt="image" width="50" src="/images/avatar/1.jpg">
													</div>
													<div class="media-body">
														<h6 class="mb-1">Dr sultads Send you Photo</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media mr-2 media-danger">
														KG
													</div>
													<div class="media-body">
														<h6 class="mb-1">Resport created successfully</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media mr-2 media-primary">
														<i class="fa fa-home"></i>
													</div>
													<div class="media-body">
														<h6 class="mb-1">Reminder : Treatment Time!</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
										</ul>
									</div>
                                    <a class="all-notification" href="javascript:void(0)">See all notifications <i class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <img src="{{ auth()->user()->image ?? asset('{{asset('dash-assets/images/profile/5.jpg')}}" width="20" alt=""/>
									<div class="header-info">
										<span>{{auth()->user()->name??''}}</span>
										<small>Super Admin</small>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{url('profile')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ml-2">Inbox </span>
                                    </a>
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
                    </div>
                </nav>
            </div>
        </div> --}}
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{asset('assets/img/logo.svg')}}" class="logo-icon" alt="logo icon">
                </div>
                <div>

                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
                </div>
            </div>
            <ul class="metismenu" id="menu">
                <li><a class=" ai-icon" href="{{ url('/admin') }}" aria-expanded="false">
                        <i class="flaticon-047-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class=" ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-041-graph"></i>
                        <span class="nav-text">Reconciliation</span>
                    </a>
                </li>

                <li><a class=" ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-013-checkmark"></i>
                        <span class="nav-text">Tax</span>
                    </a>
                </li>

                <li><a class=" ai-icon" href="{{ route('admin.messages') }}" aria-expanded="false">
                        <i class="fa fa-comment"></i>
                        <span class="nav-text">Messages</span>
                    </a>
                </li>

                <li><a class=" ai-icon" href="{{ route('admin.support') }}" aria-expanded="false">

                        <i class="fa fa-question-circle"></i>
                        <span class="nav-text">Support</span>
                    </a>
                </li>

                <li><a class=" ai-icon" href="{{ route('admin.contacts') }}" aria-expanded="false">

                        <i class="fa fa-user-circle"></i>
                        <span class="nav-text">Contacts</span>
                    </a>
                </li>

                {{-- <li><a class=" ai-icon" href="{{url('plans')}}" aria-expanded="false">

						<i class="fa fa-user-circle"></i>
							<span class="nav-text">Subscription Plans</span>
						</a>
                    </li>

                <li> --}}
                    <a href="javascript: void(0);">
                        <i class="fa fa-user-circle"></i>
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
                    <a href="{{ url('admin/paid-users') }}"> <i class="fa fa-usd"></i> <span>Paid
                            Users</span></a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-user-circle "></i>
                        <span> Xero </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('admin.xero.accounts') }}">Accounts</a></li>

                        <li><a href="{{ route('admin.xero.contacts') }}">Contacts</a></li>

                        <li><a href="{{ route('admin.xero.invoices') }}">Invoices</a></li>

                        <li><a href="{{ route('admin.xero.taxRates') }}">Tax Rates</a></li>

                        <li><a href="{{ route('admin.xero.bankTransactions') }}">Bank Transactions</a></li>

                        <li><a href="{{ route('admin.xero.bankTransfers') }}">Bank Transfers</a></li>

                        <li><a href="{{ url('admin/xero/organisations') }}">Organizations</a></li>

                        <li><a href="{{ url('admin/xero/balancesheet') }}">Balance Sheets</a></li>

                        <li><a href="{{ url('admin/xero/trailbalance') }}">Trail Balances</a></li>

                        <li><a href="{{ url('admin/xero/profitloss') }}">Profit And Loss</a></li>

                        <li><a href="{{ url('admin/xero/maunaljournal') }}">Manual Journal</a></li>

                        <li><a href="{{ url('admin/fetch/prepayments') }}">Pre Payments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-user-circle"></i>
                        <span> QuickBooks </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        @can('webbook_company_access')
                            <li>
                                <a href="{{ url('admin/companies') }}">Companies</a>
                            </li>
                        @endcan
                        
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-cog"></i>
                        <span>Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        @can('content_access')
                            <li>
                                <a href="{{ url('admin/content') }}">Website Content</a>
                            </li>
                        @endcan
                        @can('service_access')
                            <li>
                                <a href="{{ url('admin/service') }}">Services</a>
                            </li>
                        @endcan
                        @can('packagePoint_access')
                            <li>
                                <a href="{{ url('admin/packagePoint') }}">Package Point</a>
                            </li>
                        @endcan
                        @can('package_access')
                            <li>
                                <a href="{{ url('admin/package') }}">Packages</a>
                            </li>
                        @endcan
                        @can('package_sale_access')
                            <li>
                                <a href="{{ url('admin/packageSale') }}">Package Sale</a>
                            </li>
                        @endcan
                        @can('article_access')
                            <li>
                                <a href="{{ url('admin/article') }}">Articles</a>
                            </li>
                        @endcan
                        @can('review_access')
                            <li>
                                <a href="{{ url('admin/review') }}">Review</a>
                            </li>
                        @endcan
                        @can('media_access')
                            <li>
                                <a href="{{ url('admin/media') }}">Social Media</a>
                            </li>
                        @endcan
                        @can('team_access')
                            <li>
                                <a href="{{ url('admin/team') }}">Team</a>
                            </li>
                        @endcan
                        @can('newsletter_access')
                            <li>
                                <a href="{{ url('admin/newsletter') }}">Newsletters</a>
                            </li>
                        @endcan

                        {{-- <li>
                                    <a href="{{ url('/feature/view') }}">Features</a>
                            </li>
                            <li>
                                    <a href="{{ url('/service/view') }}">Services</a>
                            </li>
                            <li>
                                    <a href="{{ url('/about/view') }}">About Us</a>
                            </li>
                            <li>
                                    <a href="{{ url('/getInTouch/view') }}">Get In touch</a>
                            </li>
                            <li>
                                    <a href="{{ url('/latestidea/view') }}">Latest Idea</a>
                            </li>
                            <li>
                                    <a href="{{ url('/choose/view') }}">Why Choose Us</a>
                            </li>
                            <li>
                                    <a href="{{ url('/pricing/view') }}">Pricing Plan</a>
                            </li>
                            <li>
                                    <a href="{{ url('/testimonial/view') }}">Testimonial</a>
                            </li>
                            <li>
                                    <a href="{{ url('/faq/view') }}">FAQ</a>
                            </li>
                            <li>
                                    <a href="{{ url('/project/view') }}">Have a Project Mind?</a>
                            </li>
                            <li>
                                    <a href="{{ url('/2fa') }}">2 Factor Auth</a>
                            </li> --}}

                    </ul>
                </li>
            </ul>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        {{-- <div class="footer">
            <div class="copyright">
                <p>Copyright © 2022</p>
            </div>
        </div> --}}
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->
        <div class="overlay toggle-icon"></div>
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Bootstrap JS -->
    <script src="{{asset('dash-assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('dash-assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('dash-assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('dash-assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('dash-assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <!--app JS-->
    <script src="{{asset('dash-assets/js/app.js')}}"></script>
    <script src="{{asset('dash-assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
    <script src="{{asset('dash-assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dash-assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('dash-assets/js/index.js')}}"></script>
    <script type="text/javascript">
        $(document).on('click', '.change-organization', function() {
            window.location.href = '/admin/change/organization/' + $(this).data('id');
        });
    </script>

    @yield('scripts')

</body>

</html>
