@extends('layouts.admin')
@section('content')
<div class="main-content">
         <div class="container">
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="quickForm" action="{{url('/service/store')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
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





