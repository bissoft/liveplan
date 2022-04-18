<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
		<link rel="icon" href="{{asset('dash-assets/images/favicon-32x32.png')}}" type="image/png" />
		<!-- loader-->
		<link href="{{asset('dash-assets/css/pace.min.css')}}" rel="stylesheet" />
		<script src="{{asset('dash-assets/js/pace.min.html')}}"></script>
		<!-- Bootstrap CSS -->
		<link href="{{asset('dash-assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
		<link href="{{asset('dash-assets/css/app.css')}}" rel="stylesheet">
		<link href="{{asset('dash-assets/css/icons.css')}}" rel="stylesheet">
		<title>Sign Up</title>
	</head>

    <body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <img src="{{asset('assets/img/logo.svg')}}" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign Up</h3>
                                        <p>Already have an account? <a href="{{route('login')}}">Sign in here</a>
                                        </p>
                                    </div>
                                   
                                    <div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
                                        <hr/>
                                    </div>
                                    <div class="form-body">
                                        <form action="{{route('register')}}" method="POST" class="row g-3">
                                            @csrf
                                            <div class="col-sm-6">
                                                <label for="inputFirstName" class="form-label">First Name</label>
                                                <input type="text" name="first_name" class="form-control" required id="inputFirstName" placeholder="Jhon">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputLastName" class="form-label">Last Name</label>
                                                <input type="text" name="last_name" class="form-control" required id="inputLastName" placeholder="Deo">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input type="email" name="email" class="form-control" required id="inputEmailAddress" placeholder="example@user.com">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password" required class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <label for="inputSelectCountry" class="form-label">Country</label>
                                                <select class="form-select" name="country" required id="inputSelectCountry" aria-label="Default select example">
                                                    <option selected>loram</option>
                                                    <option value="1">loram</option>
                                                    <option value="2">loram</option>
                                                    <option value="3">loram</option>
                                                </select>
                                            </div> --}}
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" name="term" required type="checkbox" id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                     <div class="d-grid">
                                        <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                          <img class="me-2" src="{{asset('dash-assets/images/icons/search.svg')}}" width="16" alt="Image Description">
                          <span>Sign Up with Google</span>
                                            </span>
                                        </a> <a href="javascript();" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign Up with Facebook</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <img src="{{asset('dash-assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <img src="{{asset('dash-assets/js/jquery.min.js"></script>
    <img src="{{asset('dash-assets/plugins/simplebar/js/simplebar.min.js"></script>
    <img src="{{asset('dash-assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <img src="{{asset('dash-assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <img src="{{asset('dash-assets/js/app.js"></script>
    </body>


<!-- Mirrored from creatantech.com/demos/codervent/syndron/vertical/public/authentication-signup by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Apr 2022 08:11:45 GMT -->
</html>



@extends('layouts.app')

@section('content')

<div class="container login py-5">
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card bg-light p-4">
                <h4 class="text-center py-3">Sign Up to Live Plan</h4>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-danger">{{ Session::get('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="Enter Company Name" name="company_name" value="{{ old('company_name') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="Enter Name" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Job Title</label>
                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="Enter Job Title" name="job_title" value="{{ old('job_title') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="Enter Email" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="phone" class="form-control" id="" aria-describedby="" placeholder="Enter Phone" name="phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Industry</label>
                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="Enter Industry" name="industry" value="{{ old('industry') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Address" name="address" value="{{ old('address') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">VAT Registration Number (if applicable)</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="VAT" name="vat" value="{{ old('vat') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Corporate Structure</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Corporate Structure" name="corporate_structure" value="{{ old('corporate_structure') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Payment Method</label>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="card_method" class="form-check-input" value="card" id="exampleInputPassword1" placeholder="Corporate Structure" name="payment_method">
                                                <label class="form-check-lable" for="card_method">Card</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="bank_method" class="form-check-input" value="card" id="exampleInputPassword1" placeholder="Corporate Structure" name="payment_method">
                                                <label class="form-check-lable" for="bank_method">Bank</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="pswd">Password</label>
                                <input type="password" class="form-control" id="pswd" name="password">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for=cpswd">Confirm Password</label>
                                <input type="text" class="form-control" id="cpswd" name="confirm_password">
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">I agree to the Terms & Conditions </label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </div>
                    <h4 class="text-center py-3">OR</h4>
                    <hr class="mt-0 mb-3">
                    <h5 class="text-center">Already have account? <a href="{{ route('login') }}" class="text-primary">Sign In</a></h5>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection