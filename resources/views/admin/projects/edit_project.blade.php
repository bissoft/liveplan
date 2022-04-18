@extends('layouts.admin')
@section('content')
<div class="main-content">     
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="quickForm" action="{{url('/project/update/'.$project->id)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" value="{{$project->title}}" id="title" placeholder="Enter project Title">
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