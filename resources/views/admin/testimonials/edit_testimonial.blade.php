@extends('layouts.admin')
@section('content')
<div class="main-content">     
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="quickForm" action="{{url('/testimonial/update/'.$testimonial->id)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" value="{{$testimonial->title}}" id="name" placeholder="Enter testimonial Title">
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="desc" class="form-control" value="{{$testimonial->desc}}" id="desc" placeholder="Enter testimonial Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">heading1</label>
                    <input type="text" name="heading1" class="form-control" value="{{$testimonial->heading1}}" id="banner_desc" placeholder="Enter testimonial Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$testimonial->name}}" id="name" placeholder="Enter testimonial name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">heading2</label>
                    <input type="text" name="heading2" class="form-control" value="{{$testimonial->heading2}}" id="banner_desc" placeholder="Enter testimonial Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">String</label>
                    <input type="text" name="string" class="form-control" value="{{$testimonial->string}}" id="banner_desc" placeholder="Enter testimonial Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">reting</label>
                    <input type="text" name="reting" class="form-control" value="{{$testimonial->reting}}" id="banner_desc" placeholder="Enter testimonial Description">
                  </div>
                 
                  <div class="form-group">
                    <label for="image"> Image</label>
                    <input type="file" name="image1" class="form-control" id="image">
                    <input type="hidden" name="current_image1" value="{{$testimonial->image1}}">
                                @if (!empty($testimonial->image1))
                                    <img style="width: 100px; height: 100px; margin-top:10px;" src="{{asset('uploads/banners/'.$testimonial->image1)}}" alt="">
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
