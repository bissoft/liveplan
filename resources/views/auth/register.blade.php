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