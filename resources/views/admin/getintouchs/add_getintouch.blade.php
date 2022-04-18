@extends('layouts.admin')
@section('content')
<div class="main-content">
<div class="container">
            <div class="row">
              <div class="col-md-12">
                <form role="form" id="quickForm" action="{{url('/getintouch/store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" class="form-control" id="title" placeholder="enter title">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">heading</label>
                      <input type="text" name="heading" class="form-control" id="heading" placeholder="enter heading">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">description</label>
                      <input type="text" name="description" class="form-control" id="description" placeholder="Enter description">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Button Text</label>
                      <input type="text" name="button_text" class="form-control" id="button_text" placeholder="Enter Butten Text 1">
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
