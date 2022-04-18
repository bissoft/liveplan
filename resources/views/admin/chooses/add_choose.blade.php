@extends('layouts.admin')
@section('content')
<div class="main-content">
<div class="container">
            <div class="row">
              <div class="col-md-12">
                <form role="form" id="quickForm" action="{{url('/choose/store')}}" method="post" enctype="multipart/form-data">
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
                      <label for="exampleInputEmail1">Heading</label>
                      <input type="text" name="heading" class="form-control" id="heading" placeholder="Enter heading">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">String</label>
                      <input type="text" name="string" class="form-control" id="string" placeholder="Enter string ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">icon</label>
                      <input type="text" name="icon" class="form-control" id="icon" placeholder="Enter icon">
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