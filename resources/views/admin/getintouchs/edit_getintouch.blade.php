@extends('layouts.admin')
@section('content')
<div class="main-content">     
<div class="container">
          <div class="row">
            <div class="col-md-12">
            <form role="form" id="quickForm" action="{{url('/getintouch/update/'.$getintouch->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" class="form-control" value="{{$getintouch->title}}" id="title" placeholder="title">
                </div>
                  
                <div class="form-group">
                      <label for="exampleInputEmail1">heading</label>
                      <input type="text" name="heading" class="form-control"  value="{{$getintouch->heading}}" id="heading" placeholder=" description">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1"> description</label>
                      <input type="text" name="description" class="form-control"  value="{{$getintouch->description}}" id="description" placeholder=" description">
                </div>
                

                <div class="form-group">
                      <label for="exampleInputEmail1">Button Text</label>
                      <input type="text" name="button_text" class="form-control" value="{{$getintouch->button_text}}" id="button_text1" placeholder="Butten Text ">
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