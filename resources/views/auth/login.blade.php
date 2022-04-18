@extends('layouts.app')

@section('content')

<div class="container login py-5">
    <div class="row">
        <div class="col-12 col-md-5 mx-auto">
            <div class="card bg-light p-4">
                <h4 class="text-center py-3">Login to Live Plan</h4>
                <form action="{{ route('login') }}" method="POST" id="login-form">
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
                    <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">I agree to the Terms & Conditions </label>
                    </div> -->
                    <div class="text-center pr3-primary-btn mt-3 ">
                        <button type="submit" class="btn btn-primary">Login</button>
                        {{-- <a href="javascript::void(0)" onclick="event.preventDefault(); --}}
                                        {{-- document.getElementById('login-form').submit();" class="text-white my-3">Login</a> --}}
                    </div>
                    <h4 class="text-center py-3">OR</h4>
                    <hr class="mt-0 mb-3">
                    <h6 class="text-center">No account? <a href="{{ route('register') }}" class="text-theme">Sign Up</a></h6>
                    <a class="text-center text-theme d-block w-100">Forgot Password?</a>
                    <div class="text-center pr3-primary-btn mt-3">
                    <a href="{{ route('recover.password') }}" class="text-primary">Recover Password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection            