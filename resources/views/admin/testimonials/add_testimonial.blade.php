@extends('layouts.admin')
@section('content')
<div class="main-content">
<div class="container">
            <div class="row">
              <div class="col-md-12">
                <form role="form" id="quickForm" action="{{url('/testimonial/store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="name" placeholder="Enter Title">
                  </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" name="desc" class="form-control" id="desc" placeholder="Enter  Description">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">heading1</label>
                      <input type="text" name="heading1" class="form-control" id="heading1" placeholder="heading1">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="name" class="form-control" id="name" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">heading2</label>
                      <input type="text" name="heading2" class="form-control" id="heading2" placeholder="heading2">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">String</label>
                      <input type="text" name="string" class="form-control" id="string" placeholder="Enter string ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">reting</label>
                      <input type="text" name="reting" class="form-control" id="reting" placeholder="Enter reting">
                    </div>
                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" name="image1" class="form-control" id="image">
                      <input type="hidden" name="old_image1">
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


