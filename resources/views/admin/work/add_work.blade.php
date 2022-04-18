@extends('layouts.admin')
@section('content')
<div class="main-content">
           <div class="container">
            <div class="row">
              <div class="col-md-12">
                <form role="form" id="quickForm" action="{{url('/work/store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="name" placeholder="Enter Title">
                  </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" name="work_desc" class="form-control" id="service_desc" placeholder="Enter Description">
                    </div>
                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" name="image" class="form-control" id="image">
                      <input type="hidden" name="old_image">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

              </div>
            </div>
          </div>
</div>
@endsection




{{-- @extends('layouts.app')

@section('content')

<section class="loin py-5">
<div class="container">
<div class="row align-items-center">
    <div class="col-12 col-md-6 ">
        <div class="card p-3 bg-light">
            <h2 class="mb-4 text-primary text-center" > Post a Job</h2>
            <form action="{{url('/service/store')}}" method="post" enctype="multipart/form-data">
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

                <div class="form-group">
                    <label for="exampleInputEmail1">Icon</label>
                    <input type="text" name="icon" class="form-control" id="name" placeholder="Enter Service Icon">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Service Name</label>
                      <input type="text" name="service_name" class="form-control" id="service_name" placeholder="Enter Service Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Description</label>
                      <input type="text" name="service_desc" class="form-control" id="service_desc" placeholder="Enter Service Description">
                    </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-md-6 ">
        <img src="{{ asset('assets/img/register.png') }}" class="img-fluid">
    </div>
</div>
</div>
</section>

@endsection --}}
