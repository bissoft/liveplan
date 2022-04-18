@extends('layouts.admin')
@section('content')
<div class="main-content">
<div class="container">
            <div class="row">
              <div class="col-md-12">
                <form role="form" id="quickForm" action="{{url('/price/store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter  Title">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">heading one</label>
                    <input type="text" name="heading1" class="form-control" id="heading1" placeholder="Enter  heading one">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" name="desc" class="form-control" id="desc" placeholder="Enter  Description">
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">heading Two</label>
                    <input type="text" name="heading2" class="form-control" id="heading2" placeholder="Enter  heading tow">
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
                      <label for="exampleInputEmail1">list type 1</label>
                      <input type="text" name="list1" class="form-control" id="list1" placeholder="Enter list1 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">list type 2</label>
                      <input type="text" name="list2" class="form-control" id="list2" placeholder="Enter list2 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">list type 3</label>
                      <input type="text" name="list3" class="form-control" id="list3" placeholder="Enter list3 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">list type 4</label>
                      <input type="text" name="list4" class="form-control" id="list4" placeholder="Enter list4 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">list type 5</label>
                      <input type="text" name="list5" class="form-control" id="list5" placeholder="Enter list5 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">icon</label>
                      <input type="text" name="icon" class="form-control" id="icon" placeholder="Enter icon type ">
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