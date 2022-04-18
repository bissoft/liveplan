@extends('layouts.admin')
@section('content')
<div class="main-content">
<div class="container">
            <div class="row">
              <div class="col-md-12">
                <form role="form" id="quickForm" action="{{url('/about/store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                <div class="form-group">
                      <label for="exampleInputEmail1">About Title</label>
                      <input type="text" name="about_title" class="form-control" id="about_title" placeholder="about heading">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">About heading</label>
                      <input type="text" name="about_heading" class="form-control" id="about_heading" placeholder="about heading">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">About description</label>
                      <input type="text" name="about_description" class="form-control" id="about_description" placeholder="about description">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Icon</label>
                    <input type="text" name="icon" class="form-control" id="icon" placeholder="Enter Icon Class name">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">String</label>
                      <input type="text" name="about_String" class="form-control" id="about_String" placeholder="about String">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Button Text1</label>
                      <input type="text" name="button_text1" class="form-control" id="button_text1" placeholder="Enter Butten Text 1">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Button Text2</label>
                      <input type="text" name="button_text2" class="form-control" id="button_text2" placeholder="Enter Butten Text 2">
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
