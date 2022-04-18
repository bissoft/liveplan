@extends('layouts.admin')
@section('content')
<div class="main-content">
<div class="container">
            <div class="row">
              <div class="col-md-12">
                <form role="form" id="quickForm" action="{{url('/latestidea/store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter  Title">
                  </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" name="desc" class="form-control" id="desc" placeholder="Enter  Description">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">String type 1</label>
                      <input type="text" name="string1" class="form-control" id="string1" placeholder="Enter string type one">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">String type 2</label>
                      <input type="text" name="string2" class="form-control" id="string2" placeholder="Enter string type one">
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