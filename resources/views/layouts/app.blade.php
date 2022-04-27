@php
    $data = content();
    $media = media();
@endphp
<!DOCTYPE html>
<html class="no-js" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>Live Plan</title>
    <link rel="stylesheet" href="{{asset('assets/css/plugins/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{asset('assets/css/theme_2.css')}}">
    @yield('style')
</head>

<body>
    <!-- Start Preloader -->
    <div class="cs-preloader cs-accent_color cs-white_bg">
        <div class="cs-preloader_bg cs-center cs-accent_4_bg">
            <div class="cs-preloader_in cs-accent_15_border">
                <img src="{{asset($data['#logo']['image']??'assets/img/logo.svg')}}" alt="Logo">
            </div>
        </div>
    </div>
    <!-- End Preloader -->
    <!-- Start Header Section -->
    <header class="cs-site_header cs-style1 cs-sticky-header cs-primary_font">
        <div class="cs-main_header">
            <div class="container">
                <div class="cs-main_header_in">
                    <div class="cs-main_header_left">
                        <a class="cs-site_branding" href="{{ url('/') }}"><img src="{{asset($data['#logo']['image']??'assets/img/logo.svg')}}"
                                alt="Logo"></a>
                    </div>
                    <div class="cs-main_header_right">
                        <div class="cs-nav">
                            <ul class="cs-nav_list">
                                <li class="current-menu-item"><a href="{{ url('/') }}">Home</a>

                                </li>
                                <li><a href="#">How It Works</a></li>
                                <li><a href="#">Features</a></li>
                                <li class="#"><a href="#">Pricing</a></li>
                                <li class="#"><a href="#">Customers</a></li>
                                <li class="#"><a href="#">Soluction</a></li>
                                <div class=" d-block d-sm-none">
                                    @auth()
                                    <a href="@if(auth()->user()->is_admin) {{url('/admin')}} @else {{url('/dashboard')}} @endif"
                                            class="cs-toolbox_btn cs-accent_bg_2 mb-2 mx-3 cs-white_hover cs-accent_bg_hover cs-rounded"><span>Dashbaord
                                            </span></a>
                                        <a href="javascript:void(0);"
                                            class="cs-toolbox_btn cs-accent_bg_2 mb-2 mx-3 cs-white_hover cs-accent_bg_hover cs-rounded"
                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout-variant"></i>
                                            <span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        
                                    @else
                                        <a href="{{route('login')}}"
                                            class="cs-toolbox_btn cs-accent_bg_2 mb-2 mx-3 cs-white_hover cs-accent_bg_hover cs-rounded"><span>Login
                                            </span></a>
                                        <a href="{{route('register')}}"
                                            class="cs-toolbox_btn cs-accent_bg_2 mx-3 cs-white_hover cs-accent_bg_hover cs-rounded"><span>Sign
                                                up </span></a>
                                    @endauth
                                </div>
                            </ul>
                        </div>
                        <div class="cs-toolbox">
                          @auth()
                          <a href="@if(auth()->user()->is_admin) {{url('/admin')}} @else {{url('/dashboard')}} @endif"
                                class="cs-toolbox_btn cs-accent_bg_2 cs-white_hover cs-accent_bg_hover cs-rounded"><span>Dashbaord
                                </span></a>
                                <a href="javascript:void(0);"
                                class="cs-toolbox_btn cs-accent_bg_2 cs-white_hover cs-accent_bg_hover cs-rounded"
                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout-variant"></i>
                                            <span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                          @else
                            <a href="{{ route('login') }}"
                                class="cs-toolbox_btn cs-accent_bg_2 cs-white_hover cs-accent_bg_hover cs-rounded"><span>Login
                                </span></a>
                            <a href="{{ route('register') }}"
                                class="cs-toolbox_btn cs-accent_bg_2 cs-white_hover cs-accent_bg_hover cs-rounded"><span>Sign
                                    up </span></a>
                                    @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Section -->

    @yield('content')
    <!-- Start Footer Section -->
    <footer class="cs-footer cs-style1 rounded-0 cs-accent_4_bg_2">
        <div class="container">
            <div class="cs-height_115 cs-height_lg_75"></div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="cs-footer_item">
                        <h2 class="cs-widget_title cs-semi_bold">{{$data['#footer_newsletter']['heading']??''}}</h2>
                        <div class="cs-footer_newsletter cs-style1">
                            <div class="cs-footer_newsletter_text">{!!$data['#footer_newsletter']['description']??''!!}</div>
                            <div class="cs-height_30 cs-height_lg_30"></div>
                            @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                            <form action="{{route('newsletter.store')}}" method="POST" class="cs-footer_newsletter_form">
                              @csrf
                              {!! $errors->first('email', "<span class='text-danger'>:message</span>") !!}
                                <input type="email" class="cs-footer_newsletter_input" name="email" placeholder="Enter your email">
                                <button type="submit" class="cs-footer_newsletter_btn cs-accent_bg_2 cs-white cs-accent_bg_hover"><i
                                        class="fas fa-paper-plane"></i></button>
                                        
                            </form>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-lg-8 offset-lg-1">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="cs-footer_item widget_nav_menu">
                                <h2 class="cs-widget_title cs-semi_bold">{{$data['#footer_service']['heading']??''}}</h2>
                                <ul class="menu">
                                    <li><a href="#">lorem plusam</a></li>
                                    <li><a href="#">lorem plusam</a></li>
                                    <li><a href="#">lorem plusam</a></li>
                                    <li><a href="#">lorem plusam </a></li>
                                </ul>
                            </div>
                        </div><!-- .col -->
                        <div class="col-md-4">
                            <div class="cs-footer_item widget_nav_menu">
                                <h2 class="cs-widget_title cs-semi_bold">{{$data['#footer_company']['heading']??''}}</h2>
                                <ul class="menu">
                                    <li><a href="#">Privacy policy</a></li>
                                    <li><a href="#">Sitemap</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Terms & conditions</a></li>
                                </ul>
                            </div>
                        </div><!-- .col -->
                        <div class="col-md-4">
                            <div class="cs-footer_item cs-address_widgert">
                                <h2 class="cs-widget_title cs-semi_bold">{{$data['#footer_fallow']['heading']??''}}</h2>
                                <ul>
                                    <li>{{$data['#footer_email']['heading']??''}}</li>
                                    <li>{{$data['#footer_phone']['heading']??''}}</li>
                                </ul>
                                <div class="cs-height_30 cs-height_lg_30"></div>
                                <div class="cs-social_btns cs-style1">
                                  @foreach ($media as $item)
                                      
                                    <a href="{{$item->link??''}}" title="{{$item->name??''}}" target="_blank"
                                        class="cs-accent_bg_2_hover cs-white_hover cs-white_bg cs-ternary_color"><i
                                            class="{{$item->icon??''}}"></i></a>
                                            @endforeach
                                    {{-- <a href="#"
                                        class="cs-accent_bg_2_hover cs-white_hover cs-white_bg cs-ternary_color"><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="#"
                                        class="cs-accent_bg_2_hover cs-white_hover cs-white_bg cs-ternary_color"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="#"
                                        class="cs-accent_bg_2_hover cs-white_hover cs-white_bg cs-ternary_color"><i
                                            class="fab fa-pinterest-p"></i></a> --}}
                                </div>
                            </div>
                        </div><!-- .col -->
                    </div>
                </div>
            </div>
            <div class="cs-height_90 cs-height_lg_50"></div>
        </div>
        <div class="cs-copyright text-center cs-primary_color cs-accent_4_bg_2">
            <div class="container">Copyright © 2022. All rights reserved</div>
        </div>
    </footer>
    <!-- End Footer Section -->

    <!-- Start Video Popup -->
    <div class="cs-video_popup">
        <div class="cs-video_popup_overlay"></div>
        <div class="cs-video_popup_content">
            <div class="cs-video_popup_layer"></div>
            <div class="cs-video_popup_container">
                <div class="cs-video_popup_align">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="about:blank"></iframe>
                    </div>
                </div>
                <div class="cs-video_popup_close"></div>
            </div>
        </div>
    </div>
    <!-- End Video Popup -->
    @yield('script')
    <!-- Script -->
    <script src="{{asset('assets/js/plugins/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/isotope.pkg.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.slick.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/lightgallery.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.counter.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>
