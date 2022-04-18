@extends('layouts.admin')
@section('content')
<div class="main-content">
               <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Edit Services</h3>
                          </div>
                      <div class="card-body p-0">
              <form role="form" id="quickForm" action="{{url('/service/update/'.$service->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Icon</label>
                    <input type="text" name="icon" class="form-control" value="{{$service->icon}}" id="name" placeholder="Enter Service Icon">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Service Name</label>
                      <input type="text" name="service_name" class="form-control" value="{{$service->name}}" id="service_name" placeholder="Enter Service Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Description</label>
                      <input type="text" name="service_desc" class="form-control" value="{{$service->description}}" id="service_desc" placeholder="Enter Service Description">
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
              </div>
</div>        
@endsection
