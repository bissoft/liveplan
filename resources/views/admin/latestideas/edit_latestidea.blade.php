@extends('layouts.admin')
@section('content')
<div class="main-content">     
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="quickForm" action="{{url('/latestidea/update/'.$latestidea->id)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" value="{{$latestidea->title}}" id="title" placeholder="Enter latestidea Title">
                </div>
                
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="desc" class="form-control" value="{{$latestidea->desc}}" id="desc" placeholder="Enter latestidea Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">String type1</label>
                    <input type="text" name="string1" class="form-control" value="{{$latestidea->string1}}" id="banner_desc" placeholder="Enter latestidea Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">String type2</label>
                    <input type="text" name="string2" class="form-control" value="{{$latestidea->string2}}" id="banner_desc" placeholder="Enter Banner Description">
                  </div>
                  
                  <div class="form-group">
                    <label for="image"> Image</label>
                    <input type="file" name="image1" class="form-control" id="image">
                    <input type="hidden" name="current_image1" value="{{$latestidea->image1}}">
                                @if (!empty($latestidea->image1))
                                    <img style="width: 100px; height: 100px; margin-top:10px;" src="{{asset('uploads/banners/'.$latestidea->image1)}}" alt="">
                                @endif
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