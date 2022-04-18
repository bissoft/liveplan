@extends('layouts.admin')
@section('content')
<div class="main-content">     
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="quickForm" action="{{url('/choose/update/'.$choose->id)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" value="{{$choose->title}}" id="title" placeholder="Enter latestidea Title">
                </div>
                
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="desc" class="form-control" value="{{$choose->desc}}" id="desc" placeholder="Enter latestidea Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">heading</label>
                    <input type="text" name="heading" class="form-control" value="{{$choose->heading}}" id="heading" placeholder="Enter heading Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">String</label>
                    <input type="text" name="string" class="form-control" value="{{$choose->string}}" id="string" placeholder="Enter string Description">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">icon</label>
                    <input type="text" name="icon" class="form-control" value="{{$choose->icon}}" id="icon" placeholder="Enter icon Description">
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