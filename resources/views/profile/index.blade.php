@extends('layouts.admin')

@section('content')
@php $user = auth()->user() @endphp
<div class="container-fluid">
  <!-- Add Project -->

  <div class="header-left mb-3">
    <div class="dashboard_bar">
      Profile
    </div>
  </div>
  <div class="row mx-0">
    <div class="container rounded bg-white mt-1 mb-5">
      <div class="row">
        <div class="col-md-3 border-right">
          <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{$user->name}}</span><span class="text-black-50">{{$user->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
          <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="text-right">Profile Settings</h4>
            </div>
            <form action="{{url('profile')}}" method="POST">
              @csrf
              <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Company Name</label><input type="text" class="form-control" name="company_name" value="{{$user->company_name}}" value=""></div>
                <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" name="name" value="{{$user->name}}" value=""></div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" name="address" value="{{$user->address}}"></div>
                <div class="col-md-12"><label class="labels">VAT</label><input type="text" class="form-control" name="vat" value="{{$user->vat}}"></div>
                <div class="col-md-12"><label class="labels">Industry</label><input type="text" class="form-control" name="industry" value="{{$user->industry}}"></div>
                <div class="col-md-12"><label class="labels">Job Title</label><input type="text" class="form-control" name="job_title" value="{{$user->job_title}}"></div>
                <div class="col-md-12"><label class="labels">Corporate Structure</label><input type="text" name="corporate_structure" class="form-control" value="{{$user->corporate_structure}}"></div>
              </div>
              <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 py-5">
            <div class="col-md-12"><label class="labels">Phone</label><input type="text" class="form-control" name="phone" value="{{$user->phone}}"></div>
            <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" disabled value="{{$user->email}}"></div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection